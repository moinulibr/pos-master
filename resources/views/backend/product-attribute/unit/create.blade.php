

            <!-------form------> 
            {{-- 
            <div class="card">
                <h6 class="card-header">Unit Information</h6>
                <div class="card-body">
                    <form action="{{route('admin.unit.store')}}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right">Unit Full Name</label>
                            <div class="col-sm-7">
                                <input name="full_name" type="text" class="form-control" placeholder="Unit Full Name">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right">Unit Short Name</label>
                            <div class="col-sm-7">
                                <input name="short_name" type="text" class="form-control" placeholder="Unit Short Name">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right">Parent Unit Name</label>
                            <div class="col-sm-7">
                                <select name="parent_id" id="" class="form-control">
                                    <option value="0">No Parent Unit</option>
                                    @foreach ($datas as $item)
                                        <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                                    @endforeach
                                </select>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right">Calculation By This Value</label>
                            <div class="col-sm-7">
                                <input name="calculation_value" type="number" step="any" class="form-control" placeholder="Calculation By This Value">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right">Base Unit</label>
                            <div class="col-sm-7">
                                <select name="base_unit_id" id="" class="form-control">
                                    <option value="0">No Base Unit</option>
                                    @foreach ($datas as $item)
                                        <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                                    @endforeach
                                </select>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right">Description</label>
                            <div class="col-sm-7">
                                <textarea name="description" class="form-control" placeholder="Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-9 ml-sm-auto">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
           --}}
            <!-------form------> 

            <div class="modal-dialog modal-lg">
                <form action="{{route('admin.unit.store')}}" method="POST" class="storeUnitData modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Unit 
                            <span class="font-weight-light">Information</span>
                            <br />
                            {{-- <small class="text-muted">Add New Unit</small> --}}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group row">
                            <div class="col-md-12 processing" style="text-align: center;display: none;">
                                <span style="color:saddlebrown;">
                                    <span class="spinner-border spinner-border-sm" role="status"></span>Processing
                                </span>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right">Unit Full Name</label>
                            <div class="col-sm-8">
                                <input name="full_name" type="text" class="form-control" placeholder="Unit Full Name">
                                <strong class="full_name_err color-red"></strong>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right">Unit Short Name</label>
                            <div class="col-sm-8">
                                <input name="short_name" type="text" class="form-control" placeholder="Unit Short Name">
                                <strong class="short_name_err color-red"></strong>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right">
                                    Parent Unit Name
                            </label>
                            <div class="col-sm-8">
                                <select name="parent_id" id="" class="form-control" style="background-color: lavender;color:green;">
                                    <option value="0">No Parent Unit</option>
                                    @foreach ($datas as $item)
                                        <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                                    @endforeach
                                </select>
                                <strong class="parent_id_err color-red"></strong>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right">
                                    Calculation Value
                            </label>
                            <div class="col-sm-8">
                                <input name="calculation_value" type="number" step="any" class="form-control" placeholder="Calculation By This Value"  style="background-color: lavender;color:green;">
                                <strong class="calculation_value_err color-red"></strong>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right">Base Unit</label>
                            <div class="col-sm-8">
                                <select name="base_unit_id" id="" class="form-control">
                                    <option value="0">No Base Unit</option>
                                    @foreach ($datas as $item)
                                        <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                                    @endforeach
                                </select>
                                <strong class="base_unit_id_err color-red"></strong>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-3 text-sm-right">Description</label>
                            <div class="col-sm-8">
                                <textarea name="description" class="form-control" placeholder="Description"></textarea>
                                <strong class="description_err color-red"></strong>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        {{-- 
                            <div class="form-row">
                                <div class="form-group col">
                                    <label class="form-label">Card number</label>
                                    <input type="text" class="form-control" placeholder="XXXX XXXX XXXX XXXX" />
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col mb-0">
                                    <label class="form-label">Expiration date</label>
                                    <input type="text" class="form-control" placeholder="DD / MM" />
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group col mb-0">
                                    <label class="form-label">Card holder</label>
                                    <input type="text" class="form-control" placeholder="Name on card" />
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        --}}

                    </div>

                    
                    <div class="create_from_div">
                        <input type="hidden" name="create_from" value="regular" class="create_from">
                        <input type="hidden" name="created_from_class_name" value="" class="created_from_class_name">
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" role="status" value="Save">
                    </div>
                </form>
            </div>





