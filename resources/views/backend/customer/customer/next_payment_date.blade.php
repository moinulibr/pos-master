
            <div class="modal-dialog modal-lg">
                <form action="{{route('admin.customer.store.next.payment.date')}}" method="POST" class="storeNextPaymentDate modal-content">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Customer 
                            <span class="font-weight-light">Next Payment Date</span>
                            <br />
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>
                    <div class="modal-body" style="margin-left:30px;margin-right:30px;">
                        <input type="hidden" name="customer_id" value="{{$customer->id}}">
                        <div class="form-group row">
                            <div class="col-md-12 processing" style="text-align: center;display: none;">
                                <span style="color:saddlebrown;">
                                    <span class="spinner-border spinner-border-sm" role="status"></span>Processing
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="col-form-label text-sm-right">Previous Date</label>
                                <input type="text" disabled class="form-control" value="{{$customer->next_payment_date}}">
                                <div class="clearfix"></div>
                            </div>
                            
                            <div class="col-sm-6">
                                <label class="col-form-label text-sm-right">Next Payment Date</label>
                                <input name="next_payment_date" type="date" class="form-control" required>
                                <strong class="next_payment_date_err color-red"></strong>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label class="col-form-label text-sm-right">Ledger Page No</label>
                                <input name="ledger_page_no" type="text" class="form-control" value="">
                                <strong class="phone_err color-red"></strong>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-form-label text-sm-right">Note</label>
                                <input type="text" name="short_note" class="form-control" value="" >
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        
                    <div class="modal-footer" style="padding-right: 0px;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" role="status" value="Save">
                    </div>
                </form>
            </div>





