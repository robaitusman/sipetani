<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Edit Pelaku Usaha Peternakan"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Edit Pelaku Usaha Peternakan</div>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("pelaku_usaha_peternakan/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="nama_usaha">Nama Usaha <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-nama_usaha-holder" class=" ">
                                            <input id="ctrl-nama_usaha" data-field="nama_usaha"  value="<?php  echo $data['nama_usaha']; ?>" type="text" placeholder="Enter Nama Usaha"  required="" name="nama_usaha"  class="form-control " />
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
                                        <label class="control-label" for="lokasi">Lokasi <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-lokasi-holder" class=" ">
                                            <input id="ctrl-lokasi" data-field="lokasi"  value="<?php  echo $data['lokasi']; ?>" type="text" placeholder="Enter Lokasi"  required="" name="lokasi"  class="form-control " />
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
                                        <label class="control-label" for="legalitas">Legalitas <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-legalitas-holder" class=" ">
                                            <input id="ctrl-legalitas" data-field="legalitas"  value="<?php  echo $data['legalitas']; ?>" type="text" placeholder="Enter Legalitas"  required="" name="legalitas"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="status_kelompok">Status Kelompok <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-status_kelompok-holder" class=" ">
                                            <input id="ctrl-status_kelompok" data-field="status_kelompok"  value="<?php  echo $data['status_kelompok']; ?>" type="text" placeholder="Enter Status Kelompok"  required="" name="status_kelompok"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="legalitas_produksi">Legalitas Produksi <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-legalitas_produksi-holder" class=" ">
                                            <input id="ctrl-legalitas_produksi" data-field="legalitas_produksi"  value="<?php  echo $data['legalitas_produksi']; ?>" type="text" placeholder="Enter Legalitas Produksi"  required="" name="legalitas_produksi"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="jenis_olahan">Jenis Olahan <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-jenis_olahan-holder" class=" ">
                                            <input id="ctrl-jenis_olahan" data-field="jenis_olahan"  value="<?php  echo $data['jenis_olahan']; ?>" type="text" placeholder="Enter Jenis Olahan"  required="" name="jenis_olahan"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="komoditas">Komoditas <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-komoditas-holder" class=" ">
                                            <input id="ctrl-komoditas" data-field="komoditas"  value="<?php  echo $data['komoditas']; ?>" type="text" placeholder="Enter Komoditas"  required="" name="komoditas"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="satuan">Satuan <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-satuan-holder" class=" ">
                                            <input id="ctrl-satuan" data-field="satuan"  value="<?php  echo $data['satuan']; ?>" type="text" placeholder="Enter Satuan"  required="" name="satuan"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="jml_produksi">Jml Produksi <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-jml_produksi-holder" class=" ">
                                            <input id="ctrl-jml_produksi" data-field="jml_produksi"  value="<?php  echo $data['jml_produksi']; ?>" type="number" placeholder="Enter Jml Produksi" step="any"  required="" name="jml_produksi"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="omzet">Omzet <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-omzet-holder" class=" ">
                                            <input id="ctrl-omzet" data-field="omzet"  value="<?php  echo $data['omzet']; ?>" type="number" placeholder="Enter Omzet" step="any"  required="" name="omzet"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="sumber_bahan_baku">Sumber Bahan Baku <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-sumber_bahan_baku-holder" class=" ">
                                            <input id="ctrl-sumber_bahan_baku" data-field="sumber_bahan_baku"  value="<?php  echo $data['sumber_bahan_baku']; ?>" type="text" placeholder="Enter Sumber Bahan Baku"  required="" name="sumber_bahan_baku"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="metode_penjualan">Metode Penjualan <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-metode_penjualan-holder" class=" ">
                                            <input id="ctrl-metode_penjualan" data-field="metode_penjualan"  value="<?php  echo $data['metode_penjualan']; ?>" type="text" placeholder="Enter Metode Penjualan"  required="" name="metode_penjualan"  class="form-control " />
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
                                        <div id="ctrl-visibility-holder" class=" ">
                                            <?php 
                                                $options = $comp_model->status_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $checked = ( $value == $data['visibility'] ? 'checked' : null );
                                            ?>
                                            <label class="form-check option-btn">
                                            <input class="form-check-input" <?php echo $checked ?> value="<?php echo $value; ?>" type="radio"  name="visibility"   required="" />
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
                                        <label class="control-label" for="status">Status <span class="text-danger">*</span></label>
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
                                            <input class="form-check-input" <?php echo $checked ?> value="<?php echo $value; ?>" type="radio"  name="status"   required="" />
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
                                        <label class="control-label" for="photo">Photo <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-photo-holder" class=" ">
                                            <div class="dropzone required" input="#ctrl-photo" fieldname="photo" uploadurl="{{ url('fileuploader/upload/photo') }}"    data-multiple="true" dropmsg="Choose files or drop files here"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="4">
                                                <input name="photo" id="ctrl-photo" data-field="photo" required="" class="dropzone-input form-control" value="<?php  echo $data['photo']; ?>" type="text"  />
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
