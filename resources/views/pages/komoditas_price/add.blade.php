<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Komoditas Price"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="add" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container">
            <div class="row align-items-center">
                <div class="col-auto  back-btn-col" >
                    <a class="back-btn btn " href="{{ url()->previous() }}" >
                        <i class="icon dripicons-arrow-thin-left"></i>                              
                    </a>
                </div>
                <div class="col col-md-auto  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">Add New Komoditas Price</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <div  class="" >
        <div class="container">
            <div class="row ">
                <div class="col-md-9 comp-grid " >
                    <div  class="card card-1 border rounded page-content" >
                        <!--[form-start]-->
                        <form id="komoditas_price-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('komoditas_price.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="tanggal">Tanggal <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-tanggal-holder" class="input-group ">
                                                <input id="ctrl-tanggal" data-field="tanggal" class="form-control datepicker  datepicker"  required="" value="<?php echo get_value('tanggal') ?>" type="datetime" name="tanggal" placeholder="Enter Tanggal" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                <span class="input-group-text"><i class="icon dripicons-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="kebutuhan">Kebutuhan <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-kebutuhan-holder" class=" ">
                                                <input id="ctrl-kebutuhan" data-field="kebutuhan"  value="<?php echo get_value('kebutuhan') ?>" type="number" placeholder="Enter Kebutuhan" step="0.1"  required="" name="kebutuhan"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="ketersediaan">Ketersediaan <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-ketersediaan-holder" class=" ">
                                                <input id="ctrl-ketersediaan" data-field="ketersediaan"  value="<?php echo get_value('ketersediaan') ?>" type="number" placeholder="Enter Ketersediaan" step="0.1"  required="" name="ketersediaan"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="harga">Harga <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-harga-holder" class=" ">
                                                <input id="ctrl-harga" data-field="harga"  value="<?php echo get_value('harga') ?>" type="number" placeholder="Enter Harga" step="any"  required="" name="harga"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="id_trans">Id Trans <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-id_trans-holder" class=" ">
                                                <input id="ctrl-id_trans" data-field="id_trans"  value="<?php echo get_value('id_trans') ?>" type="number" placeholder="Enter Id Trans" step="any"  required="" name="id_trans"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-ajax-status"></div>
                            <!--[form-button-start]-->
                            <div class="form-group form-submit-btn-holder text-center mt-3">
                                <button class="btn btn-primary" type="submit">
                                Submit
                                <i class="icon dripicons-direction"></i>
                                </button>
                            </div>
                            <!--[form-button-end]-->
                        </form>
                        <!--[form-end]-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page custom js --><script>
$(document).ready(function(){
	// custom javascript | jquery codes
});
</script>

@endsection
