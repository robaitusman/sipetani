<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("indikatormaster/add");
    $can_edit = $user->canAccess("indikatormaster/edit");
    $can_view = $user->canAccess("indikatormaster/view");
    $can_delete = $user->canAccess("indikatormaster/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Indikator "; //set dynamic page title
    $id_period = request()->get('period') ?? getActivePeriod();
    $summary = getSummarySakip(auth()->id(), $id_period, auth()->user()->user_role_id);

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
                        <div class="h5 font-weight-bold text-primary">Indikator Kinerja</div>
                    </div>
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

<?php
    }
?>



<div class="row mb-4">
    <!-- Persentase Input -->
    <div class="col-md-4">
        <div class="card text-white bg-primary shadow-sm">
            <div class="card-body">
                <h6 class="card-title">Persentase Input</h6>
                <h3 class="mb-0">{{ $summary['persen'] }}%</h3>
                <small class="text-light">{{ $summary['sudah'] }} dari {{ $summary['total'] }} indikator</small>
            </div>
        </div>
    </div>

    <!-- Belum Terinput -->
    <div class="col-md-4">
        <div class="card text-white bg-danger shadow-sm">
            <div class="card-body">
                <h6 class="card-title">Belum Terinput</h6>
                <h3 class="mb-0">{{ $summary['belum'] }}</h3>
                <small class="text-light">indikator</small>
            </div>
        </div>
    </div>

    <!-- Sudah Terinput -->
    <div class="col-md-4">
        <div class="card text-white bg-success shadow-sm">
            <div class="card-body">
                <h6 class="card-title">Sudah Terinput</h6>
                <h3 class="mb-0">{{ $summary['sudah'] }}</h3>
                <small class="text-light">indikator</small>
            </div>
        </div>
    </div>
</div>


<div  class="" >
    <div class="container-fluid">
        <div class="row ">
            <div class="col comp-grid " >
                <div  class=" page-content" >
                    <div id="indikatormaster-input-records">
                        <div id="page-main-content" class="table-responsive">
                            <?php Html::page_bread_crumb("/indikatormaster/input", $field_name, $field_value); ?>
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
                                        <th class="td-urutan" > No</th>
                                        <th class="td-sasaran_program" style="width:40%;"> Sasaran Program</th>
                                        <th class="td-indikator_kinerja" style="width:40%;"> Indikator Kinerja</th>
                                        <th class="td-satuan" > Satuan</th>
                                        <th class="td-satuan" > Nilai</th>
                                        <th class="td-is_active" > Aksi</th>
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
                                          $hasEvaluasi = !empty($data['evaluasi_id']);
                                        
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
                                        <td class="td-urutan">
                                            <?php echo  $data['urutan'] ; ?>
                                        </td>
                                        <td class="td-sasaran_program">
                                            <?php echo  $data['sasaran_program'] ; ?>
                                        </td>
                                        <td class="td-indikator_kinerja">
                                            <?php echo  $data['indikator_kinerja'] ; ?>
                                        </td>
                                        <td class="td-satuan">
                                            <?php echo  $data['satuan'] ; ?>
                                        </td>
                                         <td class="td-evaluasiindikator_nilai">
                                            <?php echo $hasEvaluasi ? $data['evaluasi_nilai'] : '-'; ?>
                                        </td>
                                        <td class="td-is_active">
                                         
                                            @if($hasEvaluasi)
                                            <div class="d-flex flex-column align-items-center">
                                                <span class="badge bg-success mb-1">
                                                <i class="dripicons-checkmark me-1"></i> Sudah
                                                </span>
                                                <a href="{{ url('evaluasiindikator/edit/' . $data['evaluasi_id']) }}" 
                                                    class="btn btn-success btn-sm page-drawer" data-bs-toggle="tooltip" title="Edit Data">
                                                    <i class="dripicons-document-edit"></i> Edit
                                                </a>
                                            </div>
                                            @else
                                            <a href="{{ url('evaluasiindikator/add') }}?indikator_master_id={{ $data['id'] }}&period={{ $id_period }}" 
                                                class="btn btn-primary btn-sm page-drawer">
                                                <i class="dripicons-plus"></i> input
                                            </a>
                                            @endif
                                        </td>
                                        <!--PageComponentEnd-->
                                        <td class="td-btn">
                                            <?php if($can_view){ ?>
                                            <a class="btn btn-sm btn-primary has-tooltip "    href="<?php print_link("indikatormaster/view/$rec_id"); ?>" >
                                            <i class="icon dripicons-preview"></i> View
                                        </a>
                                        <?php } ?>
                                        <?php if($can_edit){ ?>
                                        <a class="btn btn-sm btn-success has-tooltip "    href="<?php print_link("indikatormaster/edit/$rec_id"); ?>" >
                                        <i class="icon dripicons-document-edit"></i> Edit
                                    </a>
                                    <?php } ?>
                                    <?php if($can_delete){ ?>
                                    <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal"  href="<?php print_link("indikatormaster/delete/$rec_id"); ?>" >
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
                        <button data-prompt-msg="Are you sure you want to delete these records?" data-display-style="modal" data-url="<?php print_link("indikatormaster/delete/{sel_ids}"); ?>" class="btn btn-sm btn-danger btn-delete-selected d-none">
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
