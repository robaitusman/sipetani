<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("jumlah_komoditas/add");
    $can_edit = $user->canAccess("jumlah_komoditas/edit");
    $can_view = $user->canAccess("jumlah_komoditas/view");
    $can_delete = $user->canAccess("jumlah_komoditas/delete");
    $pageTitle = "Jumlah Komoditas Details"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="view" data-page-url="{{ url()->full() }}">
    <?php
        if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3" >
        <div class="container">
            <div class="row align-items-center">
                <div class="col-auto  back-btn-col" >
                    <a class="back-btn btn " href="{{ url()->previous() }}" >
                        <i class="icon dripicons-arrow-thin-left"></i>                              
                    </a>
                </div>
                <div class="col col-md-auto  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">Jumlah Komoditas Details</div>
                    </div>
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
                        <?php
                            if($data){
                            $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                        ?>
                        <div id="page-main-content" class=" px-3 mb-3">
                            <div class="page-data">
                                <div class="d-flex align-items-center gap-2">
                                    <?php if($can_edit){ ?>
                                    <a class="btn btn-sm btn-success has-tooltip "   title="Edit" href="<?php print_link("jumlah_komoditas/edit/$rec_id"); ?>" >
                                    <i class="icon dripicons-document-edit"></i> Edit
                                </a>
                                <?php } ?>
                                <?php if($can_delete){ ?>
                                <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal" title="Delete" href="<?php print_link("jumlah_komoditas/delete/$rec_id?redirect=jumlah_komoditas"); ?>" >
                                <i class="icon dripicons-cross"></i> Delete
                            </a>
                            <?php } ?>
                        </div>
                        <!--PageComponentStart-->
                        <div class="mb-3 row row gutter-lg">
                            <div class=" col-12 col-md-4">
                                <div class="bg-light mb-3 card-1 p-2 border rounded">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <small class="text-muted">Id</small>
                                            <div class="fw-bold">
                                                <?php echo  $data['id'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-12 col-md-4">
                                <div class="bg-light mb-3 card-1 p-2 border rounded">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <small class="text-muted">Id Content</small>
                                            <div class="fw-bold">
                                                <?php echo  $data['id_content'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-12 col-md-4">
                                <div class="bg-light mb-3 card-1 p-2 border rounded">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <small class="text-muted">Jenis Content</small>
                                            <div class="fw-bold">
                                                <?php echo  $data['jenis_content'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-12 col-md-4">
                                <div class="bg-light mb-3 card-1 p-2 border rounded">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <small class="text-muted">Jenis Komoditas</small>
                                            <div class="fw-bold">
                                                <?php echo  $data['jenis_komoditas'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-12 col-md-4">
                                <div class="bg-light mb-3 card-1 p-2 border rounded">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <small class="text-muted">Jml</small>
                                            <div class="fw-bold">
                                                <?php echo  $data['jml'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=" col-12 col-md-4">
                                <div class="bg-light mb-3 card-1 p-2 border rounded">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <small class="text-muted">Satuan</small>
                                            <div class="fw-bold">
                                                <?php echo  $data['satuan'] ; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--PageComponentEnd-->
                    </div>
                </div>
                <?php
                    }
                    else{
                ?>
                <!-- Empty Record Message -->
                <div class="text-muted p-3">
                    <i class="icon dripicons-wrong"></i> No Record Found
                </div>
                <?php
                    }
                ?>
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
