@extends('layouts.app')

@section('content')
    <div class="col container">
        <div class="row justify-content-center">
            <div class="col-xxl-8 col-xl-9 col-lg-10">
                <h1 class="mt-3 mb-3 text-center fs-4">店舗一覧</h1>

                <div class="d-flex justify-content-between align-items-end mb-3">
                    <p class="mb-0">計{{$total}}件</p>

                    <a href="{{ route('admin.restaurants.create') }}" class="btn btn-primary text-white">＋ 新規登録</a>
                </div>     
                
                @if (session('flash_message'))
                    <div class="alert alert-info" role="alert">
                        <p class="mb-0">{{ session('flash_message') }}</p>
                    </div>
                @endif 

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
                                <td><a href="{{ route('admin.restaurants.show', $restaurant) }}">詳細</a></td>
                            </tr>  
                        @endforeach
                    </tbody>
                </table>                        

                <div class="d-flex justify-content-center">
                    {{ $restaurants->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection