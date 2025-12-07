<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Harga Ternak"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Add New Harga Ternak</div>
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
                        <form id="harga_ternak-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('harga_ternak.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="sapi">Sapi </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-sapi-holder" class=" ">
                                                <input id="ctrl-sapi" data-field="sapi"  value="<?php echo get_value('sapi', "NULL") ?>" type="number" placeholder="Enter Sapi" step="any"  name="sapi"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="kambing">Kambing </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-kambing-holder" class=" ">
                                                <input id="ctrl-kambing" data-field="kambing"  value="<?php echo get_value('kambing', "NULL") ?>" type="number" placeholder="Enter Kambing" step="any"  name="kambing"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="domba">Domba </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-domba-holder" class=" ">
                                                <input id="ctrl-domba" data-field="domba"  value="<?php echo get_value('domba', "NULL") ?>" type="number" placeholder="Enter Domba" step="any"  name="domba"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="ayam_pedaging">Ayam Pedaging </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-ayam_pedaging-holder" class=" ">
                                                <input id="ctrl-ayam_pedaging" data-field="ayam_pedaging"  value="<?php echo get_value('ayam_pedaging', "NULL") ?>" type="number" placeholder="Enter Ayam Pedaging" step="any"  name="ayam_pedaging"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="ayam_petelor">Ayam Petelor </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-ayam_petelor-holder" class=" ">
                                                <input id="ctrl-ayam_petelor" data-field="ayam_petelor"  value="<?php echo get_value('ayam_petelor', "NULL") ?>" type="number" placeholder="Enter Ayam Petelor" step="any"  name="ayam_petelor"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="ayam_petelor_afkir">Ayam Petelor Afkir </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-ayam_petelor_afkir-holder" class=" ">
                                                <input id="ctrl-ayam_petelor_afkir" data-field="ayam_petelor_afkir"  value="<?php echo get_value('ayam_petelor_afkir', "NULL") ?>" type="number" placeholder="Enter Ayam Petelor Afkir" step="any"  name="ayam_petelor_afkir"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="burung_puyuh">Burung Puyuh </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-burung_puyuh-holder" class=" ">
                                                <input id="ctrl-burung_puyuh" data-field="burung_puyuh"  value="<?php echo get_value('burung_puyuh', "NULL") ?>" type="number" placeholder="Enter Burung Puyuh" step="any"  name="burung_puyuh"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="burung_dara">Burung Dara </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-burung_dara-holder" class=" ">
                                                <input id="ctrl-burung_dara" data-field="burung_dara"  value="<?php echo get_value('burung_dara', "NULL") ?>" type="number" placeholder="Enter Burung Dara" step="any"  name="burung_dara"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="itik">Itik </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-itik-holder" class=" ">
                                                <input id="ctrl-itik" data-field="itik"  value="<?php echo get_value('itik', "NULL") ?>" type="number" placeholder="Enter Itik" step="any"  name="itik"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="entok">Entok </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-entok-holder" class=" ">
                                                <input id="ctrl-entok" data-field="entok"  value="<?php echo get_value('entok', "NULL") ?>" type="number" placeholder="Enter Entok" step="any"  name="entok"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="susu_sapi">Susu Sapi </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-susu_sapi-holder" class=" ">
                                                <input id="ctrl-susu_sapi" data-field="susu_sapi"  value="<?php echo get_value('susu_sapi', "NULL") ?>" type="number" placeholder="Enter Susu Sapi" step="any"  name="susu_sapi"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="susu_kambing">Susu Kambing </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-susu_kambing-holder" class=" ">
                                                <input id="ctrl-susu_kambing" data-field="susu_kambing"  value="<?php echo get_value('susu_kambing', "NULL") ?>" type="number" placeholder="Enter Susu Kambing" step="any"  name="susu_kambing"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                                            <label class="control-label" for="penulis">Penulis <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-penulis-holder" class=" ">
                                                <input id="ctrl-penulis" data-field="penulis"  value="<?php echo get_value('penulis') ?>" type="number" placeholder="Enter Penulis" step="any"  required="" name="penulis"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="daging_sapi">Daging Sapi <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-daging_sapi-holder" class=" ">
                                                <input id="ctrl-daging_sapi" data-field="daging_sapi"  value="<?php echo get_value('daging_sapi') ?>" type="number" placeholder="Enter Daging Sapi" step="any"  required="" name="daging_sapi"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="daging_ayam">Daging Ayam <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-daging_ayam-holder" class=" ">
                                                <input id="ctrl-daging_ayam" data-field="daging_ayam"  value="<?php echo get_value('daging_ayam') ?>" type="number" placeholder="Enter Daging Ayam" step="any"  required="" name="daging_ayam"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="daging_kambing">Daging Kambing <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-daging_kambing-holder" class=" ">
                                                <input id="ctrl-daging_kambing" data-field="daging_kambing"  value="<?php echo get_value('daging_kambing') ?>" type="number" placeholder="Enter Daging Kambing" step="any"  required="" name="daging_kambing"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="daging_babi">Daging Babi <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-daging_babi-holder" class=" ">
                                                <input id="ctrl-daging_babi" data-field="daging_babi"  value="<?php echo get_value('daging_babi') ?>" type="number" placeholder="Enter Daging Babi" step="any"  required="" name="daging_babi"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="harga_telur">Harga Telur <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-harga_telur-holder" class=" ">
                                                <input id="ctrl-harga_telur" data-field="harga_telur"  value="<?php echo get_value('harga_telur') ?>" type="number" placeholder="Enter Harga Telur" step="any"  required="" name="harga_telur"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="daging_bebek">Daging Bebek <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-daging_bebek-holder" class=" ">
                                                <input id="ctrl-daging_bebek" data-field="daging_bebek"  value="<?php echo get_value('daging_bebek') ?>" type="number" placeholder="Enter Daging Bebek" step="any"  required="" name="daging_bebek"  class="form-control " />
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
