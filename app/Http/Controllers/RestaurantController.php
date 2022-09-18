<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Category;
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

        // 選択されたカテゴリーのIDを取得する
        $category_id = $request->input('category_id');

        // 選択された予算を取得する
        $price = $request->input('price');

        // ページ数を取得する
        if ($request->has('page')) {
            $page = $request->input('page');
        } else {
            $page = 1;
        }

        $sorts = [
            '掲載日が新しい順' => 'created_at desc',
            '価格が安い順' => 'price asc',
            '評価が高い順' => 'rating desc',
            '予約数が多い順' => 'popular desc'
        ];

        $sort_query = [];
        $sorted = "created_at desc";

        if ($request->has('select_sort')) {
            $slices = explode(' ', $request->input('select_sort'));
            $sort_query[$slices[0]] = $slices[1];
            $sorted = $request->input('select_sort');
        }

        if ($keyword) {
            $restaurants = Restaurant::where('name', 'like', "%{$keyword}%")
                ->orWhere('address', 'like', "%{$keyword}%")
                ->orWhereHas('categories', function ($query) use ($keyword) {
                    $query->where('name', 'like', "%{$keyword}%");
                })
                ->sortable($sort_query)
                ->orderBy('created_at', 'desc')
                ->paginate(15);
        } elseif ($category_id) {
            $restaurants = Restaurant::WhereHas('categories', function ($query) use ($category_id) {
                $query->where('category_id', $category_id);
            })->sortable($sort_query)->orderBy('created_at', 'desc')->paginate(15);
        } elseif ($price) {
            $restaurants = Restaurant::where('lowest_price', '<=', $price)->sortable($sort_query)->orderBy('created_at', 'desc')->paginate(15);
        } else {
            $restaurants = Restaurant::sortable($sort_query)->orderBy('created_at', 'desc')->paginate(15);
        }

        $categories = Category::all();

        $total = $restaurants->total();

        $variables = [
            'price_min',
            'price_max',
            'price_unit',
            'restaurants',
            'categories',
            'keyword',
            'category_id',
            'price',
            'page',
            'total',
            'sorts',
            'sorted',
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
