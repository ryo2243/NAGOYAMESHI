@extends('layouts.app')

@section('content')
    <div class="col container">
        <div class="row justify-content-center">
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
        </div>
    </div>
@endsection