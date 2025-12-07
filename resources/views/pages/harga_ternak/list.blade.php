<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("harga_ternak/add");
    $can_edit = $user->canAccess("harga_ternak/edit");
    $can_view = $user->canAccess("harga_ternak/view");
    $can_delete = $user->canAccess("harga_ternak/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Harga Ternak"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Harga Ternak</div>
                    </div>
                </div>
                <div class="col-md-auto  " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary" href="<?php print_link("harga_ternak/add", true) ?>" >
                    <i class="icon dripicons-plus"></i>                             
                    Add New Harga Ternak 
                </a>
                <?php } ?>
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
                    <div id="harga_ternak-list-records">
                        <div id="page-main-content" class="table-responsive">
                            <?php Html::page_bread_crumb("/harga_ternak/", $field_name, $field_value); ?>
                            <?php Html::display_page_errors($errors); ?>
                            <div class="filter-tags mb-2">
                                <?php Html::filter_tag('search', __('Search')); ?>
                            </div>
                            <div class="col-md-auto d-flex">    
                                <?php if($can_delete){ ?>
                                <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("harga_ternak/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
                                        <th class="td-sapi" > Sapi</th>
                                        <th class="td-kambing" > Kambing</th>
                                        <th class="td-domba" > Domba</th>
                                        <th class="td-ayam_pedaging" > Ayam Pedaging</th>
                                        <th class="td-ayam_petelor" > Ayam Petelor</th>
                                        <th class="td-ayam_petelor_afkir" > Ayam Petelor Afkir</th>
                                        <th class="td-burung_puyuh" > Burung Puyuh</th>
                                        <th class="td-burung_dara" > Burung Dara</th>
                                        <th class="td-itik" > Itik</th>
                                        <th class="td-entok" > Entok</th>
                                        <th class="td-susu_sapi" > Susu Sapi</th>
                                        <th class="td-susu_kambing" > Susu Kambing</th>
                                        <th class="td-id" > Id</th>
                                        <th class="td-tanggal" > Tanggal</th>
                                        <th class="td-penulis" > Penulis</th>
                                        <th class="td-daging_sapi" > Daging Sapi</th>
                                        <th class="td-daging_ayam" > Daging Ayam</th>
                                        <th class="td-daging_kambing" > Daging Kambing</th>
                                        <th class="td-daging_babi" > Daging Babi</th>
                                        <th class="td-harga_telur" > Harga Telur</th>
                                        <th class="td-daging_bebek" > Daging Bebek</th>
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
                                        <td class="td-sapi">
                                            <?php echo  $data['sapi'] ; ?>
                                        </td>
                                        <td class="td-kambing">
                                            <?php echo  $data['kambing'] ; ?>
                                        </td>
                                        <td class="td-domba">
                                            <?php echo  $data['domba'] ; ?>
                                        </td>
                                        <td class="td-ayam_pedaging">
                                            <?php echo  $data['ayam_pedaging'] ; ?>
                                        </td>
                                        <td class="td-ayam_petelor">
                                            <?php echo  $data['ayam_petelor'] ; ?>
                                        </td>
                                        <td class="td-ayam_petelor_afkir">
                                            <?php echo  $data['ayam_petelor_afkir'] ; ?>
                                        </td>
                                        <td class="td-burung_puyuh">
                                            <?php echo  $data['burung_puyuh'] ; ?>
                                        </td>
                                        <td class="td-burung_dara">
                                            <?php echo  $data['burung_dara'] ; ?>
                                        </td>
                                        <td class="td-itik">
                                            <?php echo  $data['itik'] ; ?>
                                        </td>
                                        <td class="td-entok">
                                            <?php echo  $data['entok'] ; ?>
                                        </td>
                                        <td class="td-susu_sapi">
                                            <?php echo  $data['susu_sapi'] ; ?>
                                        </td>
                                        <td class="td-susu_kambing">
                                            <?php echo  $data['susu_kambing'] ; ?>
                                        </td>
                                        <td class="td-id">
                                            <a href="<?php print_link("/harga_ternak/view/$data[id]") ?>"><?php echo $data['id']; ?></a>
                                        </td>
                                        <td class="td-tanggal">
                                            <?php echo  $data['tanggal'] ; ?>
                                        </td>
                                        <td class="td-penulis">
                                            <?php echo  $data['penulis'] ; ?>
                                        </td>
                                        <td class="td-daging_sapi">
                                            <?php echo  $data['daging_sapi'] ; ?>
                                        </td>
                                        <td class="td-daging_ayam">
                                            <?php echo  $data['daging_ayam'] ; ?>
                                        </td>
                                        <td class="td-daging_kambing">
                                            <?php echo  $data['daging_kambing'] ; ?>
                                        </td>
                                        <td class="td-daging_babi">
                                            <?php echo  $data['daging_babi'] ; ?>
                                        </td>
                                        <td class="td-harga_telur">
                                            <?php echo  $data['harga_telur'] ; ?>
                                        </td>
                                        <td class="td-daging_bebek">
                                            <?php echo  $data['daging_bebek'] ; ?>
                                        </td>
                                        <!--PageComponentEnd-->
                                        <td class="td-btn">
                                            <?php if($can_view){ ?>
                                            <a class="btn btn-sm btn-primary has-tooltip "    href="<?php print_link("harga_ternak/view/$rec_id"); ?>" >
                                            <i class="icon dripicons-preview"></i> View
                                        </a>
                                        <?php } ?>
                                        <?php if($can_edit){ ?>
                                        <a class="btn btn-sm btn-success has-tooltip "    href="<?php print_link("harga_ternak/edit/$rec_id"); ?>" >
                                        <i class="icon dripicons-document-edit"></i> Edit
                                    </a>
                                    <?php } ?>
                                    <?php if($can_delete){ ?>
                                    <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal"  href="<?php print_link("harga_ternak/delete/$rec_id"); ?>" >
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
