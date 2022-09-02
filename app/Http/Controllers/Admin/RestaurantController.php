<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $restaurants = Restaurant::paginate(15);

        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        // 最低価格と最高価格のセレクトボックスの範囲
        $lowest_price_min = 500;
        $lowest_price_max = 10000;
        $highest_price_min = 500;
        $highest_price_max = 10000;

        // 何円刻みにするか
        $price_unit = 500;

        // 開店時間と閉店時間のセレクトボックスの範囲（単位：時）
        $opening_time_start = 0;
        $opening_time_end = 24;
        $closing_time_start = 0;
        $closing_time_end = 24;

        // 何分刻みにするか（単位：分）
        $time_unit = 15;

        $categories = Category::all();

        $variables = [
            'lowest_price_min',
            'lowest_price_max',
            'highest_price_min',
            'highest_price_max',
            'price_unit',
            'opening_time_start',
            'opening_time_end',
            'closing_time_start',
            'closing_time_end',
            'time_unit',
            'categories'
        ];

        return view('admin.restaurants.create', compact($variables));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'lowest_price' => 'required|numeric|min:0|lte:highest_price',
            'highest_price' => 'required|numeric|min:0|gte:lowest_price',
            'postal_code' => 'required|digits:7',
            'address' => 'required',
            'opening_time' => 'required|before:closing_time',
            'closing_time' => 'required|after:opening_time',
            'seating_capacity' => 'required|numeric|min:0',
        ]);

        $restaurant = new Restaurant();
        $restaurant->name = $request->input('name');
        $restaurant->description = $request->input('description');
        $restaurant->lowest_price = $request->input('lowest_price');
        $restaurant->highest_price = $request->input('highest_price');
        $restaurant->postal_code = $request->input('postal_code');
        $restaurant->address = $request->input('address');
        $restaurant->opening_time = $request->input('opening_time');
        $restaurant->closing_time = $request->input('closing_time');
        $restaurant->seating_capacity = $request->input('seating_capacity');
        $restaurant->save();

        $restaurant->categories()->sync(array_filter($request->input('category_ids')));

        return redirect()->route('admin.restaurants.index')->with('flash_message', '店舗を登録しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant) {
        return view('admin.restaurants.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant) {
        // 最低価格と最高価格のセレクトボックスの範囲
        $lowest_price_min = 500;
        $lowest_price_max = 10000;
        $highest_price_min = 500;
        $highest_price_max = 10000;

        // 何円刻みにするか
        $price_unit = 500;

        // 開店時間と閉店時間のセレクトボックスの範囲（単位：時）
        $opening_time_start = 0;
        $opening_time_end = 24;
        $closing_time_start = 0;
        $closing_time_end = 24;

        // 何分刻みにするか（単位：分）
        $time_unit = 15;

        $categories = Category::all();

        $variables = [
            'lowest_price_min',
            'lowest_price_max',
            'highest_price_min',
            'highest_price_max',
            'price_unit',
            'opening_time_start',
            'opening_time_end',
            'closing_time_start',
            'closing_time_end',
            'time_unit',
            'categories'
        ];

        return view('admin.restaurants.edit', compact($variables));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant) {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'lowest_price' => 'required|numeric|min:0|lte:highest_price',
            'highest_price' => 'required|numeric|min:0|gte:lowest_price',
            'postal_code' => 'required|digits:7',
            'address' => 'required',
            'opening_time' => 'required|before:closing_time',
            'closing_time' => 'required|after:opening_time',
            'seating_capacity' => 'required|numeric|min:0',
        ]);

        $restaurant->name = $request->input('name');
        $restaurant->description = $request->input('description');
        $restaurant->lowest_price = $request->input('lowest_price');
        $restaurant->highest_price = $request->input('highest_price');
        $restaurant->address = $request->input('address');
        $restaurant->opening_time = $request->input('opening_time');
        $restaurant->closing_time = $request->input('closing_time');
        $restaurant->seating_capacity = $request->input('seating_capacity');
        $restaurant->save();

        $restaurant->categories()->sync(array_filter($request->input('category_ids')));

        return redirect()->route('admin.restaurants.index')->with('flash_message', '店舗を編集しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant) {
        $restaurant->delete();

        return redirect()->route('admin.restaurants.index')->with('flash_message', '店舗を削除しました。');
    }
}
