<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("pelaku_usaha_peternakan/add");
    $can_edit = $user->canAccess("pelaku_usaha_peternakan/edit");
    $can_view = $user->canAccess("pelaku_usaha_peternakan/view");
    $can_delete = $user->canAccess("pelaku_usaha_peternakan/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Pelaku Usaha Peternakan"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Pelaku Usaha Peternakan</div>
                    </div>
                </div>
                <div class="col-md-auto  " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary" href="<?php print_link("pelaku_usaha_peternakan/add", true) ?>" >
                    <i class="icon dripicons-plus"></i>                             
                    Add New Pelaku Usaha Peternakan 
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
                    <div id="pelaku_usaha_peternakan-list-records">
                        <div id="page-main-content" class="table-responsive">
                            <?php Html::page_bread_crumb("/pelaku_usaha_peternakan/", $field_name, $field_value); ?>
                            <?php Html::display_page_errors($errors); ?>
                            <div class="filter-tags mb-2">
                                <?php Html::filter_tag('search', __('Search')); ?>
                            </div>
                            <div class="col-md-auto d-flex">    
                                <?php if($can_delete){ ?>
                                <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("pelaku_usaha_peternakan/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
                                        <th class="td-id" > Id</th>
                                        <th class="td-nama_usaha" > Nama Usaha</th>
                                        <th class="td-nama_pemilik" > Nama Pemilik</th>
                                        <th class="td-lokasi" > Lokasi</th>
                                        <th class="td-rt" > Rt</th>
                                        <th class="td-rw" > Rw</th>
                                        <th class="td-kelurahan" > Kelurahan</th>
                                        <th class="td-kecamatan" > Kecamatan</th>
                                        <th class="td-username" > Penulis</th>
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
                                        $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                        $counter++;
                                    ?>
                                    <tr>
                                        <?php if($can_delete){ ?>
                                        <td class=" td-checkbox">
                                            <label class="form-check-label">
                                            <input class="optioncheck form-check-input" name="optioncheck[]" value="<?php echo $data['id'] ?>" type="checkbox" />
                                            </label>
                                        </td>
                                        <?php } ?>
                                        <!--PageComponentStart-->
                                        <td class="td-id">
                                            <a href="<?php print_link("/pelaku_usaha_peternakan/view/$data[id]") ?>"><?php echo $data['id']; ?></a>
                                        </td>
                                        <td class="td-nama_usaha">
                                            <?php echo  $data['nama_usaha'] ; ?>
                                        </td>
                                        <td class="td-nama_pemilik">
                                            <?php echo  $data['nama_pemilik'] ; ?>
                                        </td>
                                        <td class="td-lokasi">
                                            <?php echo  $data['lokasi'] ; ?>
                                        </td>
                                        <td class="td-rt">
                                            <?php echo  $data['rt'] ; ?>
                                        </td>
                                        <td class="td-rw">
                                            <?php echo  $data['rw'] ; ?>
                                        </td>
                                        <td class="td-wilayah_kelurahan">
                                            <?php echo  $data['wilayah_kelurahan'] ; ?>
                                        </td>
                                        <td class="td-wilayah_kecamatan">
                                            <?php echo  $data['wilayah_kecamatan'] ; ?>
                                        </td>
                                        <td class="td-aauth_users_username">
                                            <?php echo  $data['aauth_users_username'] ; ?>
                                        </td>
                                        <!--PageComponentEnd-->
                                        <td class="td-btn">
                                            <?php if($can_view){ ?>
                                            <a class="btn btn-sm btn-primary has-tooltip "    href="<?php print_link("pelaku_usaha_peternakan/view/$rec_id"); ?>" >
                                            <i class="icon dripicons-preview"></i> View
                                        </a>
                                        <?php } ?>
                                        <?php if($can_edit){ ?>
                                        <a class="btn btn-sm btn-success has-tooltip "    href="<?php print_link("pelaku_usaha_peternakan/edit/$rec_id"); ?>" >
                                        <i class="icon dripicons-document-edit"></i> Edit
                                    </a>
                                    <?php } ?>
                                    <?php if($can_delete){ ?>
                                    <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal"  href="<?php print_link("pelaku_usaha_peternakan/delete/$rec_id"); ?>" >
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
