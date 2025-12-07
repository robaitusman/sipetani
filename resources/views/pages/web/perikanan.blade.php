<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
   
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Web"; //set dynamic page title
?>
@extends('layouts.app')

@section('head')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection

@section('content')
@php
$data = getPerikananData();
@endphp

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Dashboard Perikanan</h2>
        </div>
    </div>

    {{-- Cards Section --}}
    <div class="row mb-4">
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>BBI</h6>
                            <h3>{{ $data['cards']['bbi'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="icon dripicons-help fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Kelompok Ikan</h6>
                            <h3>{{ $data['cards']['kelompok_ikan'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="icon dripicons-help fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Ikan Hias</h6>
                            <h3>{{ $data['cards']['kelompok_ikan_hias'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="icon dripicons-help fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Pemasar Ikan</h6>
                            <h3>{{ $data['cards']['kelompok_pemasar_ikan'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="icon dripicons-help fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-2 col-sm-6 mb-3">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>TPI</h6>
                            <h3>{{ $data['cards']['tpi'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="icon dripicons-help fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Section --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Kelompok Berdasar Jenis Ikan</h5>
                </div>
                <div class="card-body">
                    <canvas id="perikananJenisChart" height="400"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Distribusi Perikanan per Kelurahan</h5>
                </div>
                <div class="card-body">
                    <canvas id="perikananKelurahanChart" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Map Section --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Peta Sebaran Perikanan</h5>
                </div>
                <div class="card-body">
                    <div id="perikananMap" style="height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

{{-- Generate Chart Scripts --}}
{!! generateChartScript($data['chart_jenis'], 'perikananJenisChart', 'doughnut', 'Kelompok per Jenis Ikan') !!}
{!! generateChartScript($data['chart_kelurahan'], 'perikananKelurahanChart', 'bar', 'Distribusi per Kelurahan') !!}

{{-- Generate Map Script --}}
{!! generateMapScript($data['map_data'], 'perikananMap') !!}
