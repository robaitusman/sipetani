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
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.min.js"></script>
@endsection

@section('content')
@php
$data = getKetahananPanganData();
@endphp

<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12">
            <h2>Dashboard Ketahanan Pangan</h2>
        </div>
    </div>

    {{-- Cards Section --}}
    <div class="row mb-4">
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Total Komoditas</h6>
                            <h3>{{ $data['cards']['komoditas'] }}</h3>
                        </div>
                        <div class="align-self-center">
                            <i class="icon dripicons-help fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Transaksi Terakhir</h6>
                            <h3>{{ $data['cards']['transaksi_terakhir'] }}</h3>
                            <small>{{ \Carbon\Carbon::parse($data['tanggal_terakhir'])->format('d/m/Y') }}</small>
                        </div>
                        <div class="align-self-center">
                            <i class="icon dripicons-help fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Total Kebutuhan</h6>
                            <h3>{{ number_format($data['total_kebutuhan'], 2) }}</h3>
                            <small>Data {{ \Carbon\Carbon::parse($data['tanggal_terakhir'])->format('d/m/Y') }}</small>
                        </div>
                        <div class="align-self-center">
                            <i class="icon dripicons-help fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 col-sm-6 mb-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6>Total Ketersediaan</h6>
                            <h3>{{ number_format($data['total_ketersediaan'], 2) }}</h3>
                            <small>Data {{ \Carbon\Carbon::parse($data['tanggal_terakhir'])->format('d/m/Y') }}</small>
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
                    <h5>Harga Komoditas Terbaru</h5>
                </div>
                <div class="card-body" style="height: 400px;">
                    <canvas id="ketpanHargaChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5>Perbandingan Kebutuhan vs Ketersediaan</h5>
                </div>
                <div class="card-body" style="height: 400px;">
                    <canvas id="ketpanSupplyDemandChart"></canvas>
                </div>
            </div>
        </div>
    </div>

   

    {{-- Data Table Section --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Data Harga Komoditas Terkini</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Komoditas</th>
                                    <th>Harga (Rp)</th>
                                    <th>Kebutuhan</th>
                                    <th>Ketersediaan</th>
                                    <th>Status</th>
                                    <th>Rasio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data['chart_jenis_alternative'] as $index => $item)
                                @php
                                    $rasio = $item->kebutuhan > 0 ? ($item->ketersediaan / $item->kebutuhan) * 100 : 0;
                                    $statusClass = $rasio >= 100 ? 'success' : ($rasio >= 50 ? 'warning' : 'danger');
                                    $statusText = $rasio >= 100 ? 'Surplus' : ($rasio >= 50 ? 'Cukup' : 'Kurang');
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><strong>{{ $item->nama }}</strong></td>
                                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>{{ number_format($item->kebutuhan, 2) }}</td>
                                    <td>{{ number_format($item->ketersediaan, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $statusClass }}">{{ $statusText }}</span>
                                    </td>
                                    <td>
                                        <div class="progress" style="height: 20px;">
                                            <div class="progress-bar bg-{{ $statusClass }}" 
                                                 role="progressbar" 
                                                 style="width: {{ min($rasio, 100) }}%"
                                                 aria-valuenow="{{ $rasio }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                {{ number_format($rasio, 1) }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data komoditas</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('=== KETAHANAN PANGAN DASHBOARD ===');
    
    // Prepare data from PHP - gunakan alternative data yang ada isi
    var chartData = @json($data['chart_jenis_alternative']);
    
    console.log('Chart Data:', chartData);

    // Helper function to set chart height
    function setChartHeight(canvasId, height = 400) {
        var canvas = document.getElementById(canvasId);
        if (canvas && canvas.parentElement) {
            canvas.parentElement.style.height = height + 'px';
        }
    }

    // 1. Chart Harga Komoditas
    var hargaLabels = chartData.map(item => item.nama);
    var hargaData = chartData.map(item => item.harga);
    
    var ctx1 = document.getElementById('ketpanHargaChart');
    if (ctx1 && hargaLabels.length > 0) {
        console.log('Creating Harga Chart...');
        var hargaChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: hargaLabels,
                datasets: [{
                    label: 'Harga (Rp)',
                    data: hargaData,
                    backgroundColor: 'rgba(54, 162, 235, 0.8)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Harga Komoditas Terbaru'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
        console.log('Harga Chart created successfully');
    }

    // 2. Chart Supply vs Demand
    var kebutuhanData = chartData.map(item => item.kebutuhan);
    var ketersediaanData = chartData.map(item => item.ketersediaan);
    
    var ctx2 = document.getElementById('ketpanSupplyDemandChart');
    if (ctx2 && hargaLabels.length > 0) {
        console.log('Creating Supply Demand Chart...');
        var supplyDemandChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: hargaLabels,
                datasets: [{
                    label: 'Kebutuhan',
                    data: kebutuhanData,
                    backgroundColor: 'rgba(255, 99, 132, 0.8)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }, {
                    label: 'Ketersediaan',
                    data: ketersediaanData,
                    backgroundColor: 'rgba(75, 192, 192, 0.8)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Kebutuhan vs Ketersediaan'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        console.log('Supply Demand Chart created successfully');
    }

    // 3. Chart Top 10 Termahal
    var sortedData = [...chartData].sort((a, b) => b.harga - a.harga).slice(0, 10);
    var topLabels = sortedData.map(item => item.nama);
    var topHarga = sortedData.map(item => item.harga);
    
    var ctx3 = document.getElementById('ketpanTopChart');
    if (ctx3 && topLabels.length > 0) {
        console.log('Creating Top Chart...');
        var topChart = new Chart(ctx3, {
            type: 'horizontalBar',
            data: {
                labels: topLabels,
                datasets: [{
                    label: 'Harga (Rp)',
                    data: topHarga,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 205, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)',
                        'rgba(199, 199, 199, 0.8)',
                        'rgba(83, 102, 255, 0.8)',
                        'rgba(255, 99, 255, 0.8)',
                        'rgba(99, 255, 132, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                indexAxis: 'y',
                plugins: {
                    title: {
                        display: true,
                        text: 'Top 10 Komoditas Termahal'
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
        console.log('Top Chart created successfully');
    }

    // 4. Chart Distribusi Harga (Pie Chart)
    var ctx4 = document.getElementById('ketpanDistribusiChart');
    if (ctx4 && hargaLabels.length > 0) {
        console.log('Creating Distribusi Chart...');
        var distribusiChart = new Chart(ctx4, {
            type: 'doughnut',
            data: {
                labels: hargaLabels,
                datasets: [{
                    label: 'Harga',
                    data: hargaData,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 205, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)',
                        'rgba(199, 199, 199, 0.8)',
                        'rgba(83, 102, 255, 0.8)',
                        'rgba(255, 99, 255, 0.8)',
                        'rgba(99, 255, 132, 0.8)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Distribusi Harga Komoditas'
                    },
                    legend: {
                        position: 'right'
                    }
                }
            }
        });
        console.log('Distribusi Chart created successfully');
    }
    
    console.log('=== END KETAHANAN PANGAN DASHBOARD ===');
});
</script>
@endsection