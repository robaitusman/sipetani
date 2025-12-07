<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
?>
@section('content')
<section class="page" data-page-type="edit" data-page-url="{{ url()->full() }}">
    <div  class="" >
        <div class="container">
            <div class="row ">
                <div class="col-md-9 comp-grid " >
                    <div  class="card card-1 border rounded page-content" >
                        <!--[form-start]-->
                        <form novalidate  id="" role="form" enctype="multipart/form-data"  class="form page-form form-horizontal needs-validation" action="<?php print_link("account/edit"); ?>" method="post">
                        <!--[form-content-start]-->
                        @csrf
                        <div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="oauth_uid">Oauth Uid </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-oauth_uid-holder" class=" ">
                                            <textarea placeholder="Enter Oauth Uid" id="ctrl-oauth_uid" data-field="oauth_uid"  rows="5" name="oauth_uid" class=" form-control"><?php  echo $data['oauth_uid']; ?></textarea>
                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="oauth_provider">Oauth Provider </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-oauth_provider-holder" class=" ">
                                            <input id="ctrl-oauth_provider" data-field="oauth_provider"  value="<?php  echo $data['oauth_provider']; ?>" type="text" placeholder="Enter Oauth Provider"  name="oauth_provider"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="username">Username <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-username-holder" class=" ">
                                            <input id="ctrl-username" data-field="username"  value="<?php  echo $data['username']; ?>" type="text" placeholder="Enter Username"  required="" name="username"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="full_name">Full Name <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-full_name-holder" class=" ">
                                            <input id="ctrl-full_name" data-field="full_name"  value="<?php  echo $data['full_name']; ?>" type="text" placeholder="Enter Full Name"  required="" name="full_name"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="avatar">Avatar <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-avatar-holder" class=" ">
                                            <textarea placeholder="Enter Avatar" id="ctrl-avatar" data-field="avatar"  required="" rows="5" name="avatar" class=" form-control"><?php  echo $data['avatar']; ?></textarea>
                                            <!--<div class="invalid-feedback animated bounceIn text-center">Please enter text</div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="banned">Banned </label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-banned-holder" class=" ">
                                            <input id="ctrl-banned" data-field="banned"  value="<?php  echo $data['banned']; ?>" type="number" placeholder="Enter Banned" step="any"  name="banned"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="control-label" for="no_hp">No Hp <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div id="ctrl-no_hp-holder" class=" ">
                                            <input id="ctrl-no_hp" data-field="no_hp"  value="<?php  echo $data['no_hp']; ?>" type="text" placeholder="Enter No Hp"  required="" name="no_hp"  class="form-control " />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-ajax-status"></div>
                        <!--[form-content-end]-->
                        <!--[form-button-start]-->
                        <div class="form-group text-center">
                            <button class="btn btn-primary" type="submit">
                            Update
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
