<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("photo/add");
    $can_edit = $user->canAccess("photo/edit");
    $can_view = $user->canAccess("photo/view");
    $can_delete = $user->canAccess("photo/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Photo"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Photo</div>
                    </div>
                </div>
                <div class="col-md-auto  " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary" href="<?php print_link("photo/add", true) ?>" >
                    <i class="icon dripicons-plus"></i>                             
                    Add New Photo 
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
                    <div id="photo-list-records">
                        <?php
                            if($total_records){
                        ?>
                        <div id="page-main-content">
                            <?php Html::page_bread_crumb("/photo/", $field_name, $field_value); ?>
                            <?php Html::display_page_errors($errors); ?>
                            <div class="filter-tags mb-2">
                                <?php Html::filter_tag('search', __('Search')); ?>
                            </div>
                            <div class="col-md-auto d-flex">    
                                <?php if($can_delete){ ?>
                                <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("photo/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                                <i class="icon dripicons-cross"></i> Delete Selected
                                </button>
                                <?php } ?>
                            </div>
                            <div class="row gutter-lg page-data">
                                <!--record-->
                                <?php
                                    $counter = 0;
                                    foreach($records as $data){
                                    $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                    $counter++;
                                ?>
                                <!--PageComponentStart-->
                                <div class=" col-12 col-md-4">
                                    <div class="card-2 rounded p-3 mb-3 ">
                                        <div class="text-center">
                                            <?php  Html::img($data['url'] , "100%", "200px", "medium", 1);  ?>
                                        </div>
                                        <div class="p-3 d-flex justify-content-between">
                                            <h6 class="font-weight-bold text-truncate"><?php echo ($data['id_content']); ?></h6>
                                            <div class="d-flex gap-2 justify-content-between">
                                                <?php if($can_view){ ?>
                                                <a class="btn btn-sm btn-primary has-tooltip page-modal"    href="<?php print_link("photo/view/$rec_id"); ?>" >
                                                <i class="icon dripicons-preview"></i> View
                                            </a>
                                            <?php } ?>
                                            <?php if($can_edit){ ?>
                                            <a class="btn btn-sm btn-success has-tooltip page-modal"    href="<?php print_link("photo/edit/$rec_id"); ?>" >
                                            <i class="icon dripicons-document-edit"></i> Edit
                                        </a>
                                        <?php } ?>
                                        <?php if($can_delete){ ?>
                                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal"  href="<?php print_link("photo/delete/$rec_id"); ?>" >
                                        <i class="icon dripicons-cross"></i> Delete
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--PageComponentEnd-->
                    <?php 
                        }
                    ?>
                    <!--endrecord-->
                </div>
                <div class="row gutter-lg search-data"></div>
                <div>
                </div>
            </div>
            <?php
                if($show_footer){
            ?>
            <div class=" mt-3">
                <div class="row justify-content-between">   
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
                }
                else{
            ?>
            <div class="text-muted  animated bounce p-3">
                <h4><i class="icon dripicons-wrong"></i> No record found</h4>
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
