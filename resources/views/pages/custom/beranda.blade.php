<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php 
    $pageTitle = "beranda"; // set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<div>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12 comp-grid " >
                    <div class=" "><section id="services" class="services section-bg">
                        <div class="container aos-init aos-animate" data-aos="fade-up">
                            <div class="section-title">
                                <h2>Portal Data Sipetani Kota Bltiar</h2>
                                <p>Menyajikan data peternakan, pertaninan, perikanan dan komoditas harga di Kota Blitar</p>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-lg-3 d-flex align-items-stretch aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">
                                    <div class="icon-box">
                                        <div class="icon"><i class="bx bxl-dribbble"></i></div>
                                        <h4 class="title"><a href="">Peternakan</a></h4>
                                        <p class="description">Merekap data Peternak, Harga ternak, Poultry, Petshop, Kios Daging, Gudang telur dan data peternakan lainnya yang ada di kota Blitar</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3 d-flex align-items-stretch aos-init aos-animate" data-aos="zoom-in" data-aos-delay="200">
                                    <div class="icon-box">
                                        <div class="icon"><i class="bx bx-file"></i></div>
                                        <h4 class="title"><a href="">Pertanian</a></h4>
                                        <p class="description">Merekap data petani, kelompok tani, toko pertanian, pelaku usaha pertanian dan data pertanian lainnya ayang ada di kota Blitar</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3 d-flex align-items-stretch aos-init aos-animate" data-aos="zoom-in" data-aos-delay="300">
                                    <div class="icon-box">
                                        <div class="icon"><i class="bx bx-tachometer"></i></div>
                                        <h4 class="title"><a href="">Perikanan</a></h4>
                                        <p class="description">Merekap data Kelompok Pengolah, Kelompok Pemasar, Kelompok Pembudidaya dan data perikanan lainnya yang ada di kota Blitar</p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3 d-flex align-items-stretch aos-init aos-animate" data-aos="zoom-in" data-aos-delay="400">
                                    <div class="icon-box">
                                        <div class="icon"><i class="bx bx-world"></i></div>
                                        <h4 class="title"><a href="">Ketahanan Pangan</a></h4>
                                        <p class="description">Merekap data komoditas harga pokok yang ada di kota Blitar</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<div  class="mb-3" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col-12 comp-grid " >
                <div class=" reset-grids">
                    <?php
                        $params = [ 'limit' => 1]; //new query param
                        $query = array_merge(request()->query(), $params);
                        $queryParams = http_build_query($query);
                        $url = url("harga_ternak/widgetharga?$queryParams");
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
<div  class="mb-3" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12 comp-grid " >
                <div class=" ">
                    <section id="hero" class="d-flex align-items-center">
                        <div class="container">
                            <div class="row gy-4">
                                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                                    <h1>Selamat datang di Aplikasi Sipetani Kota Blitar</h1>
                                    <h2>Aplikasi Pengelolaan Data Bidang Ketahanan Pangan, Pertanian, Peternakan dan Perikanan </h2>
                                    <div>
                                        <a href="#about" class="btn-get-started scrollto">Get Started</a>
                                    </div>
                                </div>
                                <div class="col-lg-6 order-1 order-lg-2 hero-img">
                                    <img src="/images/hero.png" class="img-fluid animated" alt="">
                                </div>
                            </div>
                        </div>
                    </section></div>
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
