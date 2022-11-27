
    <div class="modal fade text-left" id="shippingCostPopUpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1444" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel1444">Add Shipping Cost</h3>
                    <button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-dismiss="modal" aria-label="Close">
                        <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path
                                fill-rule="evenodd"
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"
                            ></path>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{route('admin.purchase.regular.pos.shipping.cost.and.others.store.in.session')}}" class="submitShippingCostAndOtherInformation" id="submitShippingCostAndOtherInformation">
                        @csrf
                        
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="text-body">Shipping Charges</label>
                                <fieldset class="form-group mb-3">
                                    <input type="text" name="invoice_shipping_cost" class="invoice_shipping_cost form-control inputFieldValidatedOnlyNumeric" placeholder="Enter Shipping Charges" style="padding-left:5px;background-color:#9dd1c2;color:#0d0c10" />
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <label class="text-body">Receiver Details</label>
                                <fieldset class="form-group mb-3">
                                    <textarea  name="receiver_details" class="receiver_details form-control" placeholder="Receiver Details"  ></textarea>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="text-body">Shipping Note</label>
                                <fieldset class="form-label-group">
                                    <textarea name="shipping_note" class="form-control" placeholder="Shipping Note"></textarea>
                                </fieldset>
                            </div>
                            <div class="col-md-6">
                                <label class="text-body">Purchase Note</label>
                                <fieldset class="form-label-group">
                                    <textarea name="purchase_note" class="form-control" placeholder="Purchase Note"></textarea>
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group row justify-content-end mb-0">
                            <div class="col-md-6 text-right">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" style="padding:6px 20px;">Close</button>
                                <input type="submit" class="btn btn-primary btn-md" value="Update Information" style="padding: 5px;">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>