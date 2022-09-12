@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8">

                <h1 class="mb-4 text-center">会社概要</h1>                                    

                <div class="container mb-4">
                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">会社名</span>
                        </div>

                        <div class="col">
                            <span>{{ $company->name }}</span>
                        </div>
                    </div>                    

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">所在地</span>
                        </div>

                        <div class="col">
                            <span>{{ '〒' . substr($company->postal_code, 0, 3) . '-' . substr($company->postal_code, 3) . ' ' . $company->address }}</span>
                        </div>
                    </div>

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">代表者</span>
                        </div>

                        <div class="col">
                            <span>{{ $company->representative }}</span>
                        </div>
                    </div> 
                    
                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">設立</span>
                        </div>

                        <div class="col">
                            <span>{{ $company->establishment_date }}</span>
                        </div>
                    </div>   
                    
                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">資本金</span>
                        </div>

                        <div class="col">
                            <span>{{ $company->capital }}</span>
                        </div>
                    </div>

                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">事業内容</span>
                        </div>

                        <div class="col">
                            <span>{{ $company->business }}</span>
                        </div>
                    </div>                    
                    
                    <div class="row pb-2 mb-2 border-bottom">
                        <div class="col-3">
                            <span class="fw-bold">従業員数</span>
                        </div>

                        <div class="col">
                            <span>{{ $company->number_of_employees }}</span>
                        </div>
                    </div>                                       
                </div>                                               
            </div>                          
        </div>
    </div>       
@endsection