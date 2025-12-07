<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("masteradata/add");
    $can_edit = $user->canAccess("masteradata/edit");
    $can_view = $user->canAccess("masteradata/view");
    $can_delete = $user->canAccess("masteradata/delete");
    $field_name = request()->segment(3);
    $field_value = request()->segment(4);
    $total_records = $records->total();
    $limit = $records->perPage();
    $record_count = count($records);
    $pageTitle = "Master Adata"; //set dynamic page title
    $id_period = isset($periodeId) ? $periodeId : (request()->get('period') ?? getActivePeriod());
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')

<!-- 3. CSS opsional untuk styling yang lebih baik: -->
<style>
.evaluasi-display {
    text-align: center;
}

.evaluasi-nilai-display {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.evaluasi-actions {
    display: flex;
    gap: 5px;
    justify-content: center;
}

.evaluasi-actions .btn {
    padding: 2px 6px;
    font-size: 12px;
}
</style>


<section class="page" data-page-type="list" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container-fluid">
            <div class="row justify-content-between align-items-center gap-3">
                <div class="col  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">Input Master Adata</div>
                    </div>
                </div>
                <div class="col-auto  " >
                    <?php if($can_add){ ?>
                    <a  class="btn btn-primary btn-block" href="<?php print_link("masteradata/add", true) ?>" >
                    <i class="icon dripicons-plus"></i>                             
                    Add New Master Adata 
                </a>
                <?php } ?>
            </div>
            <div class="col-md-3  " >
            </div>
        </div>
    </div>
</div>
<?php
    }
?>


  @php
     $percentage_adata = getSummaryAdata(auth()->user()->id, $id_period, auth()->user()->user_role_id);
     @endphp
<div class="row mb-4">
    <!-- Persentase Input -->
    <div class="col-md-4">
        <div class="card text-white bg-primary shadow-sm">
            <div class="card-body">
                <h6 class="card-title">Persentase Input</h6>
                <h3 class="mb-0">{{ $percentage_adata['persen'] }}%</h3>
                <small class="text-light">{{ $percentage_adata['sudah'] }} dari {{ $percentage_adata['total'] }} indikator</small>
            </div>
        </div>
    </div>

    <!-- Belum Terinput -->
    <div class="col-md-4">
        <div class="card text-white bg-danger shadow-sm">
            <div class="card-body">
                <h6 class="card-title">Belum Terinput</h6>
                <h3 class="mb-0">{{ $percentage_adata['belum'] }}</h3>
                <small class="text-light">indikator</small>
            </div>
        </div>
    </div>

    <!-- Sudah Terinput -->
    <div class="col-md-4">
        <div class="card text-white bg-success shadow-sm">
            <div class="card-body">
                <h6 class="card-title">Sudah Terinput</h6>
                <h3 class="mb-0">{{ $percentage_adata['sudah'] }}</h3>
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
                    <div id="masteradata-input-records">
                        <div id="page-main-content" class="table-responsive">
                            <?php Html::page_bread_crumb("/masteradata/input", $field_name, $field_value); ?>
                            <?php Html::display_page_errors($errors); ?>
                            <div class="filter-tags mb-2">
                                <?php Html::filter_tag('search', __('Search')); ?>
                            </div>
                            <table class="table table-hover table-striped table-sm text-left">
                                <thead class="table-header ">
                                    <tr>
                                        <th class="td-elemen" > Elemen</th>
                                        <th class="td-satuan" > Satuan</th>
                                        <th class="td-bidang" > Status</th>
                                        <th class="td-created_at" style="width: 150px;"> value</th>
                                        <th class="td-updated_at" > Aksi</th>
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
                                   <!-- PERBAIKAN: Struktur Table Row yang Benar -->
<tr>
    <!--PageComponentStart-->
    
    <!-- Kolom 1: Elemen -->
    <td class="td-elemen"> 
        <?php 
            echo ($data['is_input'] == 0) ? '<strong>' . preserveIndentation($data['elemen']) . '</strong>' 
            : preserveIndentation($data['elemen']); 
        ?>
    </td>
    
    <!-- Kolom 2: Satuan -->
    <td class="td-satuan">
        <?php echo $data['satuan']; ?>
    </td>
    
    <!-- Kolom 3: Status - HARUS TETAP MENAMPILKAN BADGE -->
    <td class="td-bidang">
    <?php if($data['is_input'] == 1): ?>
    <?php if ($hasEvaluasi): ?>
        <span class="badge bg-success">Sudah</span>
    <?php else: ?>
        <span class="badge bg-danger">Belum</span>
    <?php endif; ?>
<?php else: ?>
    <!-- Kosong jika is_input != 1 -->
<?php endif; ?>
    </td>
    
<td class="td-created_at">
    <?php if($data['is_input'] == 1): ?>
        <?php if($hasEvaluasi): ?>
            <!-- Simpan evaluasi ID untuk edit/delete -->
            <span class="evaluasi-nilai-display"><?php echo $data['evaluasi_nilai']; ?></span>
        <?php else: ?>
            <!-- Form input jika belum ada evaluasi -->
            <form class="inline-evaluasi-form" onsubmit="return false;" 
                  data-master_adata_id="<?php echo $data['id']; ?>"
                  data-periode_id="<?php echo $id_period; ?>"
                  data-input_by="<?php echo auth()->id(); ?>">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control form-control-sm inline-evaluasi-nilai" 
                           name="nilai" placeholder="Input nilai" required>
                    <button type="submit" class="btn btn-success btn-sm inline-evaluasi-save" title="Simpan">
                        <i class="dripicons-checkmark"></i>
                    </button>
                </div>
                <div class="inline-evaluasi-error text-danger small mt-1" style="display:none;"></div>
            </form>
        <?php endif; ?>
    <?php else: ?>
        <!-- Kosong jika is_input != 1 -->
    <?php endif; ?>
</td>

<td class="td-updated_at">
    <?php if($hasEvaluasi): ?>
        <!-- PENTING: Simpan evaluasi ID untuk routes -->
        <div class="evaluasi-actions" 
             data-evaluasi_id="<?php echo $data['evaluasi_id']; ?>"
             data-master_adata_id="<?php echo $data['id']; ?>" 
             data-periode_id="<?php echo $id_period; ?>" 
             data-input_by="<?php echo auth()->id(); ?>">
            <button type="button" class="btn btn-sm btn-warning evaluasi-edit-btn" title="Edit">
                <i class="dripicons-pencil"></i>
            </button>
            <button type="button" class="btn btn-sm btn-danger evaluasi-delete-btn" title="Delete">
                <i class="dripicons-trash"></i>
            </button>
        </div>
    <?php else: ?>
        <span class="text-muted">-</span>
    <?php endif; ?>
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

<script>
// COMPLETE JavaScript dengan semua helper functions
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.inline-evaluasi-form');
    
    // Setup event untuk form submit
    forms.forEach(function(form, index) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const input = this.querySelector('.inline-evaluasi-nilai');
            const nilai = input.value.trim();
            
            if (!nilai) {
                const errorDiv = this.querySelector('.inline-evaluasi-error');
                errorDiv.textContent = 'Nilai harus diisi';
                errorDiv.style.display = 'block';
                return;
            }
            
            submitData(this, nilai, 'create');
        });
    });
    
    // Setup event untuk tombol edit dan delete
    document.addEventListener('click', function(e) {
        if (e.target.closest('.evaluasi-edit-btn')) {
            handleEdit(e.target.closest('.evaluasi-edit-btn'));
        }
        if (e.target.closest('.evaluasi-delete-btn')) {
            handleDelete(e.target.closest('.evaluasi-delete-btn'));
        }
    });
});

// Main submit function
function submitData(form, nilai, mode, evaluasiId = null) {
    const input = form.querySelector('.inline-evaluasi-nilai');
    const button = form.querySelector('.inline-evaluasi-save');
    const errorDiv = form.querySelector('.inline-evaluasi-error');
    
    const masterAdataId = form.getAttribute('data-master_adata_id');
    const periodeId = form.getAttribute('data-periode_id');
    const inputBy = form.getAttribute('data-input_by');
    
    // Hide error dan disable form
    errorDiv.style.display = 'none';
    input.disabled = true;
    button.disabled = true;
    button.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Saving...';
    
    // Get CSRF token
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta ? csrfMeta.getAttribute('content') : '';
    
    if (!csrfToken) {
        showError(errorDiv, 'CSRF token tidak ditemukan.');
        enableForm(input, button);
        return;
    }
    
    // Determine URL based on mode
    let url;
    if (mode === 'create') {
        url = '{{ url("evaluasiadata/add") }}';
    } else if (mode === 'update') {
        url = '{{ url("evaluasiadata/edit") }}/' + evaluasiId;
    }
    
    // Use URLSearchParams instead of FormData for better compatibility
    const params = new URLSearchParams();
    params.append('nilai', nilai);
    params.append('master_adata_id', masterAdataId);
    params.append('periode_id', periodeId);
    params.append('input_by', inputBy);
    params.append('_token', csrfToken);
    params.append('ajax_request', '1'); // Force AJAX detection
    
    if (mode === 'update') {
        params.append('_method', 'PUT');
    }
    
    console.log('Sending request to:', url);
    console.log('Params:', params.toString());
    
    fetch(url, {
        method: 'POST',
        body: params,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        console.log('Content-Type:', response.headers.get('content-type'));
        
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('text/html')) {
            throw new Error('Controller belum detect AJAX. Response masih HTML.');
        }
        
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        
        return response.json();
    })
    .then(data => {
        console.log('AJAX Success:', data);
        
        if (data.success || data.status === true) {
            updateUIAfterSubmit(form, nilai, data.id || evaluasiId, masterAdataId, periodeId, inputBy);
        } else {
            showError(errorDiv, data.message || 'Gagal menyimpan data');
            enableForm(input, button);
        }
    })
    .catch(error => {
        console.error('AJAX Error:', error);
        handleSubmitError(error, errorDiv, input, button);
    });
}

// Handle edit button
function handleEdit(editBtn) {
    const actionsDiv = editBtn.closest('.evaluasi-actions');
    const row = actionsDiv.closest('tr');
    
    const evaluasiId = actionsDiv.getAttribute('data-evaluasi_id');
    const masterAdataId = actionsDiv.getAttribute('data-master_adata_id');
    const periodeId = actionsDiv.getAttribute('data-periode_id');
    const inputBy = actionsDiv.getAttribute('data-input_by');
    
    const valueCell = row.querySelector('.td-created_at');
    const currentValue = valueCell.querySelector('.evaluasi-nilai-display').textContent.trim();
    
    console.log('=== EDIT TRIGGERED ===');
    console.log('Edit data:', {
        evaluasi_id: evaluasiId,
        currentValue: currentValue,
        master_adata_id: masterAdataId,
        periode_id: periodeId,
        input_by: inputBy
    });
    
    // Create edit form
    valueCell.innerHTML = `
        <form class="inline-evaluasi-form" onsubmit="return false;" 
              data-master_adata_id="${masterAdataId}"
              data-periode_id="${periodeId}"
              data-input_by="${inputBy}"
              data-evaluasi_id="${evaluasiId}">
            <div class="input-group input-group-sm">
                <input type="text" class="form-control form-control-sm inline-evaluasi-nilai" 
                       name="nilai" value="${currentValue}" required>
                <button type="submit" class="btn btn-success btn-sm inline-evaluasi-save" title="Update">
                    <i class="dripicons-checkmark"></i>
                </button>
                <button type="button" class="btn btn-secondary btn-sm evaluasi-cancel-btn" title="Cancel">
                    <i class="dripicons-cross"></i>
                </button>
            </div>
            <div class="inline-evaluasi-error text-danger small mt-1" style="display:none;"></div>
        </form>
    `;
    
    // Setup events
    const editForm = valueCell.querySelector('.inline-evaluasi-form');
    const cancelBtn = editForm.querySelector('.evaluasi-cancel-btn');
    
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const input = this.querySelector('.inline-evaluasi-nilai');
        const nilai = input.value.trim();
        
        if (!nilai) {
            const errorDiv = this.querySelector('.inline-evaluasi-error');
            errorDiv.textContent = 'Nilai harus diisi';
            errorDiv.style.display = 'block';
            return;
        }
        
        submitData(this, nilai, 'update', evaluasiId);
    });
    
    cancelBtn.addEventListener('click', function() {
        valueCell.innerHTML = '<span class="evaluasi-nilai-display">' + currentValue + '</span>';
    });
}

// Handle delete button  
function handleDelete(deleteBtn) {
    if (!confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        return;
    }
    
    const actionsDiv = deleteBtn.closest('.evaluasi-actions');
    const row = actionsDiv.closest('tr');
    
    const evaluasiId = actionsDiv.getAttribute('data-evaluasi_id');
    const masterAdataId = actionsDiv.getAttribute('data-master_adata_id');
    const periodeId = actionsDiv.getAttribute('data-periode_id');
    const inputBy = actionsDiv.getAttribute('data-input_by');
    
    deleteBtn.disabled = true;
    deleteBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
    
    const deleteUrl = '{{ url("evaluasiadata/delete") }}/' + evaluasiId;
    
    fetch(deleteUrl, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('text/html')) {
            return { success: true, status: true };
        }
        
        if (!response.ok) {
            throw new Error(`HTTP ${response.status}: ${response.statusText}`);
        }
        
        return response.json().catch(() => ({ success: true, status: true }));
    })
    .then(data => {
        updateUIAfterDelete(row, masterAdataId, periodeId, inputBy);
    })
    .catch(error => {
        console.error('Delete error:', error);
        alert('Error deleting: ' + error.message);
        deleteBtn.disabled = false;
        deleteBtn.innerHTML = '<i class="dripicons-trash"></i>';
    });
}

// Update UI after successful submit
function updateUIAfterSubmit(form, nilai, recordId, masterAdataId, periodeId, inputBy) {
    const row = form.closest('tr');
    
    // Update Status column
    const statusCell = row.querySelector('.td-bidang');
    if (statusCell) {
        statusCell.innerHTML = '<span class="badge bg-success">Sudah</span>';
    }
    
    // Update Value column
    const valueCell = row.querySelector('.td-created_at');
    if (valueCell) {
        valueCell.innerHTML = '<span class="evaluasi-nilai-display">' + nilai + '</span>';
    }
    
    // Update Action column
    const actionCell = row.querySelector('.td-updated_at');
    if (actionCell) {
        actionCell.innerHTML = `
            <div class="evaluasi-actions" 
                 data-evaluasi_id="${recordId}"
                 data-master_adata_id="${masterAdataId}" 
                 data-periode_id="${periodeId}" 
                 data-input_by="${inputBy}">
                <button type="button" class="btn btn-sm btn-warning evaluasi-edit-btn" title="Edit">
                    <i class="dripicons-pencil"></i>
                </button>
                <button type="button" class="btn btn-sm btn-danger evaluasi-delete-btn" title="Delete">
                    <i class="dripicons-trash"></i>
                </button>
            </div>
        `;
    }
}

// Update UI after delete
function updateUIAfterDelete(row, masterAdataId, periodeId, inputBy) {
    // Update Status column
    const statusCell = row.querySelector('.td-bidang');
    if (statusCell) {
        statusCell.innerHTML = '<span class="badge bg-danger">Belum</span>';
    }
    
    // Update Value column
    const valueCell = row.querySelector('.td-created_at');
    if (valueCell) {
        valueCell.innerHTML = `
            <form class="inline-evaluasi-form" onsubmit="return false;" 
                  data-master_adata_id="${masterAdataId}"
                  data-periode_id="${periodeId}"
                  data-input_by="${inputBy}">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control form-control-sm inline-evaluasi-nilai" 
                           name="nilai" placeholder="Input nilai" required>
                    <button type="submit" class="btn btn-success btn-sm inline-evaluasi-save" title="Simpan">
                        <i class="dripicons-checkmark"></i>
                    </button>
                </div>
                <div class="inline-evaluasi-error text-danger small mt-1" style="display:none;"></div>
            </form>
        `;
        
        const newForm = valueCell.querySelector('.inline-evaluasi-form');
        newForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const input = this.querySelector('.inline-evaluasi-nilai');
            const nilai = input.value.trim();
            
            if (!nilai) {
                const errorDiv = this.querySelector('.inline-evaluasi-error');
                errorDiv.textContent = 'Nilai harus diisi';
                errorDiv.style.display = 'block';
                return;
            }
            
            submitData(this, nilai, 'create');
        });
    }
    
    // Update Action column
    const actionCell = row.querySelector('.td-updated_at');
    if (actionCell) {
        actionCell.innerHTML = '<span class="text-muted">-</span>';
    }
}

// Helper functions
function showError(errorDiv, message) {
    errorDiv.textContent = message;
    errorDiv.style.display = 'block';
}

function enableForm(input, button) {
    input.disabled = false;
    button.disabled = false;
    button.innerHTML = '<i class="dripicons-checkmark"></i>';
}

function handleSubmitError(error, errorDiv, input, button) {
    let errorMessage = 'Terjadi kesalahan: ';
    
    if (error.message.includes('Controller belum detect AJAX')) {
        errorMessage += 'Controller belum update dengan AJAX detection.';
    } else if (error.message.includes('HTTP 422')) {
        errorMessage += 'Data tidak valid';
    } else if (error.message.includes('HTTP 419')) {
        errorMessage += 'Session expired, refresh halaman';
    } else if (error.message.includes('HTTP 404')) {
        errorMessage += 'Endpoint tidak ditemukan';
    } else if (error.message.includes('HTTP 500')) {
        errorMessage += 'Server error';
    } else {
        errorMessage += error.message;
    }
    
    showError(errorDiv, errorMessage);
    enableForm(input, button);
}
</script>
@endsection
