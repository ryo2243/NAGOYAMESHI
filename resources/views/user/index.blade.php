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
                        <li class="breadcrumb-item active" aria-current="page">会員情報</li>
                    </ol>
                </nav> 
                
                <h1 class="mb-3 text-center">会員情報</h1>  

                <div class="d-flex justify-content-end align-items-end mb-3">                    
                    <div>
                        <a href="{{ route('user.edit') }}">編集</a>                        
                    </div>
                </div>                 

                @if (session('flash_message'))
                    <div class="alert alert-info" role="alert">
                        <p class="mb-0">{{ session('flash_message') }}</p>
                    </div>
                @endif 
                
                <div class="container mb-4">
                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">氏名</span>
                        </div>

                        <div class="col">
                            <span>{{ $user->name }}</span>
                        </div>
                    </div>                    

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">フリガナ</span>
                        </div>

                        <div class="col">
                            <span>{{ $user->kana }}</span>
                        </div>
                    </div>

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">メールアドレス</span>
                        </div>

                        <div class="col">
                            <span>{{ $user->email }}</span>
                        </div>
                    </div> 
                    
                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">郵便番号</span>
                        </div>

                        <div class="col">
                            <span>{{ substr($user->postal_code, 0, 3) . '-' . substr($user->postal_code, 3) }}</span>
                        </div>
                    </div>   
                    
                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">住所</span>
                        </div>

                        <div class="col">
                            <span>{{ $user->address }}</span>
                        </div>
                    </div>

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">電話番号</span>
                        </div>

                        <div class="col">
                            <span>{{ $user->phone_number }}</span>
                        </div>
                    </div>                    
                    
                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">誕生日</span>
                        </div>

                        <div class="col">
                            <span>
                                @if ($user->birthday !== null)
                                    {{ date('n月j日', strtotime($user->birthday)) }}
                                @else
                                    未設定
                                @endif                            
                            </span>
                        </div>
                    </div> 

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">職業</span>
                        </div>

                        <div class="col">
                            <span>
                                @if ($user->occupation !== null)
                                    {{ $user->occupation }}
                                @else
                                    未設定
                                @endif                            
                            </span>
                        </div>
                    </div>  
                </div>
            </div>                          
        </div>
    </div>       
@endsection