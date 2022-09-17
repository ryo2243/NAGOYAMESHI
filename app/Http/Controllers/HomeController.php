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
        $this->middleware('guest:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $highly_rated_restaurants = Restaurant::sortable(['rating' => 'desc'])->limit(6)->get();
        $categories = Category::all();
        $new_restaurants = Restaurant::orderBy('created_at', 'desc')->limit(6)->get();

        $variables = [
            'highly_rated_restaurants',
            'categories',
            'new_restaurants',
        ];

        return view('home', compact($variables));
    }
}
