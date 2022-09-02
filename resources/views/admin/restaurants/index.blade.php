@extends('layouts.app')

@section('content')
    @if (session('flash_message'))
        <p class="text-success">{{ session('flash_message') }}</p>
    @endif
    
    <h1>店舗一覧</h1>
    <a href="{{ route('admin.restaurants.create') }}">新規登録</a>      
    @foreach($restaurants as $restaurant)    
        <div>
            {{ $restaurant->id }}
            {{ $restaurant->name }}
            {{ $restaurant->address }}
            <a href="{{ route('admin.restaurants.show', $restaurant) }}">詳細</a>            
        </div>
    @endforeach

    {{ $restaurants->links() }}
@endsection