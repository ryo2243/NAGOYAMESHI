@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-xxl-6 col-xl-7 col-lg-8 col-md-10">

                <h1 class="mb-4 text-center">利用規約</h1>                                             

                <div class="container mb-4 terms">
                    {!! $term->content !!}     
                </div>                                               
            </div>                          
        </div>
    </div>       
@endsection