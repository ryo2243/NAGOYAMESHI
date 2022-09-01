@extends('layouts.app')

@section('content')
<h1>会員一覧</h1>
    @foreach($users as $user)    
        <div>
            {{ $user->id }}
            {{ $user->name }}
            {{ $user->email }}
            <a href="{{ route('admin.users.show', $user) }}">詳細</a>            
        </div>
    @endforeach

    {{ $users->links() }}
@endsection