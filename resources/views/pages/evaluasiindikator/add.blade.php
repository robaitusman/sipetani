<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Input  Evaluasi Indikator"; //set dynamic page title
       $id_period = request()->get('period') ?? getActivePeriod();
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
                        <div class="h5 font-weight-bold text-primary">Input  Evaluasi Indikator</div>
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
                        <form id="evaluasiindikator-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('evaluasiindikator.store') }}" method="post">
                            @csrf
                            <div>
                                <input id="ctrl-periode_id" data-field="periode_id"  value="<?php echo $id_period; ?>" type="hidden" placeholder="Enter Periode Id"  required="" name="periode_id"  class="form-control " />
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="indikator_master_id">Indikator Master <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-indikator_master_id-holder" class=" ">
                                                <select required=""  id="ctrl-indikator_master_id" data-field="indikator_master_id" name="indikator_master_id"  placeholder="Select a value ..."    class="form-select" >
                                                <option value="">Select a value ...</option>
                                                <?php 
                                                    $options = $comp_model->indikator_master_id_option_list() ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = Html::get_field_selected('indikator_master_id', $value, "");
                                                ?>
                                                <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                <?php echo $label; ?>
                                                </option>
                                                <?php
                                                    }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="target">Target <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-target-holder" class=" ">
                                                <input id="ctrl-target" data-field="target"  value="<?php echo get_value('target') ?>" type="text" placeholder="Enter Target"  required="" name="target"  class="form-control " />
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
                                                <input id="ctrl-nilai" data-field="nilai"  value="<?php echo get_value('nilai') ?>" type="number" placeholder="Enter Nilai" step="any"  name="nilai"  class="form-control " />
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
                                                <div class="dropzone " input="#ctrl-bukti_dukung" fieldname="bukti_dukung" uploadurl="{{ url('fileuploader/upload/bukti_dukung') }}"    data-multiple="false" dropmsg="pilih file dan masukkan ke sini (PDF/Gambar)"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg,.pdf" filesize="3" maximum="1">
                                                    <input name="bukti_dukung" id="ctrl-bukti_dukung" data-field="bukti_dukung" class="dropzone-input form-control" value="<?php echo get_value('bukti_dukung') ?>" type="text"  />
                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                    <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-ajax-status"></div>
                            <!--[form-button-start]-->
                            <div class="form-group form-submit-btn-holder text-center mt-3">
                                <button class="btn btn-primary" type="submit">
                                Simpan
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
