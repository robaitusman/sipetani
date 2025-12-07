<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("beranda/add");
    $can_edit = $user->canAccess("beranda/edit");
    $can_view = $user->canAccess("beranda/view");
    $can_delete = $user->canAccess("beranda/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Beranda"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Beranda</div>
                    </div>
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
        <div class="container">
            <div class="row ">
                <div class="col comp-grid " >
                    <div  class=" page-content" >
                        <div id="beranda-list-records">
                            <div id="page-main-content" class="table-responsive">
                                <?php Html::page_bread_crumb("/beranda/", $field_name, $field_value); ?>
                                <?php Html::display_page_errors($errors); ?>
                                <div class="filter-tags mb-2">
                                    <?php Html::filter_tag('search', __('Search')); ?>
                                </div>
                                <div class="col-md-auto d-flex">    
                                </div>
                                <table class="table table-hover table-striped table-sm text-left">
                                    <thead class="table-header ">
                                        <tr>
                                            <th class="td-id" > Id</th>
                                            <th class="td-judul" > Judul</th>
                                            <th class="td-deskripsi" > Deskripsi</th>
                                            <th class="td-img_slider" > Img Slider</th>
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
                                            <td class="td-id">
                                                <?php echo  $data['id'] ; ?>
                                            </td>
                                            <td class="td-judul">
                                                <?php echo  $data['judul'] ; ?>
                                            </td>
                                            <td class="td-deskripsi">
                                                <?php echo  $data['deskripsi'] ; ?>
                                            </td>
                                            <td class="td-img_slider">
                                                <?php echo  $data['img_slider'] ; ?>
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
