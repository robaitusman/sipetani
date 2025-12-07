<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("kios_daging/add");
    $can_edit = $user->canAccess("kios_daging/edit");
    $can_view = $user->canAccess("kios_daging/view");
    $can_delete = $user->canAccess("kios_daging/delete");
    $pageTitle = "Kios Daging Details"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="view" data-page-url="{{ url()->full() }}">
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
                        <div class="h5 font-weight-bold text-primary">Kios Daging Details</div>
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
                <div class="col comp-grid " >
                    <div  class=" page-content" >
                        <?php
                            $counter = 0;
                            if($data){
                            $rec_id = ($data['id_kios'] ? urlencode($data['id_kios']) : null);
                            $counter++;
                        ?>
                        <div id="page-main-content" class=" px-3 mb-3">
                            <div class="page-data row">
                                <!--PageComponentStart-->
                                <div class="col-md-5 comp-grid " >
                                    <h5 class="mb-1"> Detail Data</h5>
                                    <div class="mb-3 row row gutter-lg">
                                        <div class="mb-3 card-1 p-2 border rounded">
                                            <table class="table table-hover table-striped table-sm text-left">
                                                @foreach ($data->toArray() as $column => $value)
                                                @if(  $column=='status' ) 
                                                @elseif(  $column=='long' ) 
                                                @elseif(  $column=='lokasi' ) 
                                                @elseif(  $column=='photo' ) 
                                                @elseif(  $column=='lat' ) 
                                                @else
                                                <tr>
                                                    <td style="width: 30%;"><b>{{ $column }}</b></td><td style="width: 5%;">:</td><td>  {{ $value }}</td>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 comp-grid " >
                                    <h5 class="mb-1"> Galeri Photo</h5>
                                    <?php
                                        $string = $data['photo'];
                                        $array = explode(',', $string); 
                                    ?>
                                    <div class="row">
                                        <?php 
                                            foreach($array as $value) //loop over values
                                            {
                                        ?>
                                        <div class="col-md-4 mb-3 p-2">
                                            <div class=" card-1  border rounded">
                                                <?php    Html :: page_img($value, 'auto', 'auto', "", 1); ?>
                                            </div>
                                        </div>
                                        <?php 
                                            }
                                        ?>
                                    </div>
                                    <br>
                                    <h5 class="mb-1"> Peta Lokasi</h5>
                                    <div class="mb-3 card-1 p-2 border rounded">
                                        <div id="map" style="height: 400px"></div>
                                    </div>
                                    <script>
                                        var map = L.map('map', {
                                        center: [-8.100000, 112.150002],
                                        zoom: 14
                                        });
                                        // Create a Tile Layer and add it to the map
                                        L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                                        maxZoom: 20,
                                        subdomains:['mt0','mt1','mt2','mt3']
                                        }).addTo(map);
                                        var marker = L.marker(
                                        [<?php echo $data['lat'] ?>, <?php echo $data['long'] ?>],
                                        { 
                                        draggable: false,
                                        title: ""
                                        });
                                        marker.addTo(map).bindPopup("<p1><?php echo $data['alamat'] ?></p1>") .openPopup();
                                    </script>
                                </div>
                            </div>
                            <!--PageComponentEnd-->
                            <div class="d-flex gap-1 justify-content-start">
                                <?php if($can_edit){ ?>
                                <a class="btn btn-sm btn-success has-tooltip "   title="Edit" href="<?php print_link("peternak/edit/$rec_id"); ?>" >
                                <i class="icon dripicons-document-edit"></i> Edit
                            </a>
                            <?php } ?>
                            <?php if($can_delete){ ?>
                            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal" title="Delete" href="<?php print_link("peternak/delete/$rec_id?redirect=peternak"); ?>" >
                            <i class="icon dripicons-cross"></i> Delete
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
                }
                else{
            ?>
            <!-- Empty Record Message -->
            <div class="text-muted p-3">
                <i class="icon dripicons-wrong"></i> No Record Found
            </div>
            <?php
                }
            ?>
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

$(document).ready(function(){
	// custom javascript | jquery codes
});
</script>

@endsection
