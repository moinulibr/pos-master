
            <div class="modal-dialog modal-lg">
                <form action="{{route('admin.customer.store')}}" method="POST" class="storeCustomerData modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Customer 
                            <span class="font-weight-light">Information</span>
                            <br />
                            {{-- <small class="text-muted">Add New Customer</small> --}}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body" style="margin-left:30px;margin-right:30px;">

                        <div class="form-group row">
                            <div class="col-md-12 processing" style="text-align: center;display: none;">
                                <span style="color:saddlebrown;">
                                    <span class="spinner-border spinner-border-sm" role="status"></span>Processing
                                </span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="col-form-label text-sm-right">Name</label>
                                <input name="name" type="text" class="form-control" placeholder="Customer Name">
                                <strong class="name_err color-red"></strong>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label text-sm-right">
                                        Customer Type
                                </label>
                                <select name="customer_type_id" id="" class="form-control" style="background-color: lavender;color:green;">
                                    @foreach ($datas as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <strong class="customer_type_id_err color-red"></strong>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="col-form-label text-sm-right">Phone</label>
                                <input name="phone" type="text" class="form-control" placeholder="Phone">
                                <strong class="phone_err color-red"></strong>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label text-sm-right">Email (optional)</label>
                                <input name="email" type="email" class="form-control" placeholder="Email">
                                <strong class="email_err color-red"></strong>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="col-form-label text-sm-right">Previous Due</label>
                                <input name="previous_due" type="number" step="any" value="0" class="form-control" placeholder="Previous Due">
                                <strong class="previous_due_err color-red"></strong>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label text-sm-right">Previous Due Date</label>
                                <input name="previous_due_date" type="date" class="form-control" placeholder="Previous Due Date">
                                <strong class="previous_due_date_err color-red"></strong>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="col-form-label text-sm-right">Next Due Payment Date</label>
                                <input name="next_payment_date" type="date" class="form-control" placeholder="Next Due Payment Date">
                                <strong class="next_payment_date_err color-red"></strong>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label text-sm-right">Address</label>
                                <textarea name="address" class="form-control" placeholder="Address"></textarea>
                                <strong class="address_err color-red"></strong>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="col-form-label text-sm-right">Note</label>
                                <textarea name="note" class="form-control" placeholder="Note"></textarea>
                                <strong class="note_err color-red"></strong>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label text-sm-right">Ledger Page No</label>
                                <textarea name="ledger_page_no" class="form-control" placeholder="Ledger Page No"></textarea>
                                <strong class="ledger_page_no_err color-red"></strong>
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





