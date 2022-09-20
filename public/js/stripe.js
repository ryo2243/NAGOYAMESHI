const stripe = Stripe('pk_test_51Lcdg9H3mwyalYUk46aziPeYiD1r5WzCPaNoo9R13g0s145ose5W8t3OGhxQc78e2K7fJDJ6jcY6LiToqO6dlpwn00wnPuGSnz');

const elements = stripe.elements();
const cardElement = elements.create('card');
cardElement.mount('#cardElement');

const cardHolderName = document.getElementById('cardHolderName');
const cardButton = document.getElementById('cardButton');
const clientSecret = cardButton.dataset.secret;

cardButton.addEventListener('click', async (e) => {
  const { setupIntent, error } = await stripe.confirmCardSetup(
    clientSecret, {
    payment_method: {
      card: cardElement,
      billing_details: { name: cardHolderName.value }
    }
  }
  );

  if (error) {
    // Display "error.message" to the user...
    console.log(error);
  } else {
    // The card has been verified successfully...
    stripePaymentIdHandler(setupIntent.payment_method);
  }
});

function stripePaymentIdHandler(paymentMethodId) {
  // Insert the paymentMethodId into the form so it gets submitted to the server
  const form = document.getElementById('cardForm');

  const hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'paymentMethodId');
  hiddenInput.setAttribute('value', paymentMethodId);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}