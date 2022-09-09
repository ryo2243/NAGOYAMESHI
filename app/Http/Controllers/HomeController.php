<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Category;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $new_restaurants = Restaurant::orderBy('created_at', 'desc')->limit(6)->get();
        $categories = Category::all();

        $variables = [
            'new_restaurants',
            'categories'
        ];

        return view('home', compact($variables));
    }
}
