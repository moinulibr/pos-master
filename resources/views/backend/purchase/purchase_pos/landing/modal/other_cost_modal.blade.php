<div class="modal fade text-left" id="otherCostPopUpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel122" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel122">Add Others Cost</h3>
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
                <div class="row">
                    <div class="col-12 " style="margin-bottom:4px;">
                        <div class="p-3 bg-light-dark d-flex justify-content-between border-bottom">
                            <h5 class="font-size-bold mb-0">Subtotal:</h5>
                            <h5 class="font-size-bold mb-0">
                                <span class="subtotalBasedOnSellCartDiscountVatAndShippingCost">0</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-12" style="padding-left: 20px;">
                        <label class="text-body">Others Cost Amount</label>
                        <fieldset class="form-group mb-3 d-flex">
                            <input type="text" name="invoice_other_cost_amount" class="invoice_other_cost_amount form-control bg-white inputFieldValidatedOnlyNumeric" placeholder="Enter other cost amount" />
                            <span class="bg-light-dark  btn ml-2  pt-1 pb-1 d-flex align-items-center justify-content-center" style="width: 35%;">
                                <strong class="invoice_total_other_cost_amount">0</strong>
                            </span>
                        </fieldset>
                        <span class="invoice_other_cost_amount_error_message" style="color:red;margin: auto 40%;"></span>
                    </div>
                   
                    <div class="col-12">
                        <div class="p-1 bg-light-dark d-flex justify-content-between border-bottom">
                            <div class="bg-light-dark" style="padding-top: 5px;">
                                <h5 class="font-size-bold mb-0">Subtotal after other cost:
                                </h5>
                            </div>
                            <h5>
                                <strong class="invoice_subtotal_after_other_cost" style="padding-left: 4px;">0</strong>
                            </h5>
                            {{-- <a href="javascript:void(0)" class="invoice_other_cost_apply btn-secondary btn ml-2 white pt-1 pb-1 d-flex align-items-center justify-content-center">Apply</a> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>