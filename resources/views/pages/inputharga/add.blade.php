<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    $pageTitle = "Add New Input Harga"; //set dynamic page title
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
            <div class="row justify-content-between align-items-center">
                <div class="col-auto  back-btn-col" >
                    <a class="back-btn btn " href="{{ url()->previous() }}" >
                        <i class="icon dripicons-arrow-thin-left"></i>                              
                    </a>
                </div>
                <div class="col  " >
                    <div class="">
                        <div class="h5 font-weight-bold text-primary">Add New Input Harga</div>
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
                        <?php Html::display_page_errors($errors); ?>
                        <!--[form-start]-->
                        <form id="inputharga-add-form" role="form" novalidate enctype="multipart/form-data" class="form page-form form-horizontal needs-validation" action="{{ route('inputharga.store') }}" method="post">
                            @csrf
                            <div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label" for="tanggal">Tanggal <span class="text-danger">*</span></label>
                                        </div>
                                        <div class="col-sm-8">
                                            <div id="ctrl-tanggal-holder" class="input-group ">
                                                <input id="ctrl-tanggal" data-field="tanggal" class="form-control datepicker  datepicker"  required="" value="<?php echo get_value('tanggal', \Carbon\Carbon::now()->format('Y-m-d')) ?>" type="datetime" name="tanggal" placeholder="Enter Tanggal" data-enable-time="false" data-min-date="" data-max-date="" data-date-format="Y-m-d" data-alt-format="F j, Y" data-inline="false" data-no-calendar="false" data-mode="single" />
                                                <span class="input-group-text"><i class="icon dripicons-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label class="control-label mb-2">Harga Komoditas</label>
                                            <?php $komoditasList = isset($komoditas) ? $komoditas : collect(); ?>
                                            @if($komoditasList->count())
                                            <div class="table-responsive border rounded">
                                                <table class="table table-sm align-middle mb-0">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th style="width:40%">Nama Komoditas</th>
                                                            <th style="width:20%">Kebutuhan</th>
                                                            <th style="width:20%">Ketersediaan</th>
                                                            <th style="width:20%">Harga</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($komoditasList as $item)
                                                        <tr>
                                                            <td>{{ $item->nama }}</td>
                                                            <td>
                                                                <input type="number" step="0.01" class="form-control" name="kebutuhan[{{ $item->id }}]" value="{{ old('kebutuhan.' . $item->id) }}" placeholder="Kebutuhan" />
                                                            </td>
                                                            <td>
                                                                <input type="number" step="0.01" class="form-control" name="ketersediaan[{{ $item->id }}]" value="{{ old('ketersediaan.' . $item->id) }}" placeholder="Ketersediaan" />
                                                            </td>
                                                            <td>
                                                                <input type="number" step="0.01" class="form-control" name="harga[{{ $item->id }}]" value="{{ old('harga.' . $item->id) }}" placeholder="Harga" />
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <small class="text-muted d-block mt-2">Isi kebutuhan dan ketersediaan jika mengisi harga. Kosongkan baris yang tidak ingin disimpan.</small>
                                            @else
                                            <div class="alert alert-warning mb-0">
                                                Belum ada data komoditas. Silakan tambahkan komoditas terlebih dahulu.
                                            </div>
                                            @endif
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


@endsection
