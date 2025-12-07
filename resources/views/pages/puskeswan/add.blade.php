<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Puskeswan"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Add New Puskeswan</div>
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
                        <form id="puskeswan-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('puskeswan.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="nama">Nama <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-nama-holder" class=" ">
                                                <input id="ctrl-nama" data-field="nama"  value="<?php echo get_value('nama') ?>" type="text" placeholder="Enter Nama"  required="" name="nama"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="nama_ketua">Nama Ketua <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-nama_ketua-holder" class=" ">
                                                <input id="ctrl-nama_ketua" data-field="nama_ketua"  value="<?php echo get_value('nama_ketua') ?>" type="text" placeholder="Enter Nama Ketua"  required="" name="nama_ketua"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="alamat">Alamat <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-alamat-holder" class=" ">
                                                <input id="ctrl-alamat" data-field="alamat"  value="<?php echo get_value('alamat') ?>" type="text" placeholder="Enter Alamat"  required="" name="alamat"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="kapasitas">Kapasitas <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-kapasitas-holder" class=" ">
                                                <input id="ctrl-kapasitas" data-field="kapasitas"  value="<?php echo get_value('kapasitas') ?>" type="text" placeholder="Enter Kapasitas"  required="" name="kapasitas"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="id_wilayah">Wilayah <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-id_wilayah-holder" class=" ">
                                                <select required=""  id="ctrl-id_wilayah" data-field="id_wilayah" name="id_wilayah"  placeholder="Select a value ..."    class="form-select" >
                                                <option value="">Select a value ...</option>
                                                <?php 
                                                    $options = $comp_model->id_wilayah_option_list() ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $selected = Html::get_field_selected('id_wilayah', $value, "");
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
                                            <label class="control-label" for="rt">Rt <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-rt-holder" class=" ">
                                                <input id="ctrl-rt" data-field="rt"  value="<?php echo get_value('rt') ?>" type="text" placeholder="Enter Rt"  required="" name="rt"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="rw">Rw <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-rw-holder" class=" ">
                                                <input id="ctrl-rw" data-field="rw"  value="<?php echo get_value('rw') ?>" type="text" placeholder="Enter Rw"  required="" name="rw"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="legalitas">Legalitas <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-legalitas-holder" class=" ">
                                                <input id="ctrl-legalitas" data-field="legalitas"  value="<?php echo get_value('legalitas') ?>" type="number" placeholder="Enter Legalitas" step="any"  required="" name="legalitas"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="ket_legalitas">Ket Legalitas <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-ket_legalitas-holder" class=" ">
                                                <input id="ctrl-ket_legalitas" data-field="ket_legalitas"  value="<?php echo get_value('ket_legalitas') ?>" type="text" placeholder="Enter Ket Legalitas"  required="" name="ket_legalitas"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="gambar">Gambar <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-gambar-holder" class=" ">
                                                <input id="ctrl-gambar" data-field="gambar"  value="<?php echo get_value('gambar') ?>" type="text" placeholder="Enter Gambar"  required="" name="gambar"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="body">Body <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-body-holder" class=" ">
                                                <textarea placeholder="Enter Body" id="ctrl-body" data-field="body"  required="" rows="5" name="body" class=" form-control"><?php echo get_value('body') ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="visibility">Visibility <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-visibility-holder" class=" checkbox-group-required">
                                                <?php
                                                    $options = Menu::status();
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    //check if current option is checked option
                                                    $checked = Html::get_field_checked('visibility', $value, "");
                                                ?>
                                                <label class="form-check option-btn">
                                                <input class="form-check-input" value="<?php echo $value ?>" <?php echo $checked ?> type="checkbox"   name="visibility[]" />
                                                <span class="form-check-label"><?php echo $label ?></span>
                                                </label>
                                                <?php
                                                    }
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="status">Status <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-status-holder" class=" checkbox-group-required">
                                                <?php
                                                    $options = Menu::status();
                                                    if(!empty($options)){
                                                    foreach($options as $option){
                                                    $value = $option['value'];
                                                    $label = $option['label'];
                                                    //check if current option is checked option
                                                    $checked = Html::get_field_checked('status', $value, "");
                                                ?>
                                                <label class="form-check option-btn">
                                                <input class="form-check-input" value="<?php echo $value ?>" <?php echo $checked ?> type="checkbox"   name="status[]" />
                                                <span class="form-check-label"><?php echo $label ?></span>
                                                </label>
                                                <?php
                                                    }
                                                    }
                                                ?>
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
