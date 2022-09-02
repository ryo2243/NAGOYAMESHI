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
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
            </div>
        </div>
    </div>
</div>


<h1>店舗詳細</h1>      
<a href="{{ route('admin.restaurants.index') }}">戻る</a>
<div>
    {{ $restaurant->id }}
    {{ $restaurant->name }}
    {{ $restaurant->address }}                        
</div>  
<a href="{{ route('admin.restaurants.edit', $restaurant) }}">編集</a>
<a href="#" data-bs-toggle="modal" data-bs-target="#deleteRestaurantModal">削除</a>      
@endsection