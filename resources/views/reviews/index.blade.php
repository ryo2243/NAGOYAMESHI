@extends('layouts.app')

@section('content')
    <div class="container nagoyameshi-container pb-5">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-10">
                <nav class="my-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0"> 
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>                       
                        <li class="breadcrumb-item"><a href="{{ route('restaurants.index') }}">店舗一覧</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('restaurants.show', $restaurant) }}">店舗詳細</a></li>
                        <li class="breadcrumb-item active" aria-current="page">レビュー</li>
                    </ol>
                </nav> 

                <h1 class="mb-2 text-center">{{ $restaurant->name }}</h1> 
                <!-- 星評価のアイコンは0.5刻みにし、数値は小数点第3位以下を四捨五入する（小数点第2位まで表示する） -->
                <p class="text-center">
                    <span class="star-rating me-1" data-rate="{{ round($restaurant->reviews->avg('score') * 2) / 2 }}"></span>
                    {{ round($restaurant->reviews->avg('score'), 2) }}（{{ $restaurant->reviews->count() }}件）
                </p>                         

                @if (session('flash_message'))
                    <div class="alert alert-info" role="alert">
                        <p class="mb-0">{{ session('flash_message') }}</p>
                    </div>
                @endif 
                
                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item">
                        <a class="nav-link link-dark" href="{{ route('restaurants.show', $restaurant) }}">トップ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-dark" href="#">予約</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active bg-primary text-white" aria-current="page" href="{{ route('restaurants.reviews.index', $restaurant) }}">レビュー</a>
                    </li>
                </ul>  
                
                @foreach ($reviews as $review)
                    <!-- レビューの削除用モーダル -->
                    <div class="modal fade" id="deleteReviewModal{{ $review->id }}" tabindex="-1" aria-labelledby="deleteReviewModalLabel{{ $review->id }}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteReviewModalLabel{{ $review->id }}">レビューを削除してもよろしいですか？</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                                </div>
                                <div class="modal-footer">
                                    <form action="{{ route('restaurants.reviews.destroy', [$restaurant, $review]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger text-white shadow-sm">削除</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            @if ($review->user)
                                {{ $review->user->name }}さん
                            @else
                                退会済みの会員
                            @endif
                        </div>
                        @if ($review->user_id === Auth::id())
                            <div>
                                <a href="{{ route('restaurants.reviews.edit', [$restaurant, $review]) }}" class="me-2">編集</a>
                                <a href="#" class="link-secondary" data-bs-toggle="modal" data-bs-target="#deleteReviewModal{{ $review->id }}">削除</a>
                            </div>
                        @endif
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><span class="star-rating" data-rate="{{ $review->score }}"></span></li>
                        <li class="list-group-item">{{ $review->content }}</li>                        
                    </ul>
                    </div>                    
                @endforeach

                <div class="d-flex justify-content-center">
                    {{ $reviews->links() }}
                </div> 
                
                <!-- レビューを投稿済みでなければ表示する -->
                @if (!$restaurant->reviews()->where('user_id', Auth::id())->exists())
                    <div class="text-center mt-3">
                        <a href="{{ route('restaurants.reviews.create', $restaurant) }}" class="btn btn-primary text-white shadow-sm w-50">レビューを投稿する</a>                
                    </div>
                @endif
            </div>                          
        </div>
    </div>     
@endsection