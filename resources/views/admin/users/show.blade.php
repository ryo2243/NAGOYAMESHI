@extends('layouts.app')

@section('content')
<h1>会員詳細</h1>      
<a href="{{ route('admin.users.index') }}">戻る</a>
<div>
    {{ $user->id }}
    {{ $user->name }}
    {{ $user->email }}                        
</div>        
@endsection