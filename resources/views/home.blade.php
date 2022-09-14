@extends('layouts.app')

@push('fonts')
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@400;600&display=swap" rel="stylesheet">
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="{{ asset('/js/carousel.js') }}"></script>
@endpush

@section('content')
    <div>
        <div class="swiper">
            <div class="swiper-wrapper">    
                <div class="swiper-slide"><img src="{{ asset('/images/main1.jpg') }}"></div>
                <div class="swiper-slide"><img src="{{ asset('/images/main2.jpg') }}"></div>
                <div class="swiper-slide"><img src="{{ asset('/images/main3.jpg') }}"></div> 
                <div class="d-flex align-items-center overlay-background">
                    <div class="container nagoyameshi-container overlay-text">                    
                        <h1 class="text-white catchphrase-heading">名古屋ならではの味を、<br>見つけよう</h1>   
                        <p class="text-white catchphrase-paragraph">NAGOYAMESHIは、<br>名古屋市のB級グルメ専門のレビューサイトです。</p>                 
                    </div>    
                </div>      
            </div>
        </div>      
    </div>

    <div class="bg-light mb-4 py-4">
        <div class="container nagoyameshi-container">
            <h2 class="mb-3">キーワードから探す</h2>
            <form method="GET" action="{{ route('restaurants.index') }}" class="user-search-box">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="店舗名・エリア・カテゴリ" name="keyword">
                    <button type="submit" class="btn btn-primary text-white shadow-sm">検索</button> 
                </div>               
            </form>
        </div>
    </div>    

    <div class="container nagoyameshi-container">                                  
        <h2 class="mb-3">新規掲載店</h2>
        <div class="row row-cols-xl-6 row-cols-md-3 row-cols-2 g-3 mb-5">
            @foreach ($new_restaurants as $new_restaurant)                        
                <div class="col">
                    <a href="{{ route('admin.restaurants.show', $new_restaurant) }}" class="link-dark card-link">
                        <div class="card h-100">                                    
                            @if ($new_restaurant->image !== '')                                    
                                <img src="{{ asset('storage/restaurants/' . $new_restaurant->image) }}" class="card-img-top vertical-card-image"> 
                            @else
                                <img src="{{ asset('/images/no_image.jpg') }}" class="card-img-top vertical-card-image" alt="画像なし">
                            @endif                                                                                          
                            <div class="card-body">                                    
                                <h3 class="card-title">{{ $new_restaurant->name }}</h3>
                                <p class="card-text">{{ mb_substr($new_restaurant->description, 0, 30) }}@if (mb_strlen($new_restaurant->description) > 30)...@endif</p>                                    
                            </div>
                        </div>    
                    </a>            
                </div>                       
            @endforeach
        </div>

        <h2 class="mb-3">カテゴリから探す</h2>
        <div class="row row-cols-xl-6 row-cols-md-3 row-cols-2 g-3 mb-3">
            <div class="col">
                <a href="{{ route('admin.restaurants.index') }}/?category_id={{ $categories->where('name', '和食')->value('id') }}" class="card-link">
                    <div class="card text-white">
                        <img src="{{ asset('/images/washoku.jpg') }}" class="card-img vertical-card-image" alt="和食">
                        <div class="card-img-overlay d-flex justify-content-center align-items-center overlay-background">
                            <h3 class="card-title category-name">和食</h5>
                        </div>
                    </div>
                </a>
            </div> 

            <div class="col">
                <a href="{{ route('admin.restaurants.index') }}/?category_id={{ $categories->where('name', '和食')->value('id') }}" class="card-link">
                    <div class="card text-white">
                        <img src="{{ asset('/images/udon.jpg') }}" class="card-img vertical-card-image" alt="うどん">
                        <div class="card-img-overlay d-flex justify-content-center align-items-center overlay-background">
                            <h3 class="card-title category-name">うどん</h5>
                        </div>
                    </div>
                </a>
            </div>    
            
            <div class="col">
                <a href="{{ route('admin.restaurants.index') }}/?category_id={{ $categories->where('name', '丼物')->value('id') }}" class="card-link">
                    <div class="card text-white">
                        <img src="{{ asset('/images/don.jpg') }}" class="card-img vertical-card-image" alt="丼物">
                        <div class="card-img-overlay d-flex justify-content-center align-items-center overlay-background">
                            <h3 class="card-title category-name">丼物</h5>
                        </div>
                    </div>
                </a>
            </div> 
            
            <div class="col">
                <a href="{{ route('admin.restaurants.index') }}/?category_id={{ $categories->where('name', 'ラーメン')->value('id') }}" class="card-link">
                    <div class="card text-white">
                        <img src="{{ asset('/images/ramen.jpg') }}" class="card-img vertical-card-image" alt="ラーメン">
                        <div class="card-img-overlay d-flex justify-content-center align-items-center overlay-background">
                            <h3 class="card-title category-name">ラーメン</h5>
                        </div>
                    </div>
                </a>
            </div> 
            
            <div class="col">
                <a href="{{ route('admin.restaurants.index') }}/?category_id={{ $categories->where('name', 'おでん')->value('id') }}" class="card-link">
                    <div class="card text-white">
                        <img src="{{ asset('/images/oden.jpg') }}" class="card-img vertical-card-image" alt="おでん">
                        <div class="card-img-overlay d-flex justify-content-center align-items-center overlay-background">
                            <h3 class="card-title category-name">おでん</h5>
                        </div>
                    </div>
                </a>
            </div>  
            
            <div class="col">
                <a href="{{ route('admin.restaurants.index') }}/?category_id={{ $categories->where('name', '揚げ物')->value('id') }}" class="card-link">
                    <div class="card text-white">
                        <img src="{{ asset('/images/fried.jpg') }}" class="card-img vertical-card-image" alt="揚げ物">
                        <div class="card-img-overlay d-flex justify-content-center align-items-center overlay-background">
                            <h3 class="card-title category-name">揚げ物</h5>
                        </div>
                    </div>
                </a>
            </div>            
        </div>
        <div class="mb-5">
            @foreach ($categories as $category)
                @if ($category->name === '和食' || $category->name === 'うどん' || $category->name === '丼物' || $category->name === 'ラーメン' || $category->name === 'おでん' || $category->name === '揚げ物')
                    @continue
                @else
                    <a href="{{ route('admin.restaurants.index') }}/?category_id={{ $category->id }}" class="btn btn-outline-secondary btn-sm me-1 mb-2">{{ $category->name }}</a>
                @endif
            @endforeach
        </div>                                     
    </div>
@endsection
