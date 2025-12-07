<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Edit Poultry"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Edit Poultry</div>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("poultry/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="nama">Nama <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-nama-holder" class=" ">
                                            <input id="ctrl-nama" data-field="nama"  value="<?php  echo $data['nama']; ?>" type="text" placeholder="Enter Nama"  required="" name="nama"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="nama_pemilik">Nama Pemilik <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-nama_pemilik-holder" class=" ">
                                            <input id="ctrl-nama_pemilik" data-field="nama_pemilik"  value="<?php  echo $data['nama_pemilik']; ?>" type="text" placeholder="Enter Nama Pemilik"  required="" name="nama_pemilik"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="no_hp_pemilik">No Hp Pemilik <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-no_hp_pemilik-holder" class=" ">
                                            <input id="ctrl-no_hp_pemilik" data-field="no_hp_pemilik"  value="<?php  echo $data['no_hp_pemilik']; ?>" type="text" placeholder="Enter No Hp Pemilik"  required="" name="no_hp_pemilik"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="nama_penanggung_jawab">Nama Penanggung Jawab <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-nama_penanggung_jawab-holder" class=" ">
                                            <input id="ctrl-nama_penanggung_jawab" data-field="nama_penanggung_jawab"  value="<?php  echo $data['nama_penanggung_jawab']; ?>" type="text" placeholder="Enter Nama Penanggung Jawab"  required="" name="nama_penanggung_jawab"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="no_hp_penanggung_jawab">No Hp Penanggung Jawab <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-no_hp_penanggung_jawab-holder" class=" ">
                                            <input id="ctrl-no_hp_penanggung_jawab" data-field="no_hp_penanggung_jawab"  value="<?php  echo $data['no_hp_penanggung_jawab']; ?>" type="text" placeholder="Enter No Hp Penanggung Jawab"  required="" name="no_hp_penanggung_jawab"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="nama_sdm">Nama Sdm <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-nama_sdm-holder" class=" ">
                                            <input id="ctrl-nama_sdm" data-field="nama_sdm"  value="<?php  echo $data['nama_sdm']; ?>" type="text" placeholder="Enter Nama Sdm"  required="" name="nama_sdm"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="no_hp_sdm">No Hp Sdm <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-no_hp_sdm-holder" class=" ">
                                            <input id="ctrl-no_hp_sdm" data-field="no_hp_sdm"  value="<?php  echo $data['no_hp_sdm']; ?>" type="text" placeholder="Enter No Hp Sdm"  required="" name="no_hp_sdm"  class="form-control " />
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
                                            <input id="ctrl-kapasitas" data-field="kapasitas"  value="<?php  echo $data['kapasitas']; ?>" type="text" placeholder="Enter Kapasitas"  required="" name="kapasitas"  class="form-control " />
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
                                            <input id="ctrl-alamat" data-field="alamat"  value="<?php  echo $data['alamat']; ?>" type="text" placeholder="Enter Alamat"  required="" name="alamat"  class="form-control " />
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
                                                $selected = ( $value == $data['id_wilayah'] ? 'selected' : null );
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
                                            <input id="ctrl-rt" data-field="rt"  value="<?php  echo $data['rt']; ?>" type="text" placeholder="Enter Rt"  required="" name="rt"  class="form-control " />
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
                                            <input id="ctrl-rw" data-field="rw"  value="<?php  echo $data['rw']; ?>" type="text" placeholder="Enter Rw"  required="" name="rw"  class="form-control " />
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
                                        <label class="control-label" for="visibility">Visibility </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-visibility-holder" class=" ">
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
                                            <input class="form-check-input" value="<?php echo $value ?>" <?php echo $checked ?> type="checkbox"  name="visibility[]" />
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
                                        <label class="control-label" for="status">Status </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-status-holder" class=" ">
                                            <?php 
                                                $options = $comp_model->status_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $checked = ( $value == $data['status'] ? 'checked' : null );
                                            ?>
                                            <label class="form-check option-btn">
                                            <input class="form-check-input" <?php echo $checked ?> value="<?php echo $value; ?>" type="radio"  name="status"   />
                                            <span class="form-check-label"><?php echo $label; ?></span>
                                            </label>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="photo">Photo </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-photo-holder" class=" ">
                                            <div class="dropzone " input="#ctrl-photo" fieldname="photo" uploadurl="{{ url('fileuploader/upload/photo') }}"    data-multiple="true" dropmsg="Choose files or drop files here"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="4">
                                                <input name="photo" id="ctrl-photo" data-field="photo" class="dropzone-input form-control" value="<?php  echo $data['photo']; ?>" type="text"  />
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                            </div>
                                        </div>
                                        <?php Html :: uploaded_files_list($data['photo'], '#ctrl-photo'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="long">Long <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-long-holder" class=" ">
                                            <input id="ctrl-long" data-field="long"  value="<?php  echo $data['long']; ?>" type="text" placeholder="Enter Long"  required="" name="long"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="lat">Lat <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-lat-holder" class=" ">
                                            <input id="ctrl-lat" data-field="lat"  value="<?php  echo $data['lat']; ?>" type="text" placeholder="Enter Lat"  required="" name="lat"  class="form-control " />
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
