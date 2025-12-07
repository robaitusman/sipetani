<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $pageTitle = "ketahananpangan"; // set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<div>
    <div  class="bg-light p-3 mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col comp-grid " >
                    <div class="">
                        <div class="h5 font-weight-bold">ketahananpangan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col comp-grid " >
                    <div class=" ">  
                        @php
                        $id_period = DB::table('periode_evaluasi')
                        ->where('status_periode', 'active')
                        ->value('id'); // langsung return nilai id, bukan object
                        $summary = getSummarySakip(auth()->id(), $id_period, auth()->user()->user_role_id);
                        //  dd($summary);
                        $percentage_adata = getSummaryAdata(auth()->user()->id, $id_period, auth()->user()->user_role_id);
                        @endphp
                        <h4 class="mb-2">Dashboard Sakip</h4>
                        <div class="row mb-4">
                            <!-- Persentase Input -->
                            <div class="col-md-4">
                                <div class="card text-white bg-primary shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Persentase Input</h6>
                                        <h3 class="mb-0">{{ $summary['persen'] }}%</h3>
                                        <small class="text-light">{{ $summary['sudah'] }} dari {{ $summary['total'] }} indikator</small>
                                    </div>
                                </div>
                            </div>
                            <!-- Belum Terinput -->
                            <div class="col-md-4">
                                <div class="card text-white bg-danger shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Belum Terinput</h6>
                                        <h3 class="mb-0">{{ $summary['belum'] }}</h3>
                                        <small class="text-light">indikator</small>
                                    </div>
                                </div>
                            </div>
                            <!-- Sudah Terinput -->
                            <div class="col-md-4">
                                <div class="card text-white bg-success shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Sudah Terinput</h6>
                                        <h3 class="mb-0">{{ $summary['sudah'] }}</h3>
                                        <small class="text-light">indikator</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="mb-2">Dashboard Adata</h4>
                        <div class="row mb-4">
                            <!-- Persentase Input -->
                            <div class="col-md-4">
                                <div class="card text-white bg-primary shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Persentase Input</h6>
                                        <h3 class="mb-0">{{ $percentage_adata['persen'] }}%</h3>
                                        <small class="text-light">{{ $percentage_adata['sudah'] }} dari {{ $percentage_adata['total'] }} indikator</small>
                                    </div>
                                </div>
                            </div>
                            <!-- Belum Terinput -->
                            <div class="col-md-4">
                                <div class="card text-white bg-danger shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Belum Terinput</h6>
                                        <h3 class="mb-0">{{ $percentage_adata['belum'] }}</h3>
                                        <small class="text-light">indikator</small>
                                    </div>
                                </div>
                            </div>
                            <!-- Sudah Terinput -->
                            <div class="col-md-4">
                                <div class="card text-white bg-success shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Sudah Terinput</h6>
                                        <h3 class="mb-0">{{ $percentage_adata['sudah'] }}</h3>
                                        <small class="text-light">indikator</small>
                                    </div>
                                </div>
                            </div>
                        </div></div></div>
                    </div>
                </div>
            </div>
        </div>
        <div  class="mb-3" >
            <div class="container-fluid">
                <div class="row ">
                    <div class="col comp-grid " >
                        <div class=" ">
                            <?php
                                $params = ['show_header' => false, 'show_footer' => false, 'show_pagination' => false, 'limit' => 10]; //new query param
                                $query = array_merge(request()->query(), $params);
                                $queryParams = http_build_query($query);
                                $url = url("periodeevaluasi/evaluasi?$queryParams");
                            ?>
                            <div class="ajax-inline-page" data-url="{{ $url }}" >
                                <div class="ajax-page-load-indicator">
                                    <div class="text-center d-flex justify-content-center load-indicator">
                                        <span class="loader mr-3"></span>
                                        <span class="fw-bold">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    <!-- Page custom css -->
    @section('pagecss')
    <style>
    </style>
    @endsection
    <!-- Page custom js -->
    @section('pagejs')
    <script>
        $(document).ready(function(){
        // custom javascript | jquery codes
        });
    </script>
    @endsection
