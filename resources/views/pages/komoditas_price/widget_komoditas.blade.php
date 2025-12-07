@inject('comp_model', 'App\Models\ComponentsData')
<?php
    // Get latest komoditas price data directly from komoditas_price
    $records = collect();
    $previousRecords = collect();
    $displayDate = null;
    $previousDisplayDate = null;
    
    $latestDate = DB::table('komoditas_price')->whereNotNull('tanggal')->max('tanggal');
    if ($latestDate) {
        $records = DB::table('komoditas')
            ->join('komoditas_price', 'komoditas.id', '=', 'komoditas_price.id_komoditas')
            ->select('komoditas.nama', 'komoditas_price.tanggal', 'komoditas_price.kebutuhan', 'komoditas_price.ketersediaan', 'komoditas_price.harga', 'komoditas_price.id_komoditas')
            ->where('komoditas_price.tanggal', $latestDate)
            ->orderBy('komoditas_price.harga', 'desc')
            ->get();
        $displayDate = $latestDate;
        
        $previousDate = DB::table('komoditas_price')
            ->whereNotNull('tanggal')
            ->where('tanggal', '<', $latestDate)
            ->max('tanggal');
        if ($previousDate) {
            $previousDisplayDate = $previousDate;
            $previousRecords = DB::table('komoditas')
                ->join('komoditas_price', 'komoditas.id', '=', 'komoditas_price.id_komoditas')
                ->select('komoditas.nama', 'komoditas_price.tanggal', 'komoditas_price.kebutuhan', 'komoditas_price.ketersediaan', 'komoditas_price.harga', 'komoditas_price.id_komoditas')
                ->where('komoditas_price.tanggal', $previousDate)
                ->get()
                ->keyBy('id_komoditas');
        }
    }
    else{
        $latestTrans = DB::table('komoditas_price')->max('id_trans');
        if($latestTrans){
            $records = DB::table('komoditas')
                ->join('komoditas_price', 'komoditas.id', '=', 'komoditas_price.id_komoditas')
                ->select('komoditas.nama', 'komoditas_price.tanggal', 'komoditas_price.kebutuhan', 'komoditas_price.ketersediaan', 'komoditas_price.harga', 'komoditas_price.id_komoditas')
                ->where('komoditas_price.id_trans', $latestTrans)
                ->orderBy('komoditas_price.harga', 'desc')
                ->get();
            $displayDate = "Transaksi #$latestTrans";
            
            $previousTrans = DB::table('komoditas_price')
                ->where('id_trans', '<', $latestTrans)
                ->max('id_trans');
            if($previousTrans){
                $previousDisplayDate = "Transaksi #$previousTrans";
                $previousRecords = DB::table('komoditas')
                    ->join('komoditas_price', 'komoditas.id', '=', 'komoditas_price.id_komoditas')
                    ->select('komoditas.nama', 'komoditas_price.tanggal', 'komoditas_price.kebutuhan', 'komoditas_price.ketersediaan', 'komoditas_price.harga', 'komoditas_price.id_komoditas')
                    ->where('komoditas_price.id_trans', $previousTrans)
                    ->get()
                    ->keyBy('id_komoditas');
            }
        }
    }
    
    $pageTitle = "Harga Komoditas Pangan";
?>

@extends($layout ?? 'layouts.app')
@section('title', $pageTitle)
@section('content')

<div class="container-fluid py-4">
    @if($records->count() > 0)
        @php
            $formatLabel = function($value){
                if(!$value){
                    return null;
                }
                if(preg_match('/^\d{4}-\d{2}-\d{2}$/', $value)){
                    return \Carbon\Carbon::parse($value)->format('d F Y');
                }
                return $value;
            };
            $tanggal = $formatLabel($displayDate) ?? 'Data Terbaru';
            $previousLabel = $formatLabel($previousDisplayDate);
            
            // Define commodity icons based on type
            $commodityIcons = [
                'beras' => '🌾',
                'jagung' => '🌽', 
                'kedelai' => '🫘',
                'daging sapi' => '🥩',
                'daging ayam' => '🍗',
                'daging kambing' => '🥩',
                'daging babi' => '🥓',
                'telur' => '🥚',
                'susu' => '🥛',
                'minyak goreng' => '🛢️',
                'gula' => '🍯',
                'bawang merah' => '🧅',
                'bawang putih' => '🧄',
                'cabai' => '🌶️',
                'tomat' => '🍅',
                'kentang' => '🥔',
                'wortel' => '🥕',
                'bayam' => '🥬',
                'kangkung' => '🥬',
                'tahu' => '🟫',
                'tempe' => '🟤',
                'ikan' => '🐟',
                'udang' => '🦐',
                'cumi' => '🦑',
                'default' => '🛒'
            ];
            
            // Function to get icon based on commodity name
            if (!function_exists('getCommodityIcon')) {
                function getCommodityIcon($name, $icons) {
                    $name = strtolower($name);
                    foreach ($icons as $key => $icon) {
                        if (str_contains($name, $key)) {
                            return $icon;
                        }
                    }
                    return $icons['default'];
                }
            }
            
            // Process records with comparison data
            $processedRecords = $records->map(function($record) use ($previousRecords, $commodityIcons) {
                $record->icon = getCommodityIcon($record->nama, $commodityIcons);
                $record->unit = 'kg'; // Default unit
                
                // Get previous price for comparison
                $previousRecord = $previousRecords->get($record->id_komoditas);
                $record->previous_harga = $previousRecord ? $previousRecord->harga : $record->harga;
                $record->price_difference = $record->harga - $record->previous_harga;
                $record->price_percentage = $record->previous_harga > 0 ? 
                    (($record->price_difference / $record->previous_harga) * 100) : 0;
                
                return $record;
            });
            
            $chunks = $processedRecords->chunk(4);
        @endphp

        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center py-3">
                        <h4 class="mb-0 text-primary">
                            <i class="fas fa-shopping-cart me-2"></i>
                            Harga Komoditas Pangan - {{ $tanggal }}
                        </h4>
                        @if($previousLabel)
                            <small class="text-muted">
                                Dibandingkan dengan {{ $previousLabel }}
                            </small>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Price Cards Slider -->
        <div class="row">
            <div class="col-12">
                <div class="carousel-container">
                    <div id="commodityPriceCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($chunks as $chunkIndex => $chunk)
                                <div class="carousel-item @if($chunkIndex == 0) active @endif">
                                    <div class="row g-3">
                                        @foreach($chunk as $record)
                                            @php
                                                $isIncrease = $record->price_difference > 0;
                                                $isDecrease = $record->price_difference < 0;
                                                $supplyRatio = $record->kebutuhan > 0 ? 
                                                    ($record->ketersediaan / $record->kebutuhan) * 100 : 100;
                                                $supplyStatus = $supplyRatio >= 100 ? 'surplus' : 
                                                               ($supplyRatio >= 80 ? 'cukup' : 'kurang');
                                            @endphp
                                            
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                                <div class="card h-100 shadow-sm border-0 hover-card">
                                                    <div class="card-body p-3">
                                                        <!-- Icon and Title -->
                                                        <div class="d-flex align-items-center mb-3">
                                                            <div class="icon-wrapper me-3">
                                                                <span style="font-size: 2rem;">{{ $record->icon }}</span>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="card-title mb-0 fw-bold text-dark">
                                                                    {{ $record->nama }}
                                                                </h6>
                                                                <small class="text-muted">{{ $record->unit }}</small>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Price -->
                                                        <div class="price-section">
                                                            <h5 class="text-primary fw-bold mb-2">
                                                                Rp {{ number_format($record->harga, 0, ',', '.') }}
                                                                <small class="text-muted fw-normal">/ {{ $record->unit }}</small>
                                                            </h5>
                                                        </div>
                                                        
                                                        <!-- Supply Status -->
                                                        <div class="supply-status mb-2">
                                                            <small class="text-muted">Ketersediaan:</small>
                                                            @if($supplyStatus == 'surplus')
                                                                <span class="badge bg-success ms-1">Surplus</span>
                                                            @elseif($supplyStatus == 'cukup')
                                                                <span class="badge bg-warning ms-1">Cukup</span>
                                                            @else
                                                                <span class="badge bg-danger ms-1">Kurang</span>
                                                            @endif
                                                            <small class="text-muted ms-1">
                                                                ({{ number_format($supplyRatio, 1) }}%)
                                                            </small>
                                                        </div>
                                                        
                                                        <!-- Price Change -->
                                                        @if($previousDisplayDate && $record->price_difference != 0)
                                                            <div class="price-change">
                                                                <div class="d-flex align-items-center">
                                                                    @if($isIncrease)
                                                                        <i class="fas fa-arrow-up text-danger me-1"></i>
                                                                        <span class="text-danger fw-semibold">
                                                                            +{{ number_format(abs($record->price_percentage), 1) }}%
                                                                        </span>
                                                                    @elseif($isDecrease)
                                                                        <i class="fas fa-arrow-down text-success me-1"></i>
                                                                        <span class="text-success fw-semibold">
                                                                            -{{ number_format(abs($record->price_percentage), 1) }}%
                                                                        </span>
                                                                    @endif
                                                                    <small class="text-muted ms-2">
                                                                        (Rp {{ number_format(abs($record->price_difference), 0, ',', '.') }})
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div class="price-change">
                                                                <span class="text-muted">
                                                                    <i class="fas fa-minus me-1"></i>
                                                                    Tidak ada perubahan
                                                                </span>
                                                            </div>
                                                        @endif
                                                        
                                                        <!-- Supply Details -->
                                                        <div class="supply-details mt-2">
                                                            <div class="row text-center">
                                                                <div class="col-6">
                                                                    <small class="text-muted d-block">Kebutuhan</small>
                                                                    <span class="fw-semibold">{{ number_format($record->kebutuhan, 1) }}</span>
                                                                </div>
                                                                <div class="col-6">
                                                                    <small class="text-muted d-block">Tersedia</small>
                                                                    <span class="fw-semibold">{{ number_format($record->ketersediaan, 1) }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Bottom indicator -->
                                                    <div class="card-footer border-0 p-0">
                                                        @if($supplyStatus == 'surplus')
                                                            <div class="bg-success" style="height: 3px;"></div>
                                                        @elseif($supplyStatus == 'cukup')
                                                            <div class="bg-warning" style="height: 3px;"></div>
                                                        @else
                                                            <div class="bg-danger" style="height: 3px;"></div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Carousel Controls -->
                        @if($chunks->count() > 1)
                            <button class="carousel-control-prev custom-arrow-prev" type="button" data-bs-target="#commodityPriceCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-primary rounded-circle p-3" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next custom-arrow-next" type="button" data-bs-target="#commodityPriceCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-primary rounded-circle p-3" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                            
                            <!-- Indicators -->
                            <div class="carousel-indicators">
                                @foreach($chunks as $index => $chunk)
                                    <button type="button" data-bs-target="#commodityPriceCarousel" data-bs-slide-to="{{ $index }}" 
                                            class="@if($index == 0) active @endif" aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-3 col-6">
                                <div class="p-3">
                                    <h5 class="text-primary mb-1">{{ $records->count() }}</h5>
                                    <small class="text-muted">Total Komoditas</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="p-3">
                                    @php
                                        $avgPrice = $records->avg('harga');
                                    @endphp
                                    <h5 class="text-info mb-1">Rp {{ number_format($avgPrice, 0, ',', '.') }}</h5>
                                    <small class="text-muted">Harga Rata-rata</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="p-3">
                                    @php
                                        $maxPrice = $records->max('harga');
                                    @endphp
                                    <h5 class="text-warning mb-1">Rp {{ number_format($maxPrice, 0, ',', '.') }}</h5>
                                    <small class="text-muted">Harga Tertinggi</small>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="p-3">
                                    @php
                                        $minPrice = $records->min('harga');
                                    @endphp
                                    <h5 class="text-success mb-1">Rp {{ number_format($minPrice, 0, ',', '.') }}</h5>
                                    <small class="text-muted">Harga Terendah</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @else
        <div class="text-center py-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Data harga komoditas tidak tersedia</h5>
                    <p class="text-muted">Belum ada data harga komoditas yang dapat ditampilkan.</p>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
.hover-card {
    transition: all 0.3s ease;
    cursor: pointer;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.icon-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 12px;
}

.price-section {
    border-bottom: 1px solid #f8f9fa;
    padding-bottom: 10px;
    margin-bottom: 10px;
}

.supply-status {
    padding: 8px 0;
    border-bottom: 1px solid #f8f9fa;
}

.supply-details {
    background-color: #f8f9fa;
    padding: 8px;
    border-radius: 6px;
    margin-top: 8px;
}

/* Container padding for arrows */
.carousel-container {
    margin: 0 70px;
    position: relative;
}

.carousel {
    position: relative;
}

/* Custom arrow positioning */
.custom-arrow-prev {
    left: -60px;
    width: 50px;
    height: 50px;
    top: 50%;
    transform: translateY(-50%);
}

.custom-arrow-next {
    right: -60px;
    width: 50px;
    height: 50px;
    top: 50%;
    transform: translateY(-50%);
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    width: 2rem;
    height: 2rem;
}

.carousel-indicators {
    bottom: -50px;
}

.carousel-indicators [data-bs-target] {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background-color: #6c757d;
    border: none;
    opacity: 0.5;
}

.carousel-indicators .active {
    opacity: 1;
    background-color: #0d6efd;
}

/* Responsive breakpoints */
@media (max-width: 992px) {
    .carousel-container {
        margin: 0 50px;
    }
}

@media (max-width: 768px) {
    .carousel-container {
        margin: 0 20px;
    }
    
    .custom-arrow-prev {
        left: 10px;
    }
    
    .custom-arrow-next {
        right: 10px;
    }
}

@media (max-width: 576px) {
    .carousel-container {
        margin: 0 10px;
    }
    
    .custom-arrow-prev {
        left: 5px;
    }
    
    .custom-arrow-next {
        right: 5px;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-play carousel
    var carousel = new bootstrap.Carousel(document.getElementById('commodityPriceCarousel'), {
        interval: 6000,
        wrap: true
    });
    
    // Pause on hover
    document.getElementById('commodityPriceCarousel').addEventListener('mouseenter', function() {
        carousel.pause();
    });
    
    document.getElementById('commodityPriceCarousel').addEventListener('mouseleave', function() {
        carousel.cycle();
    });
    
    // Add click event for cards
    document.querySelectorAll('.hover-card').forEach(function(card) {
        card.addEventListener('click', function() {
            // You can add navigation logic here
            console.log('Card clicked:', this.querySelector('.card-title').textContent);
        });
    });
});
</script>
@endsection
