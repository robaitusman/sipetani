<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Edit Profil"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Edit Profil</div>
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
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("profil/edit/$rec_id"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="id_jenis">Jenis </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-id_jenis-holder" class=" ">
                                            <select  id="ctrl-id_jenis" data-field="id_jenis" name="id_jenis"  placeholder="Select a value ..."    class="form-select" >
                                            <option value="">Select a value ...</option>
                                            <?php
                                                $options = $comp_model->profil_id_jenis_option_list() ?? [];
                                                foreach($options as $option){
                                                $value = $option->value;
                                                $label = $option->label ?? $value;
                                                $selected = ( $value == $data['id_jenis'] ? 'selected' : null );
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
                                        <label class="control-label" for="judul">Judul </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-judul-holder" class=" ">
                                            <input id="ctrl-judul" data-field="judul"  value="<?php  echo $data['judul']; ?>" type="text" placeholder="Enter Judul"  name="judul"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-deskripsi-holder" class=" ">
                                            <textarea placeholder="Enter Deskripsi" id="ctrl-deskripsi" data-field="deskripsi"  required="" rows="5" name="deskripsi" class="htmleditor form-control"><?php  echo $data['deskripsi']; ?></textarea>
                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="layanan">Layanan </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-layanan-holder" class=" ">
                                            <textarea placeholder="Enter Layanan" id="ctrl-layanan" data-field="layanan"  rows="5" name="layanan" class="htmleditor form-control"><?php  echo $data['layanan']; ?></textarea>
                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="jam_kerja">Jam Kerja </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-jam_kerja-holder" class=" ">
                                            <textarea placeholder="Enter Jam Kerja" id="ctrl-jam_kerja" data-field="jam_kerja"  rows="5" name="jam_kerja" class="htmleditor form-control"><?php  echo $data['jam_kerja']; ?></textarea>
                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
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
                                            <div class="dropzone " input="#ctrl-photo" fieldname="photo" uploadurl="{{ url('fileuploader/upload/photo') }}"    data-multiple="false" dropmsg="Choose files or drop files here"    btntext="Browse" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="4">
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
                                        <label class="control-label" for="video">Video </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-video-holder" class=" ">
                                            <div class="dropzone " input="#ctrl-video" fieldname="video" uploadurl="{{ url('fileuploader/upload/video') }}"    data-multiple="false" dropmsg="Choose files or drop files here"    btntext="Browse" extensions=".mp3,.mp4,.webm,.wav,.avi,.mpg,.mpeg" filesize="3" maximum="1">
                                                <input name="video" id="ctrl-video" data-field="video" class="dropzone-input form-control" value="<?php  echo $data['video']; ?>" type="text"  />
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                            </div>
                                        </div>
                                        <?php Html :: uploaded_files_list($data['video'], '#ctrl-video'); ?>
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
                                            <textarea placeholder="Enter Penulis" id="ctrl-penulis" data-field="penulis"  required="" rows="5" name="penulis" class="htmleditor form-control"><?php  echo $data['penulis']; ?></textarea>
                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
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
