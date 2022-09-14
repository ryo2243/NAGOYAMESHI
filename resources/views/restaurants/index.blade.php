@extends('layouts.app')

@section('content')
    <div class="container nagoyameshi-container pb-5">
        <div class="row justify-content-center">
            <nav class="my-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">                        
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
                    <li class="breadcrumb-item active" aria-current="page">店舗一覧</li>
                </ol>
            </nav>         

            <div class="col-lg-3 col-md-12">               
                <form method="GET" action="{{ route('restaurants.index') }}" class="w-100 mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="店舗名・エリア・カテゴリ" name="keyword" value="{{ $keyword }}">
                        <button type="submit" class="btn btn-primary text-white shadow-sm">検索</button> 
                    </div>               
                </form>

                <div class="card mb-3">
                    <div class="card-header">
                        予算から探す
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('restaurants.index') }}" class="w-100">
                            <div class="form-group mb-3">
                                <select class="form-control form-select" name="price">  
                                    <option hidden>選択してください</option>                              
                                    @for ($i = 0; $i <= ($price_max - $price_min) / $price_unit; $i++)
                                        {{ $each_price = $price_min + ($price_unit * $i) }}
                                        @if ($each_price == $price)                                        
                                            <option value="{{ $each_price }}" selected>{{ number_format($each_price) }}円</option>
                                        @else
                                            <option value="{{ $each_price }}">{{ number_format($each_price) }}円</option>
                                        @endif
                                    @endfor                                
                                </select> 
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary text-white shadow-sm w-100">検索</button>
                            </div>                                           
                        </form>
                    </div>
                </div>     
                
                <div class="card mb-3">
                    <div class="card-header">
                        予約可能なお店を探す
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('restaurants.index') }}" class="w-100">
                            <div class="form-group mb-3">
                                <select class="form-control form-select" name="price">  
                                    <option hidden>選択してください</option>                              
                                    @for ($i = 0; $i <= ($price_max - $price_min) / $price_unit; $i++)
                                        {{ $each_price = $price_min + ($price_unit * $i) }}
                                        @if ($each_price == $price)                                        
                                            <option value="{{ $each_price }}" selected>{{ number_format($each_price) }}円</option>
                                        @else
                                            <option value="{{ $each_price }}">{{ number_format($each_price) }}円</option>
                                        @endif
                                    @endfor                                
                                </select> 
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary text-white shadow-sm w-100">検索</button>
                            </div>                                           
                        </form>
                    </div>
                </div>                
            </div>

            <div class="col container">
                <div class="row justify-content-center">
                    <div class="col-xxl-10 col-xl-11 col-lg-12">                                       
                        <div class="d-flex justify-content-between flex-wrap">
                            <p class="mb-0">{{ number_format($total) }}件の店舗が見つかりました</p>                            
                            <select class="form-select form-select-sm sort-box" aria-label=".form-select-sm example">
                                <option selected>掲載日が新しい順</option>
                                <option value="1">価格が安い順</option>
                                <option value="2">評価が高い順</option>
                                <option value="3">予約数が多い順</option>
                            </select>                                                           
                        </div>                                

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">店舗名</th>
                                    <th scope="col">郵便番号</th>
                                    <th scope="col">住所</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>   
                            <tbody>                 
                                @foreach($restaurants as $restaurant)  
                                    <tr>
                                        <td>{{ $restaurant->id }}</td>
                                        <td>{{ $restaurant->name }}</td>
                                        <td>{{ substr($restaurant->postal_code, 0, 3) . '-' . substr($restaurant->postal_code, 3) }}</td>
                                        <td>{{ $restaurant->address }}</td>
                                        <td><a href="{{ route('restaurants.show', $restaurant) }}">詳細</a></td>
                                    </tr>  
                                @endforeach
                            </tbody>
                        </table>                        

                        <div class="d-flex justify-content-center">
                            {{ $restaurants->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection