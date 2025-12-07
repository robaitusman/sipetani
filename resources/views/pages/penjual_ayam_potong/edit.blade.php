<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Edit Penjual Ayam Potong"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="edit" data-page-url="{{ url()->full() }}">
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
                        <div class="h5 font-weight-bold text-primary">Edit Penjual Ayam Potong</div>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("penjual_ayam_potong/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="nama_pedagang">Nama Pedagang <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-nama_pedagang-holder" class=" ">
                                            <input id="ctrl-nama_pedagang" data-field="nama_pedagang"  value="<?php  echo $data['nama_pedagang']; ?>" type="text" placeholder="Enter Nama Pedagang"  required="" name="nama_pedagang"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="lokasi_penjual">Lokasi Penjual <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-lokasi_penjual-holder" class=" ">
                                            <input id="ctrl-lokasi_penjual" data-field="lokasi_penjual"  value="<?php  echo $data['lokasi_penjual']; ?>" type="text" placeholder="Enter Lokasi Penjual"  required="" name="lokasi_penjual"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="kapasitas_max">Kapasitas Max <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-kapasitas_max-holder" class=" ">
                                            <input id="ctrl-kapasitas_max" data-field="kapasitas_max"  value="<?php  echo $data['kapasitas_max']; ?>" type="number" placeholder="Enter Kapasitas Max" step="any"  required="" name="kapasitas_max"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="kontak_hp">Kontak Hp <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-kontak_hp-holder" class=" ">
                                            <input id="ctrl-kontak_hp" data-field="kontak_hp"  value="<?php  echo $data['kontak_hp']; ?>" type="text" placeholder="Enter Kontak Hp"  required="" name="kontak_hp"  class="form-control " />
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
                                            <input id="ctrl-legalitas" data-field="legalitas"  value="<?php  echo $data['legalitas']; ?>" type="number" placeholder="Enter Legalitas" step="any"  required="" name="legalitas"  class="form-control " />
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
                                            <input id="ctrl-ket_legalitas" data-field="ket_legalitas"  value="<?php  echo $data['ket_legalitas']; ?>" type="text" placeholder="Enter Ket Legalitas"  required="" name="ket_legalitas"  class="form-control " />
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
                                                $field_value = $data['visibility'];
                                                if(!empty($options)){
                                                foreach($options as $option){
                                                $value = $option['value'];
                                                $label = $option['label'];
                                                //check if value is among checked options
                                                $checked = Html::get_record_checked($field_value, $value);
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
                                                $field_value = $data['status'];
                                                if(!empty($options)){
                                                foreach($options as $option){
                                                $value = $option['value'];
                                                $label = $option['label'];
                                                //check if value is among checked options
                                                $checked = Html::get_record_checked($field_value, $value);
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
                        <!--[form-content-end]-->
                        <!--[form-button-start]-->
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">
                            Update
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
