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
        // 予算のセレクトボックスの範囲
        $price_min = 500;
        $price_max = 10000;

        // 何円刻みにするか
        $price_unit = 500;

        // 検索ボックスに入力されたキーワードを取得する
        $keyword = $request->input('keyword');

        // 選択された予算を取得する
        $price = $request->input('price');

        // ページ数を取得する
        if ($request->has('page')) {
            $page = $request->input('page');
        } else {
            $page = 1;
        }

        // キーワードが存在すれば検索を行い、そうでなければ全件取得する
        if ($keyword) {
            $restaurants = Restaurant::where('name', 'like', "%{$keyword}%")->orderBy('created_at', 'asc')->paginate(15);
        } elseif ($price) {
            $restaurants = Restaurant::where('lowest_price', '<=', $price)->orderBy('created_at', 'desc')->paginate(15);
        } else {
            $restaurants = Restaurant::orderBy('created_at', 'desc')->paginate(15);
        }

        $total = $restaurants->total();

        $variables = [
            'price_min',
            'price_max',
            'price_unit',
            'restaurants',
            'keyword',
            'price',
            'page',
            'total',
        ];

        return view('restaurants.index', compact($variables));
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
