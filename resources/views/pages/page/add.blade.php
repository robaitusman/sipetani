<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Page"; //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="add" data-page-url="{{ url()->full() }}">
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
                        <div class="h5 font-weight-bold text-primary">Add New Page</div>
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
                <div class="col-md-9 comp-grid " >
                    <div  class="card card-1 border rounded page-content" >
                        <!--[form-start]-->
                        <form id="page-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('page.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="title">Title <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-title-holder" class=" ">
                                                <input id="ctrl-title" data-field="title"  value="<?php echo get_value('title') ?>" type="text" placeholder="Enter Title"  required="" name="title"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="type">Type <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-type-holder" class=" ">
                                                <input id="ctrl-type" data-field="type"  value="<?php echo get_value('type') ?>" type="text" placeholder="Enter Type"  required="" name="type"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="content">Content <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-content-holder" class=" ">
                                                <textarea placeholder="Enter Content" id="ctrl-content" data-field="content"  required="" rows="5" name="content" class=" form-control"><?php echo get_value('content') ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="fresh_content">Fresh Content <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-fresh_content-holder" class=" ">
                                                <textarea placeholder="Enter Fresh Content" id="ctrl-fresh_content" data-field="fresh_content"  required="" rows="5" name="fresh_content" class=" form-control"><?php echo get_value('fresh_content') ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="keyword">Keyword </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-keyword-holder" class=" ">
                                                <textarea placeholder="Enter Keyword" id="ctrl-keyword" data-field="keyword"  rows="5" name="keyword" class=" form-control"><?php echo get_value('keyword') ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="description">Description </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-description-holder" class=" ">
                                                <textarea placeholder="Enter Description" id="ctrl-description" data-field="description"  rows="5" name="description" class=" form-control"><?php echo get_value('description') ?></textarea>
                                                <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="link">Link </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-link-holder" class=" ">
                                                <input id="ctrl-link" data-field="link"  value="<?php echo get_value('link') ?>" type="text" placeholder="Enter Link"  name="link"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="template">Template </label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-template-holder" class=" ">
                                                <input id="ctrl-template" data-field="template"  value="<?php echo get_value('template') ?>" type="text" placeholder="Enter Template"  name="template"  class="form-control " />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-ajax-status"></div>
                            <!--[form-button-start]-->
                            <div class="form-group form-submit-btn-holder text-center mt-3">
                                <button class="btn btn-primary" type="submit">
                                Submit
                                <i class="icon dripicons-direction"></i>
                                </button>
                            </div>
                            <!--[form-button-end]-->
                        </form>
                        <!--[form-end]-->
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
