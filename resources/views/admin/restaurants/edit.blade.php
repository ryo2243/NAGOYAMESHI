@extends('layouts.app')

@section('content')
<h1>店舗編集</h1>      
<a href="{{ route('admin.restaurants.show', $restaurant) }}">戻る</a>    
@endsection