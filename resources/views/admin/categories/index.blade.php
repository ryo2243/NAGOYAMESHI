@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('/js/modal.js') }}"></script>    
@endpush

@section('content')
<!-- カテゴリの登録用モーダル -->
<div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createCategoryModalLabel">カテゴリの登録</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <form action="{{ route('admin.categories.store') }}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="text" class="form-control" name="name">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">登録</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- カテゴリの編集用モーダル -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">カテゴリの編集</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <form action="" method="post" name="editCategoryForm">
                @csrf
                @method('patch')                                                                    
                <div class="modal-body">
                    <input type="text" class="form-control" name="name" value="">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">更新</button>
                </div>   
            </form>             
        </div>
    </div>
</div>

<!-- カテゴリの削除用モーダル -->
<div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCategoryModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
            </div>
            <div class="modal-footer">
                <form action="" method="post" name="deleteCategoryForm">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">削除</button>
                </form>
            </div>
        </div>
    </div>
</div>

<h1>カテゴリ一覧</h1>
<a href="#" data-bs-toggle="modal" data-bs-target="#createCategoryModal">新規登録</a>      
@foreach($categories as $category)    
    <div>
        {{ $category->id }}
        {{ $category->name }}        
        <a href="#" data-bs-toggle="modal" data-bs-target="#editCategoryModal" data-category-id="{{ $category->id }}" data-category-name="{{ $category->name }}">編集</a>
        <a href="#" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" data-category-id="{{ $category->id }}" data-category-name="{{ $category->name }}">削除</a>             
    </div>
@endforeach

{{ $categories->links() }}
@endsection