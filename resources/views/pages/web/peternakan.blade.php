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
$data = getPeternakanData();
//dd($data);
@endphp

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Dashboard Peternakan</h2>
        </div>
    </div>

    {{-- Cards Section --}}
    <div class="row mb-4">
        <div class="col-md-2">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Peternak</h6>
                            <h3>{{ $data['cards']['peternak'] }}</h3>
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
                            <h6>Pelaku Usaha</h6>
                            <h3>{{ $data['cards']['pelaku_usaha_peternakan'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="icon dripicons-help fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Poultry</h6>
                            <h3>{{ $data['cards']['poultry'] }}</h3>
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
                            <h6>Kios Daging</h6>
                            <h3>{{ $data['cards']['kios_daging'] }}</h3>
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
                            <h6>Gudang Telur</h6>
                            <h3>{{ $data['cards']['gudang_telur'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="icon dripicons-help fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-2">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Total Produksi</h6>
                            <h3>{{ number_format($data['total_produksi']) }}</h3>
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
                    <h5>Jumlah Peternak Berdasar Jenis Hewan</h5>
                </div>
                <div class="card-body">
                    <canvas id="peternakJenisChart" height="400"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Jumlah Peternak Berdasar Kelurahan</h5>
                </div>
                <div class="card-body">
                    <canvas id="peternakKelurahanChart" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Map Section --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Peta Lokasi Peternakan</h5>
                </div>
                <div class="card-body">
                    <div id="peternakMap" style="height: 500px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<!-- Leaflet JavaScript -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

{{-- Generate Chart Scripts --}}
{!! generateChartScript($data['chart_jenis'], 'peternakJenisChart', 'bar', 'Jumlah Peternak per Jenis Hewan') !!}
{!! generateChartScript($data['chart_kelurahan'], 'peternakKelurahanChart', 'doughnut', 'Distribusi per Kelurahan') !!}

{{-- Generate Map Script --}}
{!! generateMapScript($data['map_data'], 'peternakMap') !!}
