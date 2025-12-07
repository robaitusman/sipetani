        <!-- 
        expose component model to current view
        e.g $arrDataFromDb = $comp_model->fetchData(); //function name
        -->
        @inject('comp_model', 'App\Models\ComponentsData')
        <?php 
            $pageTitle = "sipetani"; // set page title
        ?>
        @extends($layout)
        @section('title', $pageTitle)
        @section('content')
        <div>
            <div  class="mb-3" >
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-md-12 comp-grid " >
                            <div class=" ">
                                <section id="hero" class="d-flex align-items-center">
                                    <div class="container">
                                        <div class="row gy-4">
                                            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                                                <h3>Selamat datang di <h3>  <h1>Sipetani Kota Blitar</h1><br>
                                                <h3>Aplikasi Pengelolaan Data Bidang Ketahanan Pangan, Pertanian, Peternakan dan Perikanan </h3>
                                                
                                            </div>
                                            <div class="col-lg-6 order-1 order-lg-2 hero-img">
                                                <img src="/images/hero1.png" class="img-fluid animated" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </section></div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div  class="mt-5 mb-3" >
                    <div class="container-fluid">
                        <div class="row ">
                            <div class="col-12 comp-grid " >
                                <div class=" "><section id="services" class="services section-bg">
                                    <div class="container aos-init aos-animate" data-aos="fade-up">
                                        <div class="section-title">
                                            <h3>Portal Data Sipetani Kota Blitar</h3>
                                            <p>Menyajikan data peternakan, pertaninan, perikanan dan komoditas harga di Kota Blitar</p>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-3 d-flex align-items-stretch aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">
                                                <div class="icon-box">
                                                    <div class="icon"><i class="bx bxl-dribbble"></i></div>
                                                    <h4 class="title"><a href="/web/peternakan">Peternakan</a></h4>
                                                    <p class="description">Merekap data Peternak, Harga ternak, Poultry, Petshop, Kios Daging, Gudang telur dan data peternakan lainnya yang ada di kota Blitar</p>
                                                    <a class="btn bt-sm btn-primary" href="/web/peternakan">lihat data</a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3 d-flex align-items-stretch aos-init aos-animate" data-aos="zoom-in" data-aos-delay="200">
                                                <div class="icon-box">
                                                    <div class="icon"><i class="bx bx-file"></i></div>
                                                    <h4 class="title"><a href="/web/pertanian">Pertanian</a></h4>
                                                    <p class="description">Merekap data petani, kelompok tani, toko pertanian, pelaku usaha pertanian dan data pertanian lainnya ayang ada di kota Blitar</p>
                                                     <a class="btn bt-sm btn-primary" href="/web/pertanian">lihat data</a>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3 d-flex align-items-stretch aos-init aos-animate" data-aos="zoom-in" data-aos-delay="300">
                                                <div class="icon-box">
                                                    <div class="icon"><i class="bx bx-tachometer"></i></div>
                                                    <h4 class="title"><a href="/web/perikanan">Perikanan</a></h4>
                                                    <p class="description">Merekap data Kelompok Pengolah, Kelompok Pemasar, Kelompok Pembudidaya dan data perikanan lainnya yang ada di kota Blitar</p>
                                                  <a class="btn bt-sm btn-primary" href="/web/perikanan">lihat data</a>   
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-lg-3 d-flex align-items-stretch aos-init aos-animate" data-aos="zoom-in" data-aos-delay="400">
                                                <div class="icon-box">
                                                    <div class="icon"><i class="bx bx-world"></i></div>
                                                    <h4 class="title"><a href="/web/ketahananpangan">Ketahanan Pangan</a></h4>
                                                    <p class="description">Merekap data komoditas harga pokok yang ada di kota Blitar</p>
                                                     <a class="btn bt-sm btn-primary" href="/web/ketahananpangan">lihat data</a>
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
                <br>
                <br>
            <div  class="mt-5 mb-5" >
                <div class="container-fluid">
                    <div class="row ">
                        <div class="col-12 comp-grid " >
                            <div class=" ">
                                <?php
                                    $params = ['show_header' => false, 'show_footer' => false, 'show_pagination' => false, 'limit' => 10]; //new query param
                                    $query = array_merge(request()->query(), $params);
                                    $queryParams = http_build_query($query);
                                    $url = url("komoditas_price/widget_komoditas?$queryParams");
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
                <br>
         
            <div  class="mt-5 mb-5" >
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
                    <div class="row justify-content-center">
                        <div class="col col-sm-6 col-md-3 col-lg-3 comp-grid " >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        <!-- Page custom css -->
        @section('pagecss')
        <style>
        <style>
        /* Slick Slider Css Ruls */
        .slick-slider {
        position: relative;
        display: block;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -webkit-touch-callout: none;
        -khtml-user-select: none;
        -ms-touch-action: pan-y;
        touch-action: pan-y;
        -webkit-tap-highlight-color: transparent
        }
        .slick-list {
        position: relative;
        display: block;
        overflow: hidden;
        margin: 0;
        padding: 0
        }
        .slick-list:focus {
        outline: none
        }
        .slick-list.dragging {
        cursor: hand
        }
        .slick-slider .slick-track,
        .slick-slider .slick-list {
        -webkit-transform: translate3d(0, 0, 0);
        -ms-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0)
        }
        .slick-track {
        position: relative;
        top: 0;
        left: 0;
        display: block
        }
        .slick-track:before,
        .slick-track:after {
        display: table;
        content: ''
        }
        .slick-track:after {
        clear: both
        }
        .slick-loading .slick-track {
        visibility: hidden
        }
        .slick-slide {
        display: none;
        float: left;
        height: 100%;
        min-height: 1px
        }
        .slick-slide.dragging img {
        pointer-events: none
        }
        .slick-initialized .slick-slide {
        display: block
        }
        .slick-loading .slick-slide {
        visibility: hidden
        }
        .slick-vertical .slick-slide {
        display: block;
        height: auto;
        border: 1px solid transparent
        }
        .img-fill {
        width: 100%;
        display: block;
        overflow: hidden;
        position: relative;
        text-align: center
        }
        .img-fill img {
        height: 100%;
        min-width: 100%;
        position: relative;
        display: inline-block;
        max-width: none
        }
        /* Slider Theme Style */
        .Container {
        padding: 0 15px;
        }
        .Container:after,
        .Container .Head:after {
        content: '';
        display: block;
        clear: both;
        }
        .Container .Head {
        font: 20px/50px NeoSansR;
        color: #222;
        height: 52px;
        over-flow: hidden;
        border-bottom:1px solid rgba(0,0,0,.25);
        }
        .Container .Head .Arrows {
        float: right;
        }
        .Container .Head .Slick-Next,
        .Container .Head .Slick-Prev {
        display: inline-block;
        width: 38px;
        height: 38px;
        margin-top: 6px;
        background: #2b2b2b;
        color: #FFF;
        margin-left: 5px;
        cursor: pointer;
        font: 18px/36px FontAwesome;
        text-align: center;
        transition: all 0.5s;
        }
        .Container .Head .Slick-Next:hover,
        .Container .Head .Slick-Prev:hover {
        background: #33687a;
        }
        .Container .Head .Slick-Next:before {
        content: '\f105'
        }
        .Container .Head .Slick-Prev:before {
        content: '\f104'
        }
        .SlickCarousel {
        margin: 0 -7.5px;
        margin-top: 10px;
        }
        .ProductBlock {
        padding: 0 7.5px;
        }
        .ProductBlock .img-fill {
        height: 200px;
        }
        .ProductBlock h3 {
        font-size: 15px;
        color: #393939;
        margin-top: 5px;
        text-align: center;
        }
        .ProductBlock h2 {
        font: 1.3em;
        color: #393939;
        margin-top: 5px;
        text-align: center;
        }
        *,
        *:before,
        *:after {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.04);
        }
        </style>
        </style>
        @endsection
        <!-- Page custom js -->
        @section('pagejs')
        <script>
            $(document).ready(function(){
            $(".SlickCarousel").slick({
            rtl:false, // If RTL Make it true & .slick-slide{float:right;}
            autoplay:true, 
            autoplaySpeed:3000, //  Slide Delay
            speed:900, // Transition Speed
            slidesToShow:6, // Number Of Carousel
            slidesToScroll:1, // Slide To Move 
            pauseOnHover:false,
            appendArrows:$(".Head .Arrows"), // Class For Arrows Buttons
            prevArrow:'<span class="Slick-Prev"></span>',
            nextArrow:'<span class="Slick-Next"></span>',
            easing:"linear",
            responsive:[
            {breakpoint:801,settings:{
            slidesToShow:3,
            }},
            {breakpoint:641,settings:{
            slidesToShow:3,
            }},
            {breakpoint:481,settings:{
            slidesToShow:1,
            }},
            ],
            })
            });
        </script>
        @endsection
        