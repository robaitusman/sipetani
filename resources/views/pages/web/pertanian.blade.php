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
$data = getPertanianData();
@endphp

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Dashboard Pertanian</h2>
        </div>
    </div>

    {{-- Cards Section --}}
    <div class="row mb-4">
        <div class="col-md-2">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Kios Pupuk</h6>
                            <h3>{{ $data['cards']['kios_pupuk'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="icon dripicons-help fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Pelaku Usaha Tani</h6>
                            <h3>{{ $data['cards']['pelaku_usaha_tani'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="icon dripicons-help fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>PUPO</h6>
                            <h3>{{ $data['cards']['pupo'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="icon dripicons-help fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Toko Tani</h6>
                            <h3>{{ $data['cards']['toko_tani'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="icon dripicons-help fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="card bg-danger text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>P4S</h6>
                            <h3>{{ $data['cards']['p4s'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="icon dripicons-help fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Kelompok Tani</h6>
                            <h3>{{ $data['cards']['kel_tani'] }}</h3>
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
                    <h5>Jenis Kelompok Tani</h5>
                </div>
                <div class="card-body">
                    <canvas id="pertanianJenisChart" height="400"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Distribusi Pertanian per Kelurahan</h5>
                </div>
                <div class="card-body">
                    <canvas id="pertanianKelurahanChart" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Map Section --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Peta Sebaran Pertanian</h5>
                </div>
                <div class="card-body">
                    <div id="pertanianMap" style="height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

{{-- Generate Chart Scripts --}}
{!! generateChartScript($data['chart_jenis'], 'pertanianJenisChart', 'pie', 'Jenis Kelompok Tani') !!}
{!! generateChartScript($data['chart_kelurahan'], 'pertanianKelurahanChart', 'bar', 'Distribusi per Kelurahan') !!}

{{-- Generate Map Script --}}
{!! generateMapScript($data['map_data'], 'pertanianMap') !!}

