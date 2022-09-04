@extends('layouts.app')

@section('content')
    <!-- 店舗の削除用モーダル -->
    <div class="modal fade" id="deleteRestaurantModal" tabindex="-1" aria-labelledby="deleteRestaurantModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteRestaurantModalLabel">「{{ $restaurant->name }}」を削除してもよろしいですか？</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger text-white">削除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col container">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-9">
                <h1 class="mt-3 mb-3 text-center fs-4">{{ $restaurant->name }}</h1>


                <div class="d-flex justify-content-between align-items-end mb-3">
                    <a href="{{ route('admin.restaurants.index') }}">&lt; 戻る</a>

                    <div>
                        <a href="{{ route('admin.restaurants.edit', $restaurant) }}" class="me-2">編集</a>
                        <a href="#" class="link-secondary" data-bs-toggle="modal" data-bs-target="#deleteRestaurantModal">削除</a>
                    </div>
                </div> 

                @if ($restaurant->image !== '')
                    <div class="mb-2">
                        <img src="{{ asset('storage/restaurants/' . $restaurant->image) }}" class="w-100">
                    </div>
                @endif

                <div class="container">
                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-2">
                            <span class="fw-bold">ID</span>          
                        </div>                                                  

                        <div class="col">
                            <span>{{ $restaurant->id }}</span>
                        </div>
                    </div>

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-2">
                            <span class="fw-bold">店舗名</span>
                        </div>

                        <div class="col">
                            <span>{{ $restaurant->name }}</span>
                        </div>
                    </div>                    

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-2">
                            <span class="fw-bold">説明</span>
                        </div>

                        <div class="col">
                            <span>{{ $restaurant->description }}</span>
                        </div>
                    </div>

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-2">
                            <span class="fw-bold">価格帯</span>
                        </div>

                        <div class="col">
                            <span>{{ number_format($restaurant->lowest_price) . '～' . number_format($restaurant->highest_price) }}円</span>
                        </div>
                    </div> 
                    
                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-2">
                            <span class="fw-bold">郵便番号</span>
                        </div>

                        <div class="col">
                            <span>{{ substr($restaurant->postal_code, 0, 3) . '-' . substr($restaurant->postal_code, 3) }}</span>
                        </div>
                    </div>   
                    
                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-2">
                            <span class="fw-bold">住所</span>
                        </div>

                        <div class="col">
                            <span>{{ $restaurant->address }}</span>
                        </div>
                    </div>    
                    
                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-2">
                            <span class="fw-bold">営業時間</span>
                        </div>

                        <div class="col">
                            <span>{{ date('G:i', strtotime($restaurant->opening_time)) . '～' . date('G:i', strtotime($restaurant->closing_time)) }}</span>
                        </div>
                    </div> 

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-2">
                            <span class="fw-bold">座席数</span>
                        </div>

                        <div class="col">
                            <span>{{ number_format($restaurant->seating_capacity) }}席</span>
                        </div>
                    </div>  
                    
                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-2">
                            <span class="fw-bold">カテゴリ</span>
                        </div>

                        <div class="col d-flex"> 
                            @if ($restaurant->categories()->exists())
                                @foreach ($restaurant->categories as $index => $category)
                                    <div>
                                        @if ($index === 0)
                                            {{ $category->name }}
                                        @else
                                            {{ '、' . $category->name }}
                                        @endif
                                    </div>
                                @endforeach                                
                            @else
                                <span>未設定</span>
                            @endif
                        </div>
                    </div>                    
                </div>                                               
            </div>                          
        </div>
    </div>     
@endsection