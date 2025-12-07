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
    $pageTitle = "Indikator Master"; //set dynamic page title
?>
@php
    use Illuminate\Support\Str;
    $periodeSlug = isset($periodeLabel) ? Str::slug($periodeLabel, '_') : 'periode';
    $tableId = 'laporan_sakip_' . $periodeSlug;
    $periodeFileLabel = $periodeLabel ?? 'Periode';
@endphp
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
                        <div class="h5 font-weight-bold text-primary">Indikator Master</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <form action="{{ url()->current() }}" method="get" class="w-100">
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        @if(request('user_id'))
                            <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                        @endif
                        <label class="form-label fw-semibold">Pilih Periode</label>
                        <select name="period" class="form-select" onchange="this.form.submit()">
                            @foreach($periodes as $periode)
                                <option value="{{ $periode->id }}" {{ $periodeId == $periode->id ? 'selected' : '' }}>
                                    {{ $periode->nama_periode ?? 'Periode ' . $periode->tahun }}
                                    @if($periode->status_periode === 'active')
                                        (Aktif)
                                    @endif
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="col-md-3  " >
                    <!-- Page drop down search component -->
                    <form  class="search" action="{{ url()->current() }}" method="get">
                        @if(request('period'))
                            <input type="hidden" name="period" value="{{ request('period') }}">
                        @else
                            <input type="hidden" name="period" value="{{ $periodeId }}">
                        @endif
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

{{-- Summary Card --}}
<div class="sakip">
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-{{ $summary['progress_color'] }}">
            <div class="card-body">
                <h5 class="card-title">Progress Keseluruhan SAKIP</h5>
                <h2 class="mb-3">{{ $summary['total_terisi'] }} / {{ $summary['total_indikator'] }}</h2>
                <div class="progress" style="height: 25px;">
                    <div class="progress-bar bg-{{ $summary['progress_color'] }}" 
                         role="progressbar" 
                         style="width: {{ $summary['progress_keseluruhan'] }}%"
                         aria-valuenow="{{ $summary['progress_keseluruhan'] }}" 
                         aria-valuemin="0" 
                         aria-valuemax="100">
                        {{ $summary['progress_keseluruhan'] }}%
                    </div>
                </div>
                <small class="text-muted mt-2 d-block">
                    {{ $summary['total_belum_terisi'] }} indikator belum terisi
                </small>
            </div>
        </div>
    </div>
</div>

{{-- Cards per Bidang --}}
<div class="row">
    @foreach($cards as $card)
    <div class="col-md-6 col-xl mb-4">
        <div class="card border-{{ $card['color'] }} h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">{{ $card['bidang_name'] }}</h5>
                    <i class="fas {{ $card['icon'] }} fa-2x text-{{ $card['color'] }}"></i>
                </div>
                
                <h3 class="mb-0">{{ $card['terisi'] }} / {{ $card['total_indikator'] }}</h3>
                <small class="text-muted">Indikator Terisi</small>
                
                <div class="progress mt-3" style="height: 20px;">
                    <div class="progress-bar bg-{{ $card['progress_color'] }}" 
                         role="progressbar" 
                         style="width: {{ $card['progress'] }}%"
                         aria-valuenow="{{ $card['progress'] }}" 
                         aria-valuemin="0" 
                         aria-valuemax="100">
                        {{ $card['progress'] }}%
                    </div>
                </div>
                
                <div class="mt-3">
                    <small class="text-danger">
                        <i class="fas fa-times-circle"></i> 
                        {{ $card['belum_terisi'] }} belum terisi
                    </small>
                </div>
            </div>
        
        </div>
    </div>
    @endforeach
</div>

</div>


    <div  class="" >
        <div class="container-fluid">
            <div class="row ">
                <div class="col comp-grid " >
                    <div  class=" page-content" >
                        <div id="indikatormaster-laporan-records">
                            <div id="page-main-content" class="table-responsive">
                                <?php Html::page_bread_crumb("/indikatormaster/laporan", $field_name, $field_value); ?>
                                <?php Html::display_page_errors($errors); ?>
                                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-2">
                                    <div class="filter-tags mb-0">
                                        <?php Html::filter_tag('search', __('Search')); ?>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="exportTable('{{ $tableId }}', 'csv', '{{ addslashes($periodeFileLabel) }}')">
                                            <i class="dripicons-download"></i> CSV
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary btn-sm" onclick="exportTable('{{ $tableId }}', 'excel', '{{ addslashes($periodeFileLabel) }}')">
                                            <i class="dripicons-download"></i> Excel
                                        </button>
                                    </div>
                                </div>
                                <table id="sakip_{{ $tableId }}" class="table table-hover table-striped table-sm text-left">
                                    <thead class="table-header ">
                                        <tr>
                                            <th class="td-urutan" > No</th>
                                            <th class="td-role_name" > Bidang</th>
                                            <th class="td-sasaran_program" > Sasaran Program</th>
                                            <th class="td-indikator_kinerja" > Indikator Kinerja</th>
                                            <th class="td-satuan" > Satuan</th>
                                            <th class="td-target" > Target</th>
                                            <th class="td-nilai" > Nilai</th>
                                            <th class="td-bukti_dukung" > Bukti Dukung</th>
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
                                            <!--PageComponentStart-->
                                            <td class="td-urutan">
                                                <?php echo  $data['urutan'] ; ?>
                                            </td>
                                            <td class="td-roles_role_name">
                                                <?php echo  $data['roles_role_name'] ; ?>
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
                                            <td class="td-target">
                                                <?php echo $hasEvaluasi ? $data['evaluasi_target'] : '-'; ?>
                                            </td>
                        <td class="td-nilai">
                                                <?php echo $hasEvaluasi ? $data['evaluasi_nilai'] : '-'; ?>
                                            </td>
                                            <td class="td-bukti_dukung text-center">
                                                <?php if($hasEvaluasi){ ?>
                                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                                        <span class="badge bg-success rounded-circle p-2">
                                                            <i class="dripicons-checkmark"></i>
                                                        </span>
                                                        <a href="{{ url('evaluasiindikator/edit/' . $data['evaluasi_id']) }}"
                                                           class="btn btn-success btn-sm page-drawer"
                                                           data-bs-toggle="tooltip"
                                                           title="Edit Data">
                                                            <i class="dripicons-document-edit"></i>
                                                        </a>
                                                    </div>
                                                <?php } else { ?>
                                                    -
                                                <?php } ?>
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
                                    <div class="col-md-auto d-flex">    
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

<!-- Hardcode script + CDN so exportTable is always available -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js" integrity="sha512-bG8VQxGLdHoj4nYVtyoQwkpquB9xXQHXrNmPR9UCeFVLtZL1YI7DiIo9N6byjHgNsx3Rpko1Ian2nKMbEHI0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
function exportTable(tableId, format = 'csv', label = 'laporan') {
    const table = document.getElementById("sakip_"+tableId);
    if (!table) {
        return;
    }

    const rows = Array.from(table.querySelectorAll('tr'));
    const csvContent = rows.map(row => {
        const cells = Array.from(row.querySelectorAll('th, td'));
        return cells.map(cell => {
            const text = cell.innerText.replace(/\s+/g, ' ').trim();
            return `"${text.replace(/"/g, '""')}"`;
        }).join(',');
    }).join('\n');

    const mimeType = format === 'excel' ? 'application/vnd.ms-excel' : 'text/csv';
    const extension = format === 'excel' ? 'xls' : 'csv';
    const safeLabel = label
        ? label.toString().trim().replace(/[^a-z0-9]+/gi, '_').replace(/^_+|_+$/g, '').toLowerCase()
        : tableId;
    const fileName = "sakip_"+`${safeLabel || tableId}.${extension}`;
    const blob = new Blob([csvContent], { type: mimeType });

    if (window.saveAs) {
        saveAs(blob, fileName);
    } else {
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = fileName;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
    }
}
</script>
