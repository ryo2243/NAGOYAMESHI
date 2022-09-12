<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        // 検索ボックスに入力されたキーワードを取得する
        $keyword = $request->input('keyword');

        // キーワードが存在すれば検索を行い、そうでなければ全件取得する
        if ($keyword) {
            $restaurants = Restaurant::where('name', 'like', "%{$keyword}%")->paginate(15);
        } else {
            $restaurants = Restaurant::paginate(15);
        }

        $total = $restaurants->total();

        return view('restaurants.index', compact('restaurants', 'keyword', 'total'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant) {
        return view('restaurants.show', compact('restaurant'));
    }
}
