@extends('layouts.app')

@section('content')
    <div class="col container">
        <div class="row justify-content-center">
            <div class="col-xxl-8 col-xl-9 col-lg-10">
                <h1 class="mt-3 mb-3 text-center fs-4">会員一覧</h1>     
                
                <div class="d-flex justify-content-between align-items-end mb-3">
                    <p class="mb-0">計{{$total}}件</p>
                </div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">氏名</th>
                            <th scope="col">郵便番号</th>
                            <th scope="col">住所</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>   
                    <tbody>                 
                        @foreach($users as $user)  
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ substr($user->postal_code, 0, 3) . '-' . substr($user->postal_code, 3) }}</td>
                                <td>{{ $user->address }}</td>
                                <td><a href="{{ route('admin.users.show', $user) }}">詳細</a></td>
                            </tr>  
                        @endforeach
                    </tbody>
                </table> 

                <div class="d-flex justify-content-center">
                    {{ $users->links() }}
                </div>                
            </div>                
        </div>
    </div>
@endsection