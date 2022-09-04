@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('/js/preview.js') }}"></script>
@endpush

@section('content')   
    <div class="col container">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">                        
                        <li class="breadcrumb-item"><a href="{{ route('admin.restaurants.index') }}">店舗一覧</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.restaurants.show', $restaurant) }}">店舗詳細</a></li>
                        <li class="breadcrumb-item active" aria-current="page">店舗編集</li>
                    </ol>
                </nav> 
                                
                <h1 class="mt-3 mb-3 text-center fs-4">店舗編集</h1>
                
                <hr class="mb-4">                

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.restaurants.update', $restaurant) }}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="form-group row mb-3">
                        <label for="name" class="col-md-5 col-form-label text-md-left fw-bold">店舗名</label>

                        <div class="col-md-7">
                            <input type="text" class="form-control nagoyameshi-login-input" id="name" name="name" value="{{ old('name', $restaurant->name) }}">
                        </div>
                    </div> 

                    <div class="form-group row mb-3">
                        <label for="image" class="col-md-5 col-form-label text-md-left fw-bold">店舗画像</label>
                        
                        <div class="col-md-7">
                            <input type="file" class="form-control nagoyameshi-login-input" id="image" name="image">
                        </div>
                    </div>   

                    <!-- 選択された画像の表示場所 -->
                    @if ($restaurant->image !== '')
                        <div class="row" id="imagePreview"><img src="{{ asset('storage/restaurants/'. $restaurant->image) }}" class="mb-3"></div>
                    @else
                        <div class="row" id="imagePreview"></div>  
                    @endif                                         

                    <div class="form-group row mb-3">
                        <label for="description" class="col-md-5 col-form-label text-md-left fw-bold">説明</label>

                        <div class="col-md-7">
                            <textarea class="form-control nagoyameshi-login-input" id="description" name="description" cols="30" rows="5">{{ old('description', $restaurant->description) }}</textarea>                            
                        </div>
                    </div> 
                    
                    <div class="form-group row mb-3">
                        <label for="lowest_price" class="col-md-5 col-form-label text-md-left fw-bold">最低価格</label>

                        <div class="col-md-7">
                            <select class="form-control form-select nagoyameshi-login-input" id="lowest_price" name="lowest_price">  
                                <option hidden>選択してください</option>                              
                                @for ($i = 0; $i <= ($lowest_price_max - $lowest_price_min) / $price_unit; $i++)
                                    {{ $lowest_price = $lowest_price_min + ($price_unit * $i) }}
                                    @if ($lowest_price == old('lowest_price', $restaurant->lowest_price))                                        
                                        <option value="{{ $lowest_price }}" selected>{{ number_format($lowest_price) }}円</option>
                                    @else
                                        <option value="{{ $lowest_price }}">{{ number_format($lowest_price) }}円</option>
                                    @endif
                                @endfor                                
                            </select>                            
                        </div>
                    </div> 
                    
                    <div class="form-group row mb-3">
                        <label for="highest_price" class="col-md-5 col-form-label text-md-left fw-bold">最高価格</label>

                        <div class="col-md-7">
                            <select class="form-control form-select nagoyameshi-login-input" id="highest_price" name="highest_price">
                                <option hidden>選択してください</option>
                                @for ($i = 0; $i <= ($highest_price_max - $highest_price_min) / $price_unit; $i++)
                                    {{ $highest_price = $highest_price_min + ($price_unit * $i) }}
                                    @if ($highest_price == old('highest_price', $restaurant->highest_price))                                        
                                        <option value="{{ $highest_price }}" selected>{{ number_format($highest_price) }}円</option>
                                    @else
                                        <option value="{{ $highest_price }}">{{ number_format($highest_price) }}円</option>
                                    @endif
                                @endfor                                  
                            </select>                            
                        </div>
                    </div>                     

                    <div class="form-group row mb-3">
                        <label for="postal_code" class="col-md-5 col-form-label text-md-left fw-bold">郵便番号</label>

                        <div class="col-md-7">
                            <input type="text" class="form-control nagoyameshi-login-input" id="postal_code" name="postal_code" value="{{ old('postal_code', $restaurant->postal_code) }}">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="address" class="col-md-5 col-form-label text-md-left fw-bold">住所</label>

                        <div class="col-md-7">
                            <input type="text" class="form-control nagoyameshi-login-input" id="address" name="address" value="{{ old('address', $restaurant->address) }}">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="opening_time" class="col-md-5 col-form-label text-md-left fw-bold">開店時間</label>

                        <div class="col-md-7">
                            <select class="form-control form-select nagoyameshi-login-input" id="opening_time" name="opening_time">
                                <option hidden>選択してください</option>
                                @for ($i = $opening_time_start * (60 / $time_unit); $i < $opening_time_end * (60 / $time_unit); $i++)
                                    {{ $opening_time = date('H:i', strtotime('00:00 +' . $i * $time_unit .' minute')) }}
                                    @if ($opening_time == old('opening_time', date('H:i', strtotime($restaurant->opening_time))))
                                        <option value="{{ $opening_time }}" selected>{{ $opening_time }}</option>
                                    @else
                                        <option value="{{ $opening_time }}">{{ $opening_time }}</option>
                                    @endif
                                @endfor                                
                            </select>                            
                        </div>
                    </div> 
                    
                    <div class="form-group row mb-3">
                        <label for="closing_time" class="col-md-5 col-form-label text-md-left fw-bold">閉店時間</label>

                        <div class="col-md-7">
                            <select class="form-control form-select nagoyameshi-login-input" id="closing_time" name="closing_time">
                                <option hidden>選択してください</option>
                                @for ($i = $closing_time_start * (60 / $time_unit); $i < $closing_time_end * (60 / $time_unit); $i++)
                                    {{ $closing_time = date('H:i', strtotime('00:00 +' . $i * $time_unit .' minute')) }}
                                    @if ($closing_time == old('closing_time', date('H:i', strtotime($restaurant->closing_time))))
                                        <option value="{{ $closing_time }}" selected>{{ $closing_time }}</option>
                                    @else
                                        <option value="{{ $closing_time }}">{{ $closing_time }}</option>
                                    @endif
                                @endfor                                
                            </select>                            
                        </div>
                    </div>                     

                    <div class="form-group row mb-3">
                        <label for="seating_capacity" class="col-md-5 col-form-label text-md-left fw-bold">座席数</label>

                        <div class="col-md-7">
                            <input type="number" class="form-control nagoyameshi-login-input" id="seating_capacity" name="seating_capacity" value="{{ old('seating_capacity', $restaurant->seating_capacity) }}">
                        </div>
                    </div>

                    @for ($i = 0; $i < 3; $i++)
                        <div class="form-group row mb-3">
                            <label for="category{{ $i + 1 }}" class="col-md-5 col-form-label text-md-left fw-bold">カテゴリ{{ $i + 1 }}（3つまで選択可）</label>

                            <div class="col-md-7">
                                <select class="form-control form-select nagoyameshi-login-input" id="category{{ $i + 1 }}" name="category_ids[]">  
                                    <option value="">選択なし</option>
                                    @if (old('category_ids'))
                                        @foreach ($categories as $category)                                        
                                            @if ($category->id == old("category_ids.{$i}"))                                        
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        @if (array_key_exists($i, $category_ids))
                                            @foreach ($categories as $category)                                        
                                                @if ($category->id == $category_ids[$i])                                        
                                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach ($categories as $category)                                                                                                                                                                                                                                  
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>                                                
                                            @endforeach 
                                        @endif       
                                    @endif  
                                </select>                            
                            </div>
                        </div>
                    @endfor   
                    
                    <hr class="my-4">

                    <div class="form-group d-flex justify-content-center mb-4">
                        <button type="submit" class="btn btn-primary text-white w-50">更新</button>
                    </div>
                </form>
            </div>
        </div>     
    </div>             
@endsection