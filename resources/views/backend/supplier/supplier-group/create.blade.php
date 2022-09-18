
            <div class="modal-dialog modal-lg">
                <form action="{{route('admin.supplier.group.store')}}" method="POST" class="storeSupplierGroupData modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Supplier Group 
                            <span class="font-weight-light">Information</span>
                            <br />
                            {{-- <small class="text-muted">Add New Supplier Group</small> --}}
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
                            <label class="col-form-label col-sm-3 text-sm-right">Name</label>
                            <div class="col-sm-8">
                                <input name="name" type="text" class="form-control" placeholder="Supplier Group Name">
                                <strong class="name_err color-red"></strong>
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





