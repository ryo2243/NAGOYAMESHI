@extends('layouts.app')

@section('content')
    <div class="container nagoyameshi-container">
        <div class="row justify-content-center">
            <div class="col-3 pt-4">
                <nav class="mb-4" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">                        
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>
                        <li class="breadcrumb-item active" aria-current="page">店舗一覧</li>
                    </ol>
                </nav>                
                <form method="GET" action="{{ route('restaurants.index') }}" class="admin-search-box mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="店舗名で検索" name="keyword" value="{{ $keyword }}">
                        <button type="submit" class="btn btn-primary text-white shadow-sm">検索</button> 
                    </div>               
                </form>
            </div>

            <div class="col container py-5">
                <div class="row justify-content-center">
                    <div class="col-xxl-9 col-xl-10 col-lg-11">
                        <h1 class="mb-4 text-center">店舗一覧</h1>                     

                        <div>
                            <p class="mb-0">計{{ number_format($total) }}件</p>
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