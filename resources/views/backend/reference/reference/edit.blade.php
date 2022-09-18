<div class="modal-dialog modal-lg">
    <form action="{{route('admin.reference.update')}}" method="POST" class="updateReferenceData modal-content">
        @csrf
        <input type="hidden" name="id" value="{{$reference->id}}">
        <div class="modal-header">
            <h5 class="modal-title">
                Update Reference 
                <span class="font-weight-light">Information</span>
                <br />
                {{-- <small class="text-muted">Add New Reference</small> --}}
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
                    <input name="name" type="text" value="{{$reference->name}}" class="form-control" placeholder="Reference Name">
                    <strong class="name_err color-red"></strong>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right">Phone</label>
                <div class="col-sm-8">
                    <input name="phone" type="text" value="{{$reference->phone}}"  class="form-control" placeholder="Phone">
                    <strong class="phone_err color-red"></strong>
                    <div class="clearfix"></div>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right">Email (optional)</label>
                <div class="col-sm-8">
                    <input name="email"  value="{{$reference->email}}"  type="email" class="form-control" placeholder="Email">
                    <strong class="email_err color-red"></strong>
                    <div class="clearfix"></div>
                </div>
            </div>
                
            <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right">Profession</label>
                <div class="col-sm-8">
                    <input name="profession" value="{{$reference->profession}}"  type="text" class="form-control" placeholder="Profession">
                    <strong class="profession_err color-red"></strong>
                    <div class="clearfix"></div>
                </div>
            </div>
                
            {{-- <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right">Previous Due</label>
                <div class="col-sm-8">
                    <input name="previous_due" value="{{$reference->previous_due}}"  type="number" step="any" value="0" class="form-control" placeholder="Previous Due">
                    <strong class="previous_due_err color-red"></strong>
                    <div class="clearfix"></div>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right">Previous Due Date</label>
                <div class="col-sm-8">
                    <input name="previous_due_date" value="{{$reference->previous_due_date}}" type="date" class="form-control" placeholder="Previous Due Date">
                    <strong class="previous_due_date_err color-red"></strong>
                    <div class="clearfix"></div>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right">Next Due Payment Date</label>
                <div class="col-sm-8">
                    <input name="next_payment_date" value="{{$reference->next_payment_date}}" type="date" class="form-control" placeholder="Next Due Payment Date">
                    <strong class="next_payment_date_err color-red"></strong>
                    <div class="clearfix"></div>
                </div>
            </div> --}}
            
            <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right">Address</label>
                <div class="col-sm-8">
                    <textarea name="address" class="form-control" placeholder="Address">{{$reference->address}}</textarea>
                    <strong class="address_err color-red"></strong>
                    <div class="clearfix"></div>
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-form-label col-sm-3 text-sm-right">Note</label>
                <div class="col-sm-8">
                    <textarea name="note" class="form-control" placeholder="Note">{{$reference->note}}</textarea>
                    <strong class="note_err color-red"></strong>
                    <div class="clearfix"></div>
                </div>
            </div>

            
            <div class="create_from_div">
                <input type="hidden" name="create_from" value="regular" class="create_from">
                <input type="hidden" name="created_from_class_name" value="" class="created_from_class_name">
            </div>
            
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" role="status" value="Update">
        </div>
    </form>
</div>
