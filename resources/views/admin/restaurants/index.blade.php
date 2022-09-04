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
                    <p class="text-success">{{ session('flash_message') }}</p>
                @endif
                
                @foreach($restaurants as $restaurant)    
                    <div>
                        {{ $restaurant->id }}
                        {{ $restaurant->name }}
                        {{ $restaurant->address }}
                        <a href="{{ route('admin.restaurants.show', $restaurant) }}">詳細</a>            
                    </div>
                @endforeach

                {{ $restaurants->links() }}
            </div>
        </div>
    </div>
@endsection