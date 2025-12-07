<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $pageTitle = "Admin"; // set dynamic page title
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
                        <div class="h5 font-weight-bold">Admin</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12 comp-grid " >
                    <div class=" ">@php
                        $periode_id = 1; // atau ambil dari request/session
                        $cards = getDashboardCards($periode_id);
                        $summary = getDashboardSummary($periode_id);
                        @endphp
                        {{-- Summary Card --}}
                        <div class="sakip">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card border-{{ $summary['progress_color'] }}">
                                        <div class="card-body">
                                            <h5 class="card-title">Progress Keseluruhan SAKIP</h5>
                                            <h2 class="mb-3">{{ $summary['total_terisi'] }} / {{ $summary['total_indikator'] }}</h2>
                                            <div class="progress" style="height: 25px;">
                                                <div class="progress-bar bg-{{ $summary['progress_color'] }}" 
                                                    role="progressbar" 
                                                    style="width: {{ $summary['progress_keseluruhan'] }}%"
                                                    aria-valuenow="{{ $summary['progress_keseluruhan'] }}" 
                                                    aria-valuemin="0" 
                                                    aria-valuemax="100">
                                                    {{ $summary['progress_keseluruhan'] }}%
                                                </div>
                                            </div>
                                            <small class="text-muted mt-2 d-block">
                                            {{ $summary['total_belum_terisi'] }} indikator belum terisi
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- Cards per Bidang --}}
                            <div class="row">
                                @foreach($cards as $card)
                                <div class="col-md-6 col-xl mb-4">
                                    <div class="card border-{{ $card['color'] }} h-100">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h5 class="card-title mb-0">{{ $card['bidang_name'] }}</h5>
                                                <i class="fas {{ $card['icon'] }} fa-2x text-{{ $card['color'] }}"></i>
                                            </div>
                                            <h3 class="mb-0">{{ $card['terisi'] }} / {{ $card['total_indikator'] }}</h3>
                                            <small class="text-muted">Indikator Terisi</small>
                                            <div class="progress mt-3" style="height: 20px;">
                                                <div class="progress-bar bg-{{ $card['progress_color'] }}" 
                                                    role="progressbar" 
                                                    style="width: {{ $card['progress'] }}%"
                                                    aria-valuenow="{{ $card['progress'] }}" 
                                                    aria-valuemin="0" 
                                                    aria-valuemax="100">
                                                    {{ $card['progress'] }}%
                                                </div>
                                            </div>
                                            <div class="mt-3">
                                                <small class="text-danger">
                                                <i class="fas fa-times-circle"></i> 
                                                {{ $card['belum_terisi'] }} belum terisi
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div></div>
                    </div>
                    <div class="col-12 comp-grid " >
                        <div class=" ">@php
                            $periode_id = 1; // atau ambil dari request/session
                            $cardsAdata = getDashboardCardsAdata($periode_id);
                            $summaryAdata = getDashboardSummaryAdata($periode_id);
                            @endphp
                            {{-- Summary Card Adata --}}
                            <div class="adata">
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="card border-{{ $summaryAdata['progress_color'] }}">
                                            <div class="card-body">
                                                <h5 class="card-title">Progress Keseluruhan Adata</h5>
                                                <h2 class="mb-3">{{ $summaryAdata['total_terisi'] }} / {{ $summaryAdata['total_indikator'] }}</h2>
                                                <div class="progress" style="height: 25px;">
                                                    <div class="progress-bar bg-{{ $summaryAdata['progress_color'] }}" 
                                                        role="progressbar" 
                                                        style="width: {{ $summaryAdata['progress_keseluruhan'] }}%"
                                                        aria-valuenow="{{ $summaryAdata['progress_keseluruhan'] }}" 
                                                        aria-valuemin="0" 
                                                        aria-valuemax="100">
                                                        {{ $summaryAdata['progress_keseluruhan'] }}%
                                                    </div>
                                                </div>
                                                <small class="text-muted mt-2 d-block">
                                                {{ $summaryAdata['total_belum_terisi'] }} data belum terisi
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Cards per Bidang Adata --}}
                                <div class="row">
                                    @foreach($cardsAdata as $card)
                                    <div class="col-md-6 col-xl mb-4">
                                        <div class="card border-{{ $card['color'] }} h-100">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h5 class="card-title mb-0">{{ $card['bidang_name'] }}</h5>
                                                    <i class="fas {{ $card['icon'] }} fa-2x text-{{ $card['color'] }}"></i>
                                                </div>
                                                <h3 class="mb-0">{{ $card['terisi'] }} / {{ $card['total_indikator'] }}</h3>
                                                <small class="text-muted">Data Terisi</small>
                                                <div class="progress mt-3" style="height: 20px;">
                                                    <div class="progress-bar bg-{{ $card['progress_color'] }}" 
                                                        role="progressbar" 
                                                        style="width: {{ $card['progress'] }}%"
                                                        aria-valuenow="{{ $card['progress'] }}" 
                                                        aria-valuemin="0" 
                                                        aria-valuemax="100">
                                                        {{ $card['progress'] }}%
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <small class="text-danger">
                                                    <i class="fas fa-times-circle"></i> 
                                                    {{ $card['belum_terisi'] }} belum terisi
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div></div></div>
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
