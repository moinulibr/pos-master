@extends('layouts.backend.app')
@section('page_title') Home Page @endsection
@push('css')
<link rel="stylesheet" href="{{asset('backend/links/assets')}}/css/shreerang-material.css">
<link rel="stylesheet" href="{{asset('backend/links/assets')}}/libs/bootstrap-select/bootstrap-select.css">
<link rel="stylesheet" href="{{asset('backend/links/assets')}}/libs/bootstrap-multiselect/bootstrap-multiselect.css">
<link rel="stylesheet" href="{{asset('backend/links/assets')}}/libs/select2/select2.css">
<link rel="stylesheet" href="{{asset('backend/links/assets')}}/libs/bootstrap-tagsinput/bootstrap-tagsinput.css">


<link rel="stylesheet" href="{{asset('backend/links/assets')}}/libs/bootstrap-datepicker/bootstrap-datepicker.css">
<link rel="stylesheet" href="{{asset('backend/links/assets')}}/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css">
<link rel="stylesheet" href="{{asset('backend/links/assets')}}/libs/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.css">
<link rel="stylesheet" href="{{asset('backend/links/assets')}}/libs/timepicker/timepicker.css">
<link rel="stylesheet" href="{{asset('backend/links/assets')}}/libs/minicolors/minicolors.css">
<style>

</style>
@endpush

<!-------------------------------------------Content------------------------------->
<!-------------------------------------------Content------------------------------->
@section('content')
<!-------------------------------------------Content------------------------------->
<!-------------------------------------------Content------------------------------->


    <!-------------------page title content------------------>
    <!-------------------page title content------------------>
    <!---page_title_of_content-->    
    @push('page_title_of_content')
        <div class="breadcrumbs layout-navbar-fixed">
            <h4 class="font-weight-bold py-3 mb-0">Products  </h4>
            <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#"><i class="feather icon-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">Products</li>
                    <li class="breadcrumb-item active">All Products</li>
                </ol>
            </div>
            <div class="products">
                <a href="#">Add Product</a>
            </div>
        </div>
    @endpush
    <!-------------------page title content------------------>
    <!-------------------page title content------------------>




    <!-------------------total content space for this page------------------>   
    <div  class="content_space_for_page">
    <!-------------------total content space for this page------------------> 
    <!---------------------------------------------------------------------->

        <!-------status message content space for this page------> 
        <div class="status_message_in_content_space">
            @include('layouts.backend.partial.success_error_status_message')
        </div>
        <!-------status message content space for this page------> 


        

        <!----************************---real space in content---************************---> 
        <div class="real_space_in_content">
            <!-------****************real space in content****************------> 
            <!------------------------------------------------------------------>
            
            
            <!-------responsive table------> 
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Table heading</th>
                            <th>Table heading</th>
                            <th>Table heading</th>
                            <th>Table heading</th>
                            <th>Table heading</th>
                            <th>Table heading</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>
                                <a href="{{route('admin.unit.index')}}">Unit</a>    
                            </td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>Table cell</td>
                            <td>
                                <div class="btn-group btnGroupForMoreAction">
                                    <button type="button" class="btn btn-sm" data-toggle="dropdown" aria-expanded="true">
                                         <i class="fas fa-ellipsis-v"></i>
                                        {{-- <i class="fas fa-cogs"></i> --}}
                                    </button>
                                    <div class="dropdown-menu " x-placement="top-start" style="position: absolute; will-change: top, left; top: -183px; left: 0px;">
                                    <a class="dropdown-item" href="javascript:void(0)">Action</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)">Separated link</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-------responsive table------> 
            
            <br/><br/>


            <div class="table-responsive col-12" style="margin-bottom: 3%; height: 260px; padding-top: 0;">
                <style>
                    .sticky-head {
                    position: sticky;
                    background: #e0e0e0;
                    top: 0;
                }
                </style>
                <table class="table">
                    <thead>
                        <tr>
                            <th class="sticky-head">#</th>
                            <th class="sticky-head">First Name</th>
                            <th class="sticky-head">Last Name</th>
                            <th class="sticky-head">Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th>2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th>3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th>3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th>3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th>3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <br><br><br/><br/><br/>



                <h4 class="font-weight-bold py-3 mb-0">Layouts and elements</h4>
                <!----------------------------->


                <!----------------------------->
                <div class="card mb-4">
                    <h6 class="card-header">Default</h6>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label class="form-label">Email address</label>
                                <input type="email" class="form-control" placeholder="Email" />
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" placeholder="Password" />
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label w-100">File input</label>
                                <input type="file" />
                                <small class="form-text text-muted">Example block-level help text here.</small>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" />
                                    <span class="custom-control-label">Check this custom checkbox</span>
                                </label>
                            </div>
                            <div class="form-group">
                                <label class="form-check">
                                    <input class="form-check-input" type="checkbox" checked />
                                    <span class="form-check-label">Check me out</span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>                
                <!----------------------------->

                <br/>

                <!----------------------------->
                <div class="card mb-4">
                    <h6 class="card-header">Form row</h6>
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" placeholder="Email" />
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" />
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" placeholder="1234 Main St" />
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Address 2</label>
                                <input type="text" class="form-control" placeholder="Apartment, studio, or floor" />
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" />
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label">State</label>
                                    <select class="custom-select">
                                        <option>Select state</option>
                                        <option>California</option>
                                        <option>Hawaii</option>
                                        <option>Florida</option>
                                        <option>Texas</option>
                                        <option>Massachusetts</option>
                                        <option>Alabama</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label class="form-label">Zip</label>
                                    <input type="text" class="form-control" />
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="custom-control custom-checkbox m-0">
                                    <input type="checkbox" class="custom-control-input" />
                                    <span class="custom-control-label">Check this custom checkbox</span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </form>
                    </div>
                </div>
                <!----------------------------->

                <br/>

                <!----------------------------->
                    <div class="card mb-4">
                        <h6 class="card-header">Horizontal</h6>
                        <div class="card-body">
                            <form>
                                <div class="form-group row">
                                    <label class="col-form-label col-sm-2 text-sm-right">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" placeholder="Email" />
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-sm-2 text-sm-right">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" placeholder="Password" />
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-sm-2 text-sm-right">Textarea</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" placeholder="Textarea"></textarea>
                                    </div>
                                </div>
                                <fieldset class="form-group">
                                    <div class="row">
                                        <label class="col-form-label col-sm-2 text-sm-right pt-sm-0">Radios</label>
                                        <div class="col-sm-10">
                                            <div class="custom-controls-stacked">
                                                <label class="custom-control custom-radio">
                                                    <input name="custom-radio-3" type="radio" class="custom-control-input" checked />
                                                    <span class="custom-control-label">Option one is this and that—be sure to include why it's great</span>
                                                </label>
                                                <label class="custom-control custom-radio">
                                                    <input name="custom-radio-3" type="radio" class="custom-control-input" />
                                                    <span class="custom-control-label">Option two can be something else and selecting it will deselect option one</span>
                                                </label>
                                                <label class="custom-control custom-radio">
                                                    <input name="custom-radio-3" type="radio" class="custom-control-input" disabled />
                                                    <span class="custom-control-label">Option three is disabled</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="form-group row">
                                    <label class="col-form-label col-sm-2 text-sm-right pt-sm-0">Checkbox</label>
                                    <div class="col-sm-10">
                                        <label class="custom-control custom-checkbox m-0">
                                            <input type="checkbox" class="custom-control-input" />
                                            <span class="custom-control-label">Check me out</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10 ml-sm-auto">
                                        <button type="submit" class="btn btn-primary">Sign in</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <!----------------------------->

                <br/>

                <!----------------------------->
                    <div class="card mb-4">
                        <h6 class="card-header">Inline</h6>
                        <div class="card-body">
                            <form class="form-inline mb-4">
                                <label class="sr-only">Name</label>
                                <input type="text" class="form-control mr-sm-2 mb-2 mb-sm-0" placeholder="Jane Doe" />
                                <label class="sr-only">Username</label>
                                <div class="input-group mr-sm-2 mb-2 mb-sm-0">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">@</div>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Username" />
                                    <div class="clearfix"></div>
                                </div>
                                <label class="form-check mr-sm-2 mb-2 mb-sm-0">
                                    <input class="form-check-input" type="checkbox" />
                                    <span class="form-check-label">Remember me</span>
                                </label>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                            <form class="form-inline">
                                <label class="form-label mr-sm-2">Preference</label>
                                <select class="custom-select mr-sm-2 mb-2 mb-sm-0">
                                    <option selected>Choose...</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <label class="custom-control custom-checkbox mr-sm-2 mb-2 mb-sm-0">
                                    <input type="checkbox" class="custom-control-input" />
                                    <span class="custom-control-label">Remember my preference</span>
                                </label>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                <!----------------------------->

                <br/>

                <!----------------------------->
                    <div class="card mb-4">
                        <h6 class="card-header">Help text</h6>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" />
                                    <small class="form-text text-muted">Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.</small>
                                </div>
                            </form>
                            <form class="form-inline mt-4">
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control mx-sm-3" />
                                    <small class="text-muted">Must be 8-20 characters long.</small>
                                </div>
                            </form>
                        </div>
                    </div>
                <!----------------------------->

                <br/>

                <!----------------------------->  
                <div class="card mb-4">
                    <h6 class="card-header">Static controls</h6>
                    <div class="card-body">
                        <form>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right">Email</label>
                                <div class="col-sm-10">
                                    <div class="form-control-plaintext">example.email.com</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label col-sm-2 text-sm-right">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" placeholder="Password" />
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10 ml-sm-auto">
                                    <button type="submit" class="btn btn-primary">Confirm identity</button>
                                </div>
                            </div>
                        </form>
                
                        <form class="form-inline mt-4">
                            <div class="form-control-plaintext mr-sm-2 mb-2 mb-sm-0">example.email.com</div>
                            <input type="password" class="form-control mr-sm-2 mb-2 mb-sm-0" placeholder="Password" />
                            <button type="submit" class="btn btn-primary">Confirm identity</button>
                        </form>
                    </div>
                </div>
                <!----------------------------->

                <br/><br/><br/>

                <!----------------------------->
                <div class="card mb-4">
                    <h6 class="card-header">States</h6>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">Valid</label>
                            <input type="text" class="form-control is-valid" />
                            <small class="valid-feedback">A block of help text that breaks onto a new line and may extend beyond one line.</small>
                        </div>
                
                        <div class="form-group">
                            <label class="form-label">Invalid</label>
                            <input type="text" class="form-control is-invalid" />
                            <small class="invalid-feedback">A block of help text that breaks onto a new line and may extend beyond one line.</small>
                        </div>
                
                        <div class="form-group position-relative">
                            <label class="form-label">Invalid with tooltip</label>
                            <input type="text" class="form-control is-invalid" />
                            <div class="invalid-tooltip">Please provide a valid state.</div>
                        </div>
                    </div>
                </div>                
                <!----------------------------->

                <br/><br/><br/>

                <!----------------------------->
                <div class="card mb-4">
                    <h6 class="card-header">Sizes</h6>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                                <label class="form-label form-label-lg">Large label</label>
                                <input type="text" class="form-control form-control-lg" placeholder="Large input" />
                                <div class="clearfix"></div>
                            </div>
                
                            <div class="form-group">
                                <label class="form-label form-label-sm">Small label</label>
                                <input type="text" class="form-control form-control-sm" placeholder="Small input" />
                                <div class="clearfix"></div>
                            </div>
                        </form>
                        <form class="mt-4">
                            <div class="form-group row">
                                <label class="col-form-label col-form-label-lg col-sm-2 text-sm-right">Large label</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-lg" placeholder="Large input" />
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                
                            <div class="form-group row">
                                <label class="col-form-label col-form-label-sm col-sm-2 text-sm-right">Small label</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" placeholder="Small input" />
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!----------------------------->


                <br/><br/><br/>
                <br/><br/><br/>
                <!----------------------------->
                <div class="position-relative" data-select2-id="227">
                    <select class="select2-demo form-control select2-hidden-accessible" style="width: 100%;" data-allow-clear="true" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        <option data-select2-id="3">. . .</option>
                        <option value="AK" data-select2-id="228">Alaska</option>
                        <option value="HI" data-select2-id="229">Hawaii</option>
                        <option value="CA" data-select2-id="230">California</option>
                        
                    </select>
                    <span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" data-select2-id="2" style="width: 100%;">
                        <span class="selection">
                            <span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-7sbi-container">
                                <span class="select2-selection__rendered" id="select2-7sbi-container" role="textbox" aria-readonly="true" title="Oregon">Oregon</span>
                                <span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                            </span>
                        </span>
                        <span class="dropdown-wrapper" aria-hidden="true"></span>
                    </span>
                </div>
                <!----------------------------->
                <br/><br/><br/>

                <!----------------------------->
                <div class="position-relative" data-select2-id="117">
                    <select class="select2-demo form-control select2-hidden-accessible" multiple="" style="width: 100%;" data-select2-id="4" tabindex="-1" aria-hidden="true">
                        <optgroup label="Alaskan/Hawaiian Time Zone" data-select2-id="118">
                            <option value="AK" data-select2-id="119">Alaska</option>
                            <option value="HI" data-select2-id="120">Hawaii</option>
                        </optgroup>
                        <optgroup label="Pacific Time Zone" data-select2-id="121">
                            <option value="CA" data-select2-id="122">California</option>
                            <option value="NV" data-select2-id="123">Nevada</option>
                            <option value="OR" data-select2-id="124">Oregon</option>
                            <option value="WA" selected="" data-select2-id="6">Washington</option>
                        </optgroup>
                        <optgroup label="Mountain Time Zone" data-select2-id="125">
                            <option value="AZ" data-select2-id="126">Arizona</option>
                            <option value="CO" data-select2-id="127">Colorado</option>
                            <option value="ID" data-select2-id="128">Idaho</option>
                        </optgroup>
                        <optgroup label="Central Time Zone" data-select2-id="135">
                            <option value="AL" data-select2-id="136">Alabama</option>
                            <option value="AR" data-select2-id="137">Arkansas</option>
                        </optgroup>
                        <optgroup label="Eastern Time Zone" data-select2-id="151">
                            <option value="CT" data-select2-id="152">Connecticut</option>
                            <option value="DE" data-select2-id="153">Delaware</option>
                            <option value="FL" data-select2-id="154">Florida</option>
                        </optgroup>
                    </select>
                    <span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" data-select2-id="5" style="width: 100%;">
                        <span class="selection">
                            <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1">
                                <ul class="select2-selection__rendered">
                                    <li class="select2-selection__choice" title="Washington" data-select2-id="280"><span class="select2-selection__choice__remove" role="presentation">×</span>Washington</li>
                                    <li class="select2-search select2-search--inline">
                                        <input
                                            class="select2-search__field"
                                            type="search"
                                            tabindex="0"
                                            autocomplete="off"
                                            autocorrect="off"
                                            autocapitalize="none"
                                            spellcheck="false"
                                            role="textbox"
                                            aria-autocomplete="list"
                                            placeholder=""
                                            style="width: 0.75em;"
                                        />
                                    </li>
                                </ul>
                            </span>
                        </span>
                        <span class="dropdown-wrapper" aria-hidden="true"></span>
                    </span>
                </div>
                
                <!----------------------------->

                <br/><br/><br/>
                <!----------------------------->
                <input type="text" id="daterange-3" value="10/24/1984" class="form-control">
                <!----------------------------->
                <br/><br/><br/>


                <!----------------------------->
               
                    <div class="card mb-4">
                        <div class="card-body">
                            <label class="switcher">
                                <input type="checkbox" class="switcher-input" />
                                <span class="switcher-indicator">
                                    <span class="switcher-yes"></span>
                                    <span class="switcher-no"></span>
                                </span>
                                <span class="switcher-label">Default</span>
                            </label>
                        </div>
                        <hr class="m-0" />
                        <div class="card-body">
                            <div class="text-light small font-weight-semibold mb-3">With icon</div>
                            <label class="switcher">
                                <input type="checkbox" class="switcher-input" />
                                <span class="switcher-indicator">
                                    <span class="switcher-yes">
                                        <span class="ion ion-md-checkmark"></span>
                                    </span>
                                    <span class="switcher-no">
                                        <span class="ion ion-md-close"></span>
                                    </span>
                                </span>
                                <span class="switcher-label">With icon</span>
                            </label>
                        </div>
                        <hr class="m-0" />
                        <div class="card-body">
                            <div class="text-light small font-weight-semibold mb-3">Square</div>
                            <label class="switcher switcher-square">
                                <input type="checkbox" class="switcher-input" />
                                <span class="switcher-indicator">
                                    <span class="switcher-yes"></span>
                                    <span class="switcher-no"></span>
                                </span>
                                <span class="switcher-label">Square</span>
                            </label>
                        </div>
                        <hr class="m-0" />
                        <div class="card-body">
                            <div class="text-light small font-weight-semibold mb-3">Sizes</div>
                            <div class="demo-vertical-spacing-sm">
                                <label class="switcher switcher-sm">
                                    <input type="checkbox" class="switcher-input" />
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes">
                                            <span class="ion ion-md-checkmark"></span>
                                        </span>
                                        <span class="switcher-no">
                                            <span class="ion ion-md-close"></span>
                                        </span>
                                    </span>
                                    <span class="switcher-label">Small</span>
                                </label>
                                <br />
                                <label class="switcher switcher-lg">
                                    <input type="checkbox" class="switcher-input" />
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes">
                                            <span class="ion ion-md-checkmark"></span>
                                        </span>
                                        <span class="switcher-no">
                                            <span class="ion ion-md-close"></span>
                                        </span>
                                    </span>
                                    <span class="switcher-label">Large</span>
                                </label>
                            </div>
                        </div>
                        <hr class="m-0" />
                        <div class="card-body">
                            <div class="text-light small font-weight-semibold mb-3">Variations</div>
                            <div class="demo-inline-spacing">
                                <label class="switcher switcher-success">
                                    <input type="checkbox" class="switcher-input" checked="" />
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes">
                                            <span class="ion ion-md-checkmark"></span>
                                        </span>
                                        <span class="switcher-no">
                                            <span class="ion ion-md-close"></span>
                                        </span>
                                    </span>
                                    <span class="switcher-label">Success</span>
                                </label>
                                <label class="switcher switcher-info">
                                    <input type="checkbox" class="switcher-input" checked="" />
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes">
                                            <span class="ion ion-md-checkmark"></span>
                                        </span>
                                        <span class="switcher-no">
                                            <span class="ion ion-md-close"></span>
                                        </span>
                                    </span>
                                    <span class="switcher-label">Info</span>
                                </label>
                                <label class="switcher switcher-warning">
                                    <input type="checkbox" class="switcher-input" checked="" />
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes">
                                            <span class="ion ion-md-checkmark"></span>
                                        </span>
                                        <span class="switcher-no">
                                            <span class="ion ion-md-close"></span>
                                        </span>
                                    </span>
                                    <span class="switcher-label">Warning</span>
                                </label>
                                <label class="switcher switcher-danger">
                                    <input type="checkbox" class="switcher-input" checked="" />
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes">
                                            <span class="ion ion-md-checkmark"></span>
                                        </span>
                                        <span class="switcher-no">
                                            <span class="ion ion-md-close"></span>
                                        </span>
                                    </span>
                                    <span class="switcher-label">Danger</span>
                                </label>
                                <label class="switcher switcher-secondary">
                                    <input type="checkbox" class="switcher-input" checked="" />
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes">
                                            <span class="ion ion-md-checkmark"></span>
                                        </span>
                                        <span class="switcher-no">
                                            <span class="ion ion-md-close"></span>
                                        </span>
                                    </span>
                                    <span class="switcher-label">Secondary</span>
                                </label>
                                <label class="switcher switcher-dark">
                                    <input type="checkbox" class="switcher-input" checked="" />
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes">
                                            <span class="ion ion-md-checkmark"></span>
                                        </span>
                                        <span class="switcher-no">
                                            <span class="ion ion-md-close"></span>
                                        </span>
                                    </span>
                                    <span class="switcher-label">Dark</span>
                                </label>
                            </div>
                        </div>
                        <hr class="m-0" />
                        <div class="card-body">
                            <div class="text-light small font-weight-semibold mb-3">Disabled</div>
                            <div class="demo-vertical-spacing-sm">
                                <div>
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" disabled="" />
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Default - OFF</span>
                                    </label>
                                    <label class="switcher">
                                        <input type="checkbox" class="switcher-input" checked="" disabled="" />
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Default - ON</span>
                                    </label>
                                </div>
                                <fieldset disabled="">
                                    <label class="switcher switcher-success">
                                        <input type="checkbox" class="switcher-input" checked="" />
                                        <span class="switcher-indicator">
                                            <span class="switcher-yes"></span>
                                            <span class="switcher-no"></span>
                                        </span>
                                        <span class="switcher-label">Success - ON</span>
                                    </label>
                                </fieldset>
                            </div>
                        </div>
                        <hr class="m-0" />
                        <div class="card-body">
                            <div class="text-light small font-weight-semibold mb-3">Validation states</div>
                            <div class="form-group">
                                <label class="switcher">
                                    <input type="checkbox" class="switcher-input is-valid" checked="" />
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Valid</span>
                                </label>
                            </div>
                            <div class="form-group has-error">
                                <label class="switcher">
                                    <input type="checkbox" class="switcher-input is-invalid" checked="" />
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Invalid</span>
                                </label>
                            </div>
                        </div>
                        <hr class="m-0" />
                        <div class="card-body">
                            <div class="text-light small font-weight-semibold mb-3">Stacked</div>
                            <div class="switchers-stacked">
                                <label class="switcher">
                                    <input type="radio" class="switcher-input" name="switchers-stacked-radio" checked="" />
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Option 1</span>
                                </label>
                                <label class="switcher">
                                    <input type="radio" class="switcher-input" name="switchers-stacked-radio" />
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Option 2</span>
                                </label>
                                <label class="switcher">
                                    <input type="radio" class="switcher-input" name="switchers-stacked-radio" />
                                    <span class="switcher-indicator">
                                        <span class="switcher-yes"></span>
                                        <span class="switcher-no"></span>
                                    </span>
                                    <span class="switcher-label">Option 3</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <br/><br/><br/>
                <!----------------------------->


                <!----------------------------->
                    <div class="card-body">
                        <div class="text-light small font-weight-semibold mb-3">Validation states</div>
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input is-valid" />
                                <span class="custom-control-label">Valid state</span>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input is-invalid" />
                                <span class="custom-control-label">Invalid state</span>
                            </label>
                        </div>
                    </div>
                    <br/><br/><br/>
                <!----------------------------->





        <!---------------------------------------------------------------------->        
            <!--****************--real space in content--****************--->     
        </div>
        <!----*********************---real space in content---*********************---> 


        
    <!---------------------------------------------------------------------->    
    <!-------------------total content space for this page------------------> 
    </div>
    <!-------------------total content space for this page------------------> 





<input type="hidden" value="{{route('test')}}" id="url">
<!---------------js---------------->
@push('js')
<!---------------js---------------->
<script src="{{asset('backend/links/assets')}}/libs/bootstrap-select/bootstrap-select.js"></script>
<script src="{{asset('backend/links/assets')}}/libs/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="{{asset('backend/links/assets')}}/libs/select2/select2.js"></script>
<script src="{{asset('backend/links/assets')}}/libs/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>

<script src="{{asset('backend/links/assets')}}/js/demo.js"></script>
<script src="{{asset('backend/links/assets')}}/js/analytics.js"></script>
<script src="{{asset('backend/links/assets')}}/js/pages/forms_selects.js"></script>


<script src="{{asset('backend/links/assets')}}/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="{{asset('backend/links/assets')}}/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>
<script src="{{asset('backend/links/assets')}}/libs/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.js"></script>
<script src="{{asset('backend/links/assets')}}/libs/timepicker/timepicker.js"></script>
<script src="{{asset('backend/links/assets')}}/libs/minicolors/minicolors.js"></script>

<script src="{{asset('backend/links/assets')}}/js/pages/forms_pickers.js"></script>




    <script>
            $(document).ready(function(){
                var url = $('#url').val();
                //alert('now');
                $.ajax({
                    url:url,
                    success:function(response){
                        //alert('response');
                    }
                });
            });
    </script>
    
<!---------------js---------------->
@endpush
<!---------------js---------------->


<!-------------------------------------------Content------------------------------->
<!-------------------------------------------Content------------------------------->
@endsection
<!-------------------------------------------Content------------------------------->
<!-------------------------------------------Content------------------------------->