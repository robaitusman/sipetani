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
    $pageTitle = "Harga Ternak"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
{{-- resources/views/pages/harga_ternak/widgetharga.blade.php --}}
<div class="container-fluid py-4">
    @if($records->count() > 0)
        @php
            $latestRecord = $records->first();
            $tanggal = \Carbon\Carbon::parse($latestRecord->tanggal)->format('d F Y');
            
            // Define price fields with their icons and labels
            $priceFields = [
                'kambing' => ['icon' => '🐐', 'label' => 'Kambing', 'unit' => 'ekor'],
                'domba' => ['icon' => '🐑', 'label' => 'Domba', 'unit' => 'ekor'],
                'ayam_pedaging' => ['icon' => '🐔', 'label' => 'Ayam Pedaging', 'unit' => 'kg'],
                'ayam_petelur' => ['icon' => '🐓', 'label' => 'Ayam Petelur', 'unit' => 'ekor'],
                'ayam_petelur_afkir' => ['icon' => '🐔', 'label' => 'Ayam Petelur Afkir', 'unit' => 'kg'],
                'burung_puyuh' => ['icon' => '🦆', 'label' => 'Burung Puyuh', 'unit' => 'ekor'],
                'burung_dara' => ['icon' => '🕊️', 'label' => 'Burung Dara', 'unit' => 'ekor'],
                'itik' => ['icon' => '🦆', 'label' => 'Itik', 'unit' => 'ekor'],
                'entok' => ['icon' => '🦆', 'label' => 'Entok', 'unit' => 'ekor'],
                'susu_sapi' => ['icon' => '🥛', 'label' => 'Susu Sapi', 'unit' => 'liter'],
                'susu_kambing' => ['icon' => '🥛', 'label' => 'Susu Kambing', 'unit' => 'liter'],
                'daging_sapi' => ['icon' => '🥩', 'label' => 'Daging Sapi', 'unit' => 'kg'],
                'daging_ayam' => ['icon' => '🍗', 'label' => 'Daging Ayam', 'unit' => 'kg'],
                'daging_kambing' => ['icon' => '🥩', 'label' => 'Daging Kambing', 'unit' => 'kg'],
                'daging_bebek' => ['icon' => '🦆', 'label' => 'Daging Bebek', 'unit' => 'kg'],
                'harga_telur' => ['icon' => '🥚', 'label' => 'Telur', 'unit' => 'kg'],
            ];
            
            // Get previous record for comparison
            $previousRecord = null;
            if($records->count() > 1) {
                $previousRecord = $records->skip(1)->first();
            }
            
            // Filter only fields that have values
            $availableFields = collect($priceFields)->filter(function($config, $field) use ($latestRecord) {
                return isset($latestRecord->$field) && $latestRecord->$field > 0;
            });
            
            $chunks = $availableFields->chunk(4);
        @endphp

        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center py-3">
                        <h4 class="mb-0 text-primary">
                            <i class="fas fa-calendar-alt me-2"></i>
                            Harga Ternak - {{ $tanggal }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>

    
        <!-- Price Cards Slider -->
        <div class="row">
            <div class="col-12">
                <div class="carousel-container">
                    <div id="priceCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($chunks as $chunkIndex => $chunk)
                                <div class="carousel-item @if($chunkIndex == 0) active @endif">
                                    <div class="row g-3">
                                        @foreach($chunk as $field => $config)
                                            @php
                                                $currentPrice = $latestRecord->$field;
                                                $previousPrice = $previousRecord && isset($previousRecord->$field) ? $previousRecord->$field : $currentPrice;
                                                $difference = $currentPrice - $previousPrice;
                                                $percentage = $previousPrice > 0 ? (($difference / $previousPrice) * 100) : 0;
                                                $isIncrease = $difference > 0;
                                                $isDecrease = $difference < 0;
                                            @endphp
                                            
                                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                                <div class="card h-100 shadow-sm border-0 hover-card">
                                                    <div class="card-body p-3">
                                                        <!-- Icon and Title -->
                                                        <div class="d-flex align-items-center mb-3">
                                                            <div class="icon-wrapper me-3">
                                                                <span style="font-size: 2rem;">{{ $config['icon'] }}</span>
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h6 class="card-title mb-0 fw-bold text-dark">
                                                                    {{ $config['label'] }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                        
                                                        <!-- Price -->
                                                        <div class="price-section">
                                                            <h5 class="text-primary fw-bold mb-2">
                                                                Rp {{ number_format($currentPrice, 0, ',', '.') }}
                                                                <small class="text-muted fw-normal">/ {{ $config['unit'] }}</small>
                                                            </h5>
                                                        </div>
                                                        
                                                        <!-- Price Change -->
                                                        @if($previousRecord && $difference != 0)
                                                            <div class="price-change">
                                                                <div class="d-flex align-items-center">
                                                                    @if($isIncrease)
                                                                        <i class="fas fa-arrow-up text-success me-1"></i>
                                                                        <span class="text-success fw-semibold">
                                                                            {{ number_format(abs($percentage), 2) }}%
                                                                        </span>
                                                                    @elseif($isDecrease)
                                                                        <i class="fas fa-arrow-down text-danger me-1"></i>
                                                                        <span class="text-danger fw-semibold">
                                                                            {{ number_format(abs($percentage), 2) }}%
                                                                        </span>
                                                                    @endif
                                                                    <small class="text-muted ms-2">
                                                                        (Rp {{ number_format(abs($difference), 0, ',', '.') }})
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
                                                    </div>
                                                    
                                                    <!-- Bottom indicator -->
                                                    <div class="card-footer border-0 p-0">
                                                        @if($isIncrease)
                                                            <div class="bg-success" style="height: 3px;"></div>
                                                        @elseif($isDecrease)
                                                            <div class="bg-danger" style="height: 3px;"></div>
                                                        @else
                                                            <div class="bg-secondary" style="height: 3px;"></div>
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
                            <button class="carousel-control-prev custom-arrow-prev" type="button" data-bs-target="#priceCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-primary rounded-circle p-3" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next custom-arrow-next" type="button" data-bs-target="#priceCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-primary rounded-circle p-3" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                            
                            <!-- Indicators -->
                            <div class="carousel-indicators">
                                @foreach($chunks as $index => $chunk)
                                    <button type="button" data-bs-target="#priceCarousel" data-bs-slide-to="{{ $index }}" 
                                            class="@if($index == 0) active @endif" aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <i class="fas fa-chart-line fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Data harga ternak tidak tersedia</h5>
                    <p class="text-muted">Belum ada data harga ternak yang dapat ditampilkan.</p>
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
    var carousel = new bootstrap.Carousel(document.getElementById('priceCarousel'), {
        interval: 5000,
        wrap: true
    });
    
    // Pause on hover
    document.getElementById('priceCarousel').addEventListener('mouseenter', function() {
        carousel.pause();
    });
    
    document.getElementById('priceCarousel').addEventListener('mouseleave', function() {
        carousel.cycle();
    });
});
</script>
@endsection
