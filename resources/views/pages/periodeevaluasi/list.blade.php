<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("periodeevaluasi/add");
    $can_edit = $user->canAccess("periodeevaluasi/edit");
    $can_view = $user->canAccess("periodeevaluasi/view");
    $can_delete = $user->canAccess("periodeevaluasi/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Periode Evaluasi"; //set dynamic page title
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
            <div class="row justify-content-between align-items-center gap-3">
                <div class="col  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">Periode Evaluasi</div>
                    </div>
                </div>
                <div class="col-auto  " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary btn-block" href="<?php print_link("periodeevaluasi/add", true) ?>" >
                    <i class="icon dripicons-plus"></i>                             
                    Add New Periode Evaluasi 
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
                    <div id="periodeevaluasi-list-records">
                        <div id="page-main-content" class="table-responsive">
                            <?php Html::page_bread_crumb("/periodeevaluasi/", $field_name, $field_value); ?>
                            <?php Html::display_page_errors($errors); ?>
                            <div class="filter-tags mb-2">
                                <?php Html::filter_tag('search', __('Search')); ?>
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
                                        <th class="td-tahun" > Tahun</th>
                                        <th class="td-nama_periode" > Nama Periode</th>
                                        <th class="td-deskripsi" > Deskripsi</th>
                                        <th class="td-tanggal_mulai" > Tanggal Mulai</th>
                                        <th class="td-tanggal_selesai" > Tanggal Selesai</th>
                                        <th class="td-status_periode" > Status Periode</th>
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
                                            <a href="<?php print_link("/periodeevaluasi/view/$data[id]") ?>"><?php echo $data['id']; ?></a>
                                        </td>
                                        <td class="td-tahun">
                                            <?php echo  $data['tahun'] ; ?>
                                        </td>
                                        <td class="td-nama_periode">
                                            <?php echo  $data['nama_periode'] ; ?>
                                        </td>
                                        <td class="td-deskripsi">
                                            <?php echo  $data['deskripsi'] ; ?>
                                        </td>
                                        <td class="td-tanggal_mulai">
                                            <?php echo  $data['tanggal_mulai'] ; ?>
                                        </td>
                                        <td class="td-tanggal_selesai">
                                            <?php echo  $data['tanggal_selesai'] ; ?>
                                        </td>
                                        <td class="td-status_periode">
                                            <?php echo  $data['status_periode'] ; ?>
                                        </td>
                                        <!--PageComponentEnd-->
                                        <td class="td-btn">
                                            <?php if($can_view){ ?>
                                            <a class="btn btn-sm btn-primary has-tooltip "    href="<?php print_link("periodeevaluasi/view/$rec_id"); ?>" >
                                            <i class="icon dripicons-preview"></i> View
                                        </a>
                                        <?php } ?>
                                        <?php if($can_edit){ ?>
                                        <a class="btn btn-sm btn-success has-tooltip "    href="<?php print_link("periodeevaluasi/edit/$rec_id"); ?>" >
                                        <i class="icon dripicons-document-edit"></i> Edit
                                    </a>
                                    <?php } ?>
                                    <?php if($can_delete){ ?>
                                    <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal"  href="<?php print_link("periodeevaluasi/delete/$rec_id"); ?>" >
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
                    <div class="col-md-auto d-flex">    
                        <?php if($can_delete){ ?>
                        <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("periodeevaluasi/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
                        <i class="icon dripicons-cross"></i> Delete Selected
                        </button>
                        <?php } ?>
                    </div>
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


@endsection
