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
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Kios Daging"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Kios Daging</div>
                    </div>
                </div>
                <div class="col-md-auto  " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary" href="<?php print_link("kios_daging/add", true) ?>" >
                    <i class="icon dripicons-plus"></i>                             
                    Add New Kios Daging 
                </a>
                <?php } ?>
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
<div  class="" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col comp-grid " >
                <div  class=" page-content" >
                    <div id="kios_daging-peta-records">
                        <div id="page-main-content" class="table-responsive">
                            <?php Html::page_bread_crumb("/kios_daging/peta", $field_name, $field_value); ?>
                            <?php Html::display_page_errors($errors); ?>
                            <div class="filter-tags mb-2">
                                <?php Html::filter_tag('search', __('Search')); ?>
                            </div>
                            <div class="col-md-auto d-flex">    
                                <?php if($can_delete){ ?>
                                <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("kios_daging/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                <i class="icon dripicons-cross"></i> Delete Selected
                                </button>
                                <?php } ?>
                            </div>
                            <table class="table table-hover table-striped table-sm text-left">
                                <thead class="table-header ">
                                    <tr>
                                        <?php if($can_delete){ ?>
                                        <th class="td-checkbox">
                                        <label class="form-check-label">
                                        <input class="toggle-check-all form-check-input" type="checkbox" />
                                        </label>
                                        </th>
                                        <?php } ?>
                                        <th class="td-id_kios" > Id Kios</th>
                                        <th class="td-nama_usaha" > Nama Usaha</th>
                                        <th class="td-nama_pemilik" > Nama Pemilik</th>
                                        <th class="td-kapasitas" > Kapasitas</th>
                                        <th class="td-alamat" > Alamat</th>
                                        <th class="td-id_wilayah" > Id Wilayah</th>
                                        <th class="td-rt" > Rt</th>
                                        <th class="td-rw" > Rw</th>
                                        <th class="td-kontak" > Kontak</th>
                                        <th class="td-id_map" > Id Map</th>
                                        <th class="td-legalitas" > Legalitas</th>
                                        <th class="td-ket_legalitas" > Ket Legalitas</th>
                                        <th class="td-visibility" > Visibility</th>
                                        <th class="td-status" > Status</th>
                                        <th class="td-created_at" > Created At</th>
                                        <th class="td-photo" > Photo</th>
                                        <th class="td-lokasi" > Lokasi</th>
                                        <th class="td-long" > Long</th>
                                        <th class="td-lat" > Lat</th>
                                        <th class="td-penulis" > Penulis</th>
                                        <th class="td-btn"></th>
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
                                        $rec_id = ($data['id_kios'] ? urlencode($data['id_kios']) : null);
                                        $counter++;
                                    ?>
                                    <tr>
                                        <?php if($can_delete){ ?>
                                        <td class=" td-checkbox">
                                            <label class="form-check-label">
                                            <input class="optioncheck form-check-input" name="optioncheck[]" value="<?php echo $data['id_kios'] ?>" type="checkbox" />
                                            </label>
                                        </td>
                                        <?php } ?>
                                        <!--PageComponentStart-->
                                        <td class="td-id_kios">
                                            <a href="<?php print_link("/kios_daging/view/$data[id_kios]") ?>"><?php echo $data['id_kios']; ?></a>
                                        </td>
                                        <td class="td-nama_usaha">
                                            <?php echo  $data['nama_usaha'] ; ?>
                                        </td>
                                        <td class="td-nama_pemilik">
                                            <?php echo  $data['nama_pemilik'] ; ?>
                                        </td>
                                        <td class="td-kapasitas">
                                            <?php echo  $data['kapasitas'] ; ?>
                                        </td>
                                        <td class="td-alamat">
                                            <?php echo  $data['alamat'] ; ?>
                                        </td>
                                        <td class="td-id_wilayah">
                                            <?php echo  $data['id_wilayah'] ; ?>
                                        </td>
                                        <td class="td-rt">
                                            <?php echo  $data['rt'] ; ?>
                                        </td>
                                        <td class="td-rw">
                                            <?php echo  $data['rw'] ; ?>
                                        </td>
                                        <td class="td-kontak">
                                            <?php echo  $data['kontak'] ; ?>
                                        </td>
                                        <td class="td-id_map">
                                            <?php echo  $data['id_map'] ; ?>
                                        </td>
                                        <td class="td-legalitas">
                                            <?php echo  $data['legalitas'] ; ?>
                                        </td>
                                        <td class="td-ket_legalitas">
                                            <?php echo  $data['ket_legalitas'] ; ?>
                                        </td>
                                        <td class="td-visibility">
                                            <?php echo  $data['visibility'] ; ?>
                                        </td>
                                        <td class="td-status">
                                            <?php echo  $data['status'] ; ?>
                                        </td>
                                        <td class="td-created_at">
                                            <?php echo  $data['created_at'] ; ?>
                                        </td>
                                        <td class="td-photo">
                                            <?php 
                                                Html :: page_img($data['photo'], '50px', '50px', "small", 1); 
                                            ?>
                                        </td>
                                        <td class="td-lokasi">
                                            <?php echo  $data['lokasi'] ; ?>
                                        </td>
                                        <td class="td-long">
                                            <?php echo  $data['long'] ; ?>
                                        </td>
                                        <td class="td-lat">
                                            <?php echo  $data['lat'] ; ?>
                                        </td>
                                        <td class="td-penulis">
                                            <?php echo  $data['penulis'] ; ?>
                                        </td>
                                        <!--PageComponentEnd-->
                                        <td class="td-btn">
                                            <?php if($can_view){ ?>
                                            <a class="btn btn-sm btn-primary has-tooltip "    href="<?php print_link("kios_daging/view/$rec_id"); ?>" >
                                            <i class="icon dripicons-preview"></i> View
                                        </a>
                                        <?php } ?>
                                        <?php if($can_edit){ ?>
                                        <a class="btn btn-sm btn-success has-tooltip "    href="<?php print_link("kios_daging/edit/$rec_id"); ?>" >
                                        <i class="icon dripicons-document-edit"></i> Edit
                                    </a>
                                    <?php } ?>
                                    <?php if($can_delete){ ?>
                                    <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal"  href="<?php print_link("kios_daging/delete/$rec_id"); ?>" >
                                    <i class="icon dripicons-cross"></i> Delete
                                </a>
                                <?php } ?>
                            </td>
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
                    <div class="col">   
                        <?php
                            if($show_pagination == true){
                            $pager = new Pagination($total_records, $record_count);
                            $pager->show_page_count = false;
                            $pager->show_record_count = true;
                            $pager->show_page_limit =false;
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
</script>

@endsection
