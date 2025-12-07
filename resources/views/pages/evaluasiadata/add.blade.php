<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Evaluasi Adata"; //set dynamic page title
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
            <div class="row justify-content-between align-items-center">
                <div class="col-auto  back-btn-col" >
                    <a class="back-btn btn " href="{{ url()->previous() }}" >
                        <i class="icon dripicons-arrow-thin-left"></i>                              
                    </a>
                </div>
                <div class="col  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">Add New Evaluasi Adata</div>
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
                        <form id="evaluasiadata-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('evaluasiadata.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="periode_id">Periode Id <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-periode_id-holder" class=" ">
                                                <input id="ctrl-periode_id" data-field="periode_id"  value="<?php echo get_value('periode_id') ?>" type="number" placeholder="Enter Periode Id" step="any"  required="" name="periode_id"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="master_adata_id">Master Adata Id <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-master_adata_id-holder" class=" ">
                                                <input id="ctrl-master_adata_id" data-field="master_adata_id"  value="<?php echo get_value('master_adata_id') ?>" type="number" placeholder="Enter Master Adata Id" step="any"  required="" name="master_adata_id"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="nilai">Nilai </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-nilai-holder" class=" ">
                                                <input id="ctrl-nilai" data-field="nilai"  value="<?php echo get_value('nilai') ?>" type="text" placeholder="Enter Nilai"  name="nilai"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="bukti_dukung">Bukti Dukung </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-bukti_dukung-holder" class=" ">
                                                <input id="ctrl-bukti_dukung" data-field="bukti_dukung"  value="<?php echo get_value('bukti_dukung') ?>" type="text" placeholder="Enter Bukti Dukung"  name="bukti_dukung"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="input_by">Input By </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-input_by-holder" class=" ">
                                                <input id="ctrl-input_by" data-field="input_by"  value="<?php echo get_value('input_by') ?>" type="number" placeholder="Enter Input By" step="any"  name="input_by"  class="form-control " />
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


@endsection
