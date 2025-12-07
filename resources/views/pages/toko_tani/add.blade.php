<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Toko Tani"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Add New Toko Tani</div>
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
                        <form id="toko_tani-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('toko_tani.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="nama_usaha">Nama Usaha <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-nama_usaha-holder" class=" ">
                                                <input id="ctrl-nama_usaha" data-field="nama_usaha"  value="<?php echo get_value('nama_usaha') ?>" type="text" placeholder="Enter Nama Usaha"  required="" name="nama_usaha"  class="form-control " />
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
                                                <input id="ctrl-nama_pemilik" data-field="nama_pemilik"  value="<?php echo get_value('nama_pemilik') ?>" type="text" placeholder="Enter Nama Pemilik"  required="" name="nama_pemilik"  class="form-control " />
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
                                            <div id="ctrl-status-holder" class=" ">
                                                <?php 
                                                    $options = $comp_model->status_option_list() ?? [];
                                                    foreach($options as $option){
                                                    $value = $option->value;
                                                    $label = $option->label ?? $value;
                                                    $checked = Html::get_field_checked('status', $value, "");
                                                ?>
                                                <label class="form-check">
                                                <input class="form-check-input" <?php echo $checked; ?> value="<?php echo $value; ?>" type="radio"  name="status"   required="" />
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
                                                    <input name="photo" id="ctrl-photo" data-field="photo" required="" class="dropzone-input form-control" value="<?php echo get_value('photo') ?>" type="text"  />
                                                    <!--<div class="invalid-feedback animated bounceIn text-center">Please a choose file</div>-->
                                                    <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                                </div>
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
                                                <input id="ctrl-lokasi" data-field="lokasi"  value="<?php echo get_value('lokasi') ?>" type="text" placeholder="Enter Lokasi"  required="" name="lokasi"  class="form-control " />
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
                                                <input id="ctrl-long" data-field="long"  value="<?php echo get_value('long') ?>" type="text" placeholder="Enter Long"  required="" name="long"  class="form-control " />
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
                                                <input id="ctrl-lat" data-field="lat"  value="<?php echo get_value('lat') ?>" type="text" placeholder="Enter Lat"  required="" name="lat"  class="form-control " />
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
                <div class="col-md-9 comp-grid " >
                    <div class=" "><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/leaflet.css" />
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/leaflet.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
                            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                                <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
                                <div id="map" style="height: 400px"></div>
                                <script>
                                    ///Setting the center of the map
                                    var center = [-8.0948239, 112.1302363];
                                    // Create the map
                                    var map = L.map('map').setView(center, 11);
                                    // Set up the Open Street Map layer 
                                    // add map layer (OpenStreetMap)
                                    L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                                    maxZoom: 20,
                                    subdomains:['mt0','mt1','mt2','mt3']
                                    }).addTo(map);
                                    var drawnItems = new L.FeatureGroup();
                                    map.addLayer(drawnItems);
                                    var drawControl = new L.Control.Draw({
                                    position: 'topright',
                                    draw: {
                                    polygon: false,
                                    polyline: false,
                                    circlemarker: false, 
                                    rect: false,
                                    circle: false,
                                    },
                                    edit: {
                                    featureGroup: drawnItems
                                    }
                                    });
                                    map.addControl(drawControl);
                                    map.on('draw:created', function(e) {
                                    var type = e.layerType,
                                    layer = e.layer;
                                    drawnItems.addLayer(layer);
                                    $('#ctrl-geojson').val(JSON.stringify(layer.toGeoJSON())); //saving the layer to the input field using jQuery
                                    });
                                </script></div>
                            </div>
                            <div class="col-md-9 comp-grid " >
                                <div class=" "><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/leaflet.css" />
                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.4.0/leaflet.js"></script>
                                        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
                                        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                                            <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
                                            <div id="map" style="height: 400px"></div>
                                            <script>
                                                ///Setting the center of the map
                                                var center = [-8.0948239, 112.1302363];
                                                // Create the map
                                                var map = L.map('map').setView(center, 11);
                                                // Set up the Open Street Map layer 
                                                // add map layer (OpenStreetMap)
                                                L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                                                maxZoom: 20,
                                                subdomains:['mt0','mt1','mt2','mt3']
                                                }).addTo(map);
                                                var drawnItems = new L.FeatureGroup();
                                                map.addLayer(drawnItems);
                                                var drawControl = new L.Control.Draw({
                                                position: 'topright',
                                                draw: {
                                                polygon: false,
                                                polyline: false,
                                                circlemarker: false, 
                                                rect: false,
                                                circle: false,
                                                },
                                                edit: {
                                                featureGroup: drawnItems
                                                }
                                                });
                                                map.addControl(drawControl);
                                                map.on('draw:created', function(e) {
                                                var type = e.layerType,
                                                layer = e.layer;
                                                drawnItems.addLayer(layer);
                                                const json = convertFormToJSON('#toko_tani-add-form');
                                                delete json._token;
                                                const geo=layer.toGeoJSON();
                                                geo.properties=json;
                                                console.log(geo);
                                                $('#ctrl-geojson').val(JSON.stringify(geo)); //saving the layer to the input field using jQuery
                                                });
                                                function convertFormToJSON(form) {
                                                return $(form)
                                                .serializeArray()
                                                .reduce(function (json, { name, value }) {
                                                json[name] = value;
                                                return json;
                                                }, {});
                                                }
                                            </script></div>
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
