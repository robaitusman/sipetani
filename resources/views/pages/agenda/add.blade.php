<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Agenda"; //set dynamic page title
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
                        <div class="h5 font-weight-bold text-primary">Add New Agenda</div>
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
                        <form id="agenda-add-form"  novalidate role="form" enctype="multipart/form-data" class="form multi-form page-form" action="{{ route('agenda.store') }}" method="post" >
                            @csrf
                            <div>
                                <table class="table table-striped table-sm" data-maxrow="10" data-minrow="1">
                                    <thead>
                                        <tr>
                                            <th class="bg-light"><label for="tanggal">Tanggal</label></th>
                                            <th class="bg-light"><label for="gbr_utama">Gbr Utama</label></th>
                                            <th class="bg-light"><label for="keterangan">Keterangan</label></th>
                                            <th class="bg-light"><label for="status">Status</label></th>
                                            <th class="bg-light"><label for="visibility">Visibility</label></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="100" class="text-right">
                                        <?php $template_id = "table-row-" . random_str(); ?>
                                        <button type="button" data-template="#<?php echo $template_id ?>" class="btn btn-sm btn-success btn-add-table-row"><i class="icon dripicons-plus"></i></button>
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
                                <!--[table row template]-->
                                <template id="<?php echo $template_id ?>">
                                <?php $row = "CURRENTROW"; // will be replaced with current row index. ?>
                                <tr data-row="<?php echo $row ?>" class="input-row">
                                <td>
                                    <div id="ctrl-tanggal-row<?php echo $row; ?>-holder" class="input-group ">
                                    <input id="ctrl-tanggal-row<?php echo $row; ?>" data-field="tanggal" class="form-control datepicker  datepicker" required="" value="<?php echo get_value('tanggal') ?>" type="datetime"  name="row[<?php echo $row ?>][tanggal]" placeholder="Enter Tanggal" data-enable-time="true" data-min-date="" data-max-date="" data-date-format="Y-m-d H:i:S" data-alt-format="F j, Y - H:i" data-inline="false" data-no-calendar="false" data-mode="single" /> 
                                    <span class="input-group-text"><i class="icon dripicons-calendar"></i></span>
                                </div>
                            </td>
                            <td>
                                <div id="ctrl-gbr_utama-row<?php echo $row; ?>-holder" class=" ">
                                <input id="ctrl-gbr_utama-row<?php echo $row; ?>" data-field="gbr_utama"  value="<?php echo get_value('gbr_utama') ?>" type="text" placeholder="Enter Gbr Utama"  required="" name="row[<?php echo $row ?>][gbr_utama]"  class="form-control " />
                            </div>
                        </td>
                        <td>
                            <div id="ctrl-keterangan-row<?php echo $row; ?>-holder" class=" ">
                            <input id="ctrl-keterangan-row<?php echo $row; ?>" data-field="keterangan"  value="<?php echo get_value('keterangan') ?>" type="text" placeholder="Enter Keterangan"  required="" name="row[<?php echo $row ?>][keterangan]"  class="form-control " />
                        </div>
                    </td>
                    <td>
                        <div id="ctrl-status-row<?php echo $row; ?>-holder" class=" checkbox-group-required">
                        <?php
                            $options = Menu::status();
                            if(!empty($options)){
                            foreach($options as $option){
                            $value = $option['value'];
                            $label = $option['label'];
                            //check if current option is checked option
                            $checked = Html::get_field_checked('status', $value, "");
                        ?>
                        <label class="form-check option-btn">
                        <input class="form-check-input" value="<?php echo $value ?>" <?php echo $checked ?> type="checkbox"   name="row[<?php echo $row ?>][status][]" />
                        <span class="form-check-label"><?php echo $label ?></span>
                        </label>
                        <?php
                            }
                            }
                        ?>
                    </div>
                </td>
                <td>
                    <div id="ctrl-visibility-row<?php echo $row; ?>-holder" class=" checkbox-group-required">
                    <?php
                        $options = Menu::status();
                        if(!empty($options)){
                        foreach($options as $option){
                        $value = $option['value'];
                        $label = $option['label'];
                        //check if current option is checked option
                        $checked = Html::get_field_checked('visibility', $value, "");
                    ?>
                    <label class="form-check option-btn">
                    <input class="form-check-input" value="<?php echo $value ?>" <?php echo $checked ?> type="checkbox"   name="row[<?php echo $row ?>][visibility][]" />
                    <span class="form-check-label"><?php echo $label ?></span>
                    </label>
                    <?php
                        }
                        }
                    ?>
                </div>
            </td>
            <th class="text-center">
            <button type="button" class="btn-close btn-remove-table-row"></button>
            </th>
        </tr>
    </template>
    <!--[/table row template]-->
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
