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
    $pageTitle = "Photo Details"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Photo Details</div>
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
                            $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                            $counter++;
                        ?>
                        <div id="page-main-content" class=" px-3 mb-3">
                            <div class="page-data">
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
                                                    <small class="text-muted">Photo</small>
                                                    <div class="fw-bold">
                                                        <?php 
                                                            $x=0;                                                
                                                            $photo_img =explode(",",$data['photo']);
                                                            foreach($photo_img as $photo_images{                                       
                                                            $x+=1;
                                                            echo '<img src="'."images/".$photo_images.'" width="70" height="70" />';
                                                            }
                                                            @foreach ($photo_img as $photo)
                                                            echo '<img src="'.$photo.'" width="70" height="70" />';
                                                            @endforeach
                                                            Html :: page_img($data['photo'], 'auto', 'auto', "", 1); 
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--PageComponentEnd-->
                                <div class="d-flex gap-1 justify-content-start">
                                    <?php if($can_edit){ ?>
                                    <a class="btn btn-sm btn-success has-tooltip "   title="Edit" href="<?php print_link("photo/edit/$rec_id"); ?>" >
                                    <i class="icon dripicons-document-edit"></i> Edit
                                </a>
                                <?php } ?>
                                <?php if($can_delete){ ?>
                                <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="Are you sure you want to delete this record?" data-display-style="modal" title="Delete" href="<?php print_link("photo/delete/$rec_id?redirect=photo"); ?>" >
                                <i class="icon dripicons-cross"></i> Delete
                            </a>
                            <?php } ?>
                        </div>
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
