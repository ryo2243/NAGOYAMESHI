@extends('layouts.app')

@push('scripts')
    <script src="{{ asset('/js/reservation-modal.js') }}"></script>    
@endpush

@section('content')
    <!-- 予約のキャンセル用モーダル -->
    <div class="modal fade" id="cancelReservationModal" tabindex="-1" aria-labelledby="cancelReservationModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelReservationModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="閉じる"></button>
                </div>
                <div class="modal-footer">
                    <form action="" method="post" name="cancelReservationForm">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger text-white shadow-sm">削除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container nagoyameshi-container pb-5">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-10">
                <nav class="my-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0"> 
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">ホーム</a></li>                       
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">会員情報</a></li>
                        <li class="breadcrumb-item active" aria-current="page">会員情報編集</li>
                    </ol>
                </nav> 
                
                <h1 class="mb-3 text-center">会員情報編集</h1>  

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
                                                
                <form method="POST" action="{{ route('user.update') }}">
                    @csrf
                    @method('patch')
                    <div class="form-group row mb-3">
                        <label for="name" class="col-md-5 col-form-label text-md-left fw-bold">
                            <div class="d-flex align-items-center">
                                <span class="me-1">氏名</span>
                                <span class="badge bg-danger">必須</span>
                            </div>
                        </label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus placeholder="侍 太郎">
                        </div>
                    </div>   
                    
                    <div class="form-group row mb-3">
                        <label for="kana" class="col-md-5 col-form-label text-md-left fw-bold">
                            <div class="d-flex align-items-center">
                                <span class="me-1">フリガナ</span>
                                <span class="badge bg-danger">必須</span>
                            </div>
                        </label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" id="kana" name="kana" value="{{ old('kana', $user->kana) }}" required pattern="\A[ァ-ヴー\s]+\z" title="フリガナは全角カタカナで入力してください。" placeholder="サムライ タロウ">
                        </div>
                    </div>
                    
                    <div class="form-group row mb-3">
                        <label for="postal_code" class="col-md-5 col-form-label text-md-left fw-bold">
                            <div class="d-flex align-items-center">
                                <span class="me-1">郵便番号</span>
                                <span class="badge bg-danger">必須</span>
                            </div>
                        </label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}" required pattern="[0-9]{7}" title="郵便番号は7桁の半角数字で入力してください。" maxlength="7" autocomplete="postal-code" placeholder="1010022">
                        </div>
                    </div>  
                    
                    <div class="form-group row mb-3">
                        <label for="address" class="col-md-5 col-form-label text-md-left fw-bold">
                            <div class="d-flex align-items-center">
                                <span class="me-1">住所</span>
                                <span class="badge bg-danger">必須</span>
                            </div>
                        </label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address) }}" required placeholder="東京都千代田区神田練塀町300番地">
                        </div>
                    </div>        
                    
                    <div class="form-group row mb-3">
                        <label for="phone_number" class="col-md-5 col-form-label text-md-left fw-bold">
                            <div class="d-flex align-items-center">
                                <span class="me-1">電話番号</span>
                                <span class="badge bg-danger">必須</span>
                            </div>
                        </label>

                        <div class="col-md-7">
                            <input type="tel" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" required autocomplete="tel-national" minlength="10" maxlength="11" placeholder="09012345678">
                        </div>
                    </div> 
                    
                    <div class="form-group row mb-3">
                        <label for="birthday" class="col-md-5 col-form-label text-md-left fw-bold">誕生日</label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" id="birthday" name="birthday" value="{{ old('birthday', date('Ymd', strtotime($user->birthday))) }}" pattern="[0-9]{8}" title="誕生日は8桁の半角数字で入力してください。" maxlength="8" autocomplete="bday" placeholder="19950401">
                        </div>
                    </div>       
                    
                    <div class="form-group row mb-3">
                        <label for="occupation" class="col-md-5 col-form-label text-md-left fw-bold">職業</label>

                        <div class="col-md-7">
                            <input type="text" class="form-control" id="occupation" name="occupation" value="{{ old('occupation', $user->occupation) }}" placeholder="エンジニア">
                        </div>
                    </div>                 
                    
                    <div class="form-group row mb-3">
                        <label for="email" class="col-md-5 col-form-label text-md-left fw-bold">
                            <div class="d-flex align-items-center">
                                <span class="me-1">メールアドレス</span>
                                <span class="badge bg-danger">必須</span>
                            </div>
                        </label>

                        <div class="col-md-7">
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email" placeholder="taro.samurai@example.com">
                        </div>
                    </div> 

                    <hr class="my-4">

                    <div class="form-group d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary text-white shadow-sm w-50">更新</button>
                    </div>
                </form>                
                 
            </div>                          
        </div>
    </div>       
@endsection