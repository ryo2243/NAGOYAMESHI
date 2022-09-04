@extends('layouts.app')

@section('content')
    <div class="col container">
        <div class="row justify-content-center">
            <h1>会員詳細</h1>                  
            <div>
                {{ $user->id }}
                {{ $user->name }}
                {{ $user->email }}                        
            </div>     
        </div>
    </div>   
@endsection