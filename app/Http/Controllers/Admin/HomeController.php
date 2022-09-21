<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\Reservation;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('admin.auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $total_users = User::count();
        $total_subscribers = DB::table('subscriptions')->where('stripe_status', 'active')->count();
        $total_non_subscribers = $total_users - $total_subscribers;
        $total_restaurants = Restaurant::count();
        $total_reservations = Reservation::count();

        $price = 300;

        $subscription_quantity = DB::table('subscriptions')
            ->whereRaw('ends_at >=' . date('Y-m-', strtotime('now')) . date('d', strtotime('created_at')))
            ->orWhere('stripe_status', 'active')->count();
        $sales_for_this_month = 300 * $subscription_quantity;

        $variables = [
            'total_users',
            'total_subscribers',
            'total_non_subscribers',
            'total_restaurants',
            'total_reservations',
            'sales_for_this_month'
        ];

        return view('admin.home', compact($variables));
    }
}
