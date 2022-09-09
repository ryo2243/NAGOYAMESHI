<footer class="bg-light">
    <div class="d-flex justify-content-center footer-logo">
        <a class="navbar-brand app-name" href="{{ url('/') }}">
            <div class="d-flex align-items-center">
                <img class="nagoyameshi-logo me-1" src ="{{ asset('/images/logo.svg') }}" alt="nagoyameshi">
                {{ config('app.name', 'Laravel') }}
            </div>  
        </a>      
    </div> 
    <div class="d-flex justify-content-center footer-link">
        <a href="#" class="link-secondary me-3">会社概要</a>
        <a href="#" class="link-secondary">利用規約</a>
    </div>
    <p class="text-center text-muted small mb-0">&copy; {{ config('app.name', 'Laravel') }} All rights reserved.</span>    
</footer>