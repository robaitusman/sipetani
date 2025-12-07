<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("kel_tani/add");
    $can_edit = $user->canAccess("kel_tani/edit");
    $can_view = $user->canAccess("kel_tani/view");
    $can_delete = $user->canAccess("kel_tani/delete");
    $pageTitle = "Kel Tani Details"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Kel Tani Details</div>
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
                            $counter = 0;
                            if($data){
                            $rec_id = ($data['id_kel'] ? urlencode($data['id_kel']) : null);
                            $counter++;
                        ?>
                        <div id="page-main-content" class=" px-3 mb-3">
                            <div class="page-data row">
                                <!--PageComponentStart-->
                                <div class="col-md-5 comp-grid " >
                                    <!--PageComponentStart-->
                                    <div class="mb-3 row row gutter-lg">
                                        <div class="mb-3 card-1 p-2 border rounded">
                                            <table class="table table-hover table-striped table-sm text-left">
                                                @foreach ($data->toArray() as $column => $value)
                                                @if(  $column=='status' ) 
                                                @elseif(  $column=='long' ) 
                                                @elseif(  $column=='lokasi' ) 
                                                @elseif(  $column=='photo' ) 
                                                @elseif(  $column=='lat' ) 
                                                @else
                                                <tr>
                                                    <td style="width: 30%;"><b>{{ $column }}</b></td><td style="width: 5%;">:</td><td>  {{ $value }}</td>
                                                </tr>
                                                @endif
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 comp-grid " >
                                    <div class="mb-3 card-1 p-2 border rounded">
                                        <div id="map" style="height: 400px"></div>
                                    </div>
                                </div>
                            </div>
                            <!--PageComponentEnd-->
                            <div class="d-flex gap-1 justify-content-start">
                                <?php if($can_edit){ ?>
                                <a class="btn btn-sm btn-success has-tooltip "   title="Edit" href="<?php print_link("kel_tani/edit/$rec_id"); ?>" >
                                <i class="icon dripicons-document-edit"></i> Edit
                            </a>
                            <?php } ?>
                            <?php if($can_delete){ ?>
                            <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal" title="Delete" href="<?php print_link("kel_tani/delete/$rec_id?redirect=kel_tani"); ?>" >
                            <i class="icon dripicons-cross"></i> Delete
                        </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!-- Detail Page Column -->
            <?php if(!request()->has('subpage')){ ?>
            <div class="col-12">
                <div class="my-3 p-1 ">
                    @include("pages.kel_tani.detail-pages", ["masterRecordId" => $rec_id])
                </div>
            </div>
            <?php } ?>
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

$(document).ready(function(){
	// custom javascript | jquery codes
});
</script>

@endsection
