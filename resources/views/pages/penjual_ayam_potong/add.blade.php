<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Penjual Ayam Potong"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Add New Penjual Ayam Potong</div>
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
                        <form id="penjual_ayam_potong-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('penjual_ayam_potong.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="nama_pedagang">Nama Pedagang <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-nama_pedagang-holder" class=" ">
                                                <input id="ctrl-nama_pedagang" data-field="nama_pedagang"  value="<?php echo get_value('nama_pedagang') ?>" type="text" placeholder="Enter Nama Pedagang"  required="" name="nama_pedagang"  class="form-control " />
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
                                                <input id="ctrl-lokasi_penjual" data-field="lokasi_penjual"  value="<?php echo get_value('lokasi_penjual') ?>" type="text" placeholder="Enter Lokasi Penjual"  required="" name="lokasi_penjual"  class="form-control " />
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
                                                <input id="ctrl-kapasitas_max" data-field="kapasitas_max"  value="<?php echo get_value('kapasitas_max') ?>" type="number" placeholder="Enter Kapasitas Max" step="any"  required="" name="kapasitas_max"  class="form-control " />
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
                                                <input id="ctrl-kontak_hp" data-field="kontak_hp"  value="<?php echo get_value('kontak_hp') ?>" type="text" placeholder="Enter Kontak Hp"  required="" name="kontak_hp"  class="form-control " />
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
                            <div class="bg-light p-2 subform">
                                <h4 class="record-title">Tambah Photo</h4>
                                <hr />
                                @csrf
                                <div>
                                    <table class="table table-striped table-sm" data-maxrow="10" data-minrow="1">
                                        <thead>
                                            <tr>
                                                <th class="bg-light"><label for="photo">Photo</label></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th colspan="100" class="text-right">
                                            <?php $template_id = "table-row-" . random_str(); ?>
                                            <button type="button" data-template="#<?php echo $template_id ?>" class="btn btn-sm btn-success btn-add-table-row"><i class="icon dripicons-plus"></i></button>
                                            </th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                    <!--[table row template]-->
                                    <template id="<?php echo $template_id ?>">
                                    <?php $row = "CURRENTROW"; // will be replaced with current row index. ?>
                                    <tr data-row="<?php echo $row ?>" class="input-row">
                                    <td>
                                        <div id="ctrl-photo-row<?php echo $row; ?>-holder" class=" ">
                                        <div class="dropzone required" input="#ctrl-photo-row<?php echo $row; ?>" fieldname="photo" uploadurl="{{ url('fileuploader/upload/photo') }}"    data-multiple="true" dropmsg="Choose files or drop files here"    btntext="[html-lang-0082]" extensions=".jpg,.png,.gif,.jpeg" filesize="3" maximum="4">
                                        <input name="photo[<?php echo $row ?>][photo]" id="ctrl-photo-row<?php echo $row; ?>" data-field="photo" required="" class="dropzone-input form-control" value="<?php echo get_value('photo') ?>" type="text"  />
                                        <!--<div class="invalid-feedback animated bounceIn text-center">[html-lang-0129]</div>-->
                                        <div class="dz-file-limit animated bounceIn text-center text-danger"></div>
                                    </div>
                                </div>
                            </td>
                            <th class="text-center">
                            <button type="button" class="btn-close btn-remove-table-row"></button>
                            </th>
                        </tr>
                    </template>
                    <!--[/table row template]-->
                </div>
                <div class="form-ajax-status"></div>
            </div>
            <div class="bg-light p-2 subform">
                <h4 class="record-title">Add New Peta</h4>
                <hr />
                @csrf
                <div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="control-label" for="alamat">Alamat <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <div id="ctrl-alamat-holder" class=" ">
                                    <textarea placeholder="Enter Alamat" id="ctrl-alamat" data-field="alamat"  required="" rows="5" name="peta[alamat]" class=" form-control"><?php echo get_value('alamat') ?></textarea>
                                    <!--<div class="invalid-feedback animated bounceIn text-center">[html-lang-0130]</div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="control-label" for="geojson">Geojson <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-sm-8">
                                <div id="ctrl-geojson-holder" class=" ">
                                    <input id="ctrl-geojson" data-field="geojson"  value="<?php echo get_value('geojson') ?>" type="text" placeholder="Enter Geojson"  required="" name="peta[geojson]"  class="form-control " />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-ajax-status"></div>
            </div>
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
                                const json = convertFormToJSON('#penjual_ayam_potong-add-form');
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
