<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("peternak/add");
    $can_edit = $user->canAccess("peternak/edit");
    $can_view = $user->canAccess("peternak/view");
    $can_delete = $user->canAccess("peternak/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Peternak"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="list" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center">
                <div class="col col-md-auto  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">Peternak</div>
                    </div>
                </div>
                <div class="col-md-auto  " >
                </div>
                <div class="col-md-3  " >
                    <!-- Page drop down search component -->
                    <form  class="search" action="{{ url()->current() }}" method="get">
                        <input type="hidden" name="page" value="1" />
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control page-search" type="text" name="search"  placeholder="Search" />
                            <button class="btn btn-primary"><i class="icon dripicons-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>
    <div  class="mb-3" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col-6 comp-grid " >
                    <?php $rec_count = $comp_model->getcount_peternak();  ?>
                    <a class="animated zoomIn record-count alert alert-primary"  href='<?php print_link("peternak") ?>' >
                    <div class="row gutter-sm align-items-center">
                        <div class="col-auto" style="opacity: 1;">
                            <i class="icon dripicons-help"></i>
                        </div>
                        <div class="col">
                            <div class="flex-column justify-content align-center">
                                <div class="title">Peternak</div>
                                <small class="">Total Peternak</small>
                            </div>
                            <h2 class="value"><?php echo $rec_count; ?></h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 comp-grid " >
                <?php $rec_count = $comp_model->getcount_totalproduksi();  ?>
                <a class="animated zoomIn record-count alert alert-primary"  href='<?php print_link("peternak") ?>' >
                <div class="row gutter-sm align-items-center">
                    <div class="col-auto" style="opacity: 1;">
                        <i class="icon dripicons-help"></i>
                    </div>
                    <div class="col">
                        <div class="flex-column justify-content align-center">
                            <div class="title">Total Produksi</div>
                            <small class="">Total Produksi</small>
                        </div>
                        <h2 class="value"><?php echo $rec_count; ?></h2>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
</div>
<div  class="mb-3" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col-6 comp-grid " >
                <!--Include chart component-->
                @include("pages.peternak-depan-jumlah-peternak-berdasar-jenis")
            </div>
            <div class="col-6 comp-grid " >
                <!--Include chart component-->
                @include("pages.peternak-depan-jumlah-peternak-berdasar-kelurahan")
            </div>
        </div>
    </div>
</div>
<div  class="" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col comp-grid " >
                <div  class=" page-content" >
                    <link rel="stylesheet" media="all" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css">
                        <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
                        <div class="row full">
                            <div id="map" class="col-12 full"></div>
                        </div>
                        <script>
                            var map = L.map('map').setView([-8.0981595,112.1626098], 13);
                            L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                            maxZoom: 20,
                            subdomains:['mt0','mt1','mt2','mt3']
                            }).addTo(map);
                            function addRowTable(code, coords){
                            var tr = document.createElement("tr");
                            var td = document.createElement("td");
                            td.textContent = code + "_" + coords;
                            tr.appendChild(td);
                            tr.onclick = function(){map.flyTo(coords, 17);};
                            document.getElementById("t_points").appendChild(tr);
                            }
                            var buffers = [];
                            function addMarker(point){
                            var p = L.marker([point[1],point[2]]);
                            p.title = point[0];
                            p.alt = point[0];
                            p.bindPopup(
                            "<table>"+
                                "<tr><td>Nama</td><td>:</td><td>"+point[0] +"</td></tr>"+
                                "<tr><td>Alamat</td><td>:</td><td>"+point[4] +"</td></tr>"+
                                "<tr><td>produksi</td><td>:</td><td>"+point[7] +"</td></tr>"+
                                "<tr><td>kelurahan</td><td>:</td><td>"+point[5] +"</td></tr>"+
                                "<tr><td>Kecamatan</td><td>:</td><td>"+point[6] +"</td></tr>"+
                                "<tr><td>nama_jenis</td><td>:</td><td>"+point[3] +"</td></tr>"+
                            "</table>");
                            p.addTo(map);
                            //addRowTable(code, [lat,lng]);
                            var c = L.circle([point[1],point[2]], {
                            color: 'red',
                            fillColor: '#f03',
                            fillOpacity: 0.5,
                            radius: 0
                            }).addTo(map);
                            buffers.push(c);
                            }
                            $(document).ready(function (){
                            var points = [
                            <?php     foreach($records as $data){ ?>
                            ["<?php echo  $data['nama'] ; ?>",<?php echo  $data['lat'] ; ?>,<?php echo  $data['long'] ; ?>,"<?php echo  $data['jenis_hewan_nama_jenis'] ; ?>","<?php echo  $data['alamat'] ; ?>", "<?php echo  $data['wilayah_kelurahan'] ; ?>", " <?php echo  $data['wilayah_kecamatan'] ; ?>", " <?php echo  $data['produksi'] ; ?>"],
                            <?php } ?>
                            ];
                            console.log(points);
                            for (var i=0; i < points.length; i++){
                            addMarker(points[i]);
                            }
                            });
                        </script> 
                        <div id="peternak-depan-records">
                            <div id="page-main-content" class="table-responsive">
                                <?php Html::page_bread_crumb("/peternak/depan", $field_name, $field_value); ?>
                                <table class="table table-hover table-striped table-sm text-left">
                                    <thead class="table-header ">
                                        <tr>
                                            <th class="td-nama" > Nama</th>
                                            <th class="td-alamat" > Alamat</th>
                                            <th class="td-produksi" > Produksi</th>
                                            <th class="td-kelurahan" > Wilayah Kelurahan</th>
                                            <th class="td-kecamatan" > Wilayah Kecamatan</th>
                                            <th class="td-nama_jenis" > Jenis Hewan</th>
                                            <th class="td-long" > Long</th>
                                            <th class="td-lat" > Lat</th>
                                        </tr>
                                    </thead>
                                    <?php
                                        if($total_records){
                                    ?>
                                    <tbody class="page-data">
                                        <!--record-->
                                        <?php
                                            $counter = 0;
                                            foreach($records as $data){
                                            $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                            $counter++;
                                        ?>
                                        <tr>
                                            <!--PageComponentStart-->
                                            <td class="td-nama">
                                                <?php echo  $data['nama'] ; ?>
                                            </td>
                                            <td class="td-alamat">
                                                <?php echo  $data['alamat'] ; ?>
                                            </td>
                                            <td class="td-produksi">
                                                <?php echo  $data['produksi'] ; ?>
                                            </td>
                                            <td class="td-wilayah_kelurahan">
                                                <?php echo  $data['wilayah_kelurahan'] ; ?>
                                            </td>
                                            <td class="td-wilayah_kecamatan">
                                                <?php echo  $data['wilayah_kecamatan'] ; ?>
                                            </td>
                                            <td class="td-jenis_hewan_nama_jenis">
                                                <?php echo  $data['jenis_hewan_nama_jenis'] ; ?>
                                            </td>
                                            <td class="td-long">
                                                <?php echo  $data['long'] ; ?>
                                            </td>
                                            <td class="td-lat">
                                                <?php echo  $data['lat'] ; ?>
                                            </td>
                                            <!--PageComponentEnd-->
                                        </tr>
                                        <?php 
                                            }
                                        ?>
                                        <!--endrecord-->
                                    </tbody>
                                    <tbody class="search-data"></tbody>
                                    <?php
                                        }
                                        else{
                                    ?>
                                    <tbody class="page-data">
                                        <tr>
                                            <td class="bg-light text-center text-muted animated bounce p-3" colspan="1000">
                                                <i class="icon dripicons-wrong"></i> No record found
                                            </td>
                                        </tr>
                                    </tbody>
                                    <?php
                                        }
                                    ?>
                                </table>
                            </div>
                            <?php
                                if($show_footer){
                            ?>
                            <div class=" mt-3">
                                <div class="row align-items-center justify-content-between">    
                                    <div class="col-md-auto justify-content-center">    
                                        <div class="d-flex justify-content-start">  
                                        </div>
                                    </div>
                                    <div class="col">   
                                        <?php
                                            if($show_pagination == true){
                                            $pager = new Pagination($total_records, $record_count);
                                            $pager->show_page_count = true;
                                            $pager->show_record_count = true;
                                            $pager->show_page_limit =true;
                                            $pager->limit = $limit;
                                            $pager->show_page_number_list = true;
                                            $pager->pager_link_range=5;
                                            $pager->render();
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
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
