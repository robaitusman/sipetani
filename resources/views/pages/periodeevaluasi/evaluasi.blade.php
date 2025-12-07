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
    $pageTitle = "Evaluasi Kinerja"; //set dynamic page title
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
                    <div id="periodeevaluasi-evaluasi-records">
                        <?php
                            if($total_records){
                        ?>
                        <div id="page-main-content">
                            <?php Html::page_bread_crumb("/periodeevaluasi/evaluasi", $field_name, $field_value); ?>
                            <?php Html::display_page_errors($errors); ?>
                            <div class="filter-tags mb-2">
                                <?php Html::filter_tag('search', __('Search')); ?>
                            </div>
                            <div class="row justify-content-start g-0 page-data">
                                <!--record-->
                                <?php
                                    $counter = 0;
                                    foreach($records as $data){
                                    $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                                    $counter++;
                                ?>
                                <!--PageComponentStart-->
                                <div class="col-12">
                                    <div class="bg-light mb-3 card p-3 border rounded">
                                        <!-- Informasi Umum dalam 6 kolom -->
                                        <div class="row mb-3">
                                            <div class="col-md-2">
                                                <div class="info-column">
                                                    <div class="info-label">Id</div>
                                                    <div class="info-value">
                                                        <a href="<?php print_link("/periodeevaluasi/view/$data[id]") ?>">
                                                            <?php echo $data['id']; ?>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="info-column">
                                                    <div class="info-label">Tahun</div>
                                                    <div class="info-value"><?php echo  $data['tahun'] ; ?></div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="info-column">
                                                    <div class="info-label">Nama Periode</div>
                                                    <div class="info-value"><?php echo  $data['nama_periode'] ; ?></div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="info-column">
                                                    <div class="info-label">Tanggal Mulai</div>
                                                    <div class="info-value"><?php echo human_date( $data['tanggal_mulai'] ); ?></div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="info-column">
                                                    <div class="info-label">Tanggal Selesai</div>
                                                    <div class="info-value"><?php echo human_date( $data['tanggal_selesai'] ); ?></div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="info-column">
                                                    <div class="info-label">Status</div>
                                                    <div class="info-value status-active"><?php echo strtoupper($data['status_periode']); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Dua Kolom: SAKIP dan ADATA -->
                                        <div class="row">
                                            <!-- Kolom SAKIP -->
                                             @php
                                                $percentage_sakip = getSummarySakip(auth()->user()->id, $data['id'], auth()->user()->user_role_id);
                                                @endphp
                                            <div class="col-md-6 p-4">
                                                <div class="section-header">
                                                    Progress input  SAKIP ( {{ $percentage_sakip['sudah'] }} / {{ $percentage_sakip['belum'] }})
                                                </div>
                                               
                                                <div class="progress-wrapper">
                                                    <div class="progress-bar mb-3">
                                                        <div class="progress-fill initialized" data-percentage="{{ $percentage_sakip['persen'] }}" style="width: {{ $percentage_sakip['persen'] }}%;"></div>
                                                    </div>
                                                    <span class="percentage-badge">{{ $percentage_sakip['persen'] }}%</span>
                                                </div>
                                                @if($data['status_periode'] == 'active')
                                                <a href="{{ url('indikatormaster/input') }}?period={{ $data['id'] }}&type=sakip" class="btn btn-primary w-100">
                                                    Input SAKIP
                                                </a>
                                                @endif
                                            </div>
                                            
                                            <!-- Kolom ADATA -->
                                            <div class="col-md-6 p-4">
                                                 @php
                                                $percentage_adata = getSummaryAdata(auth()->user()->id, $data['id'], auth()->user()->user_role_id);
                                                @endphp
                                                <div class="section-header">
                                                    Progress input  ADATA ({{ $percentage_adata['sudah'] }} / {{ $percentage_adata['belum'] }})
                                                </div>
                                               
                                                <div class="progress-wrapper">
                                                    <div class="progress-bar mb-3">
                                                        <div class="progress-fill initialized" data-percentage="{{ $percentage_adata['persen'] }}" style="width: {{ $percentage_adata['persen'] }}%;"></div>
                                                    </div>
                                                    <span class="percentage-badge">{{ $percentage_adata['persen'] }}%</span>
                                                </div>
                                                @if($data['status_periode'] == 'active')
                                                <a href="{{ url('masteradata/input') }}?period={{ $data['id'] }}&type=adata" class="btn btn-primary w-100">
                                                    Input ADATA
                                                </a>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Action Buttons -->
                                        <div class="d-flex gap-2 justify-content-end mt-3">
                                            <?php if($can_view){ ?>
                                            <a class="btn btn-sm btn-primary has-tooltip" href="<?php print_link("periodeevaluasi/view/$rec_id"); ?>" >
                                                <i class="icon dripicons-preview"></i> View
                                            </a>
                                            <?php } ?>
                                            <?php if($can_edit){ ?>
                                            <a class="btn btn-sm btn-success has-tooltip" href="<?php print_link("periodeevaluasi/edit/$rec_id"); ?>" >
                                                <i class="icon dripicons-document-edit"></i> Edit
                                            </a>
                                            <?php } ?>
                                            <?php if($can_delete){ ?>
                                            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal" href="<?php print_link("periodeevaluasi/delete/$rec_id"); ?>" >
                                                <i class="icon dripicons-cross"></i> Delete
                                            </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <!--PageComponentEnd-->
                                <?php 
                                    }
                                ?>
                                <!--endrecord-->
                            </div>
                            <div class="row justify-content-start g-0 search-data"></div>
                            <div>
                            </div>
                        </div>
                        <?php
                            if($show_footer){
                        ?>
                        <div class=" mt-3">
                            <div class="row justify-content-between">   
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
<!-- Page custom js --><script>// Progress Bar Handler - Global jQuery function to avoid redundancy
window.initProgressBars = window.initProgressBars || function() {
    $('.progress-fill:not(.initialized)').each(function() {
        const $fill = $(this);
        const percentage = parseFloat($fill.data('percentage'));
        
        // Mark as initialized
        $fill.addClass('initialized');
        
        // Animate after a short delay with jQuery
        setTimeout(function() {
            $fill.animate({
                width: Math.min(percentage, 100) + '%'
            }, 500, 'swing');
        }, 300);
        
        // Add pulse effect for 100% completion
        if (percentage >= 100) {
            $fill.css('animation', 'pulse 2s infinite alternate');
        }
    });
};

// Initialize on document ready
$(document).ready(function() {
    window.initProgressBars();
});</script>

@endsection
