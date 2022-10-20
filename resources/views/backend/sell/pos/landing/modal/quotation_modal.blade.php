<div class="modal fade text-left" id="quotation-popup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel11" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <form action="{{route('admin.sell.regular.pos.store.data.from.sell.cart')}}" method="POST" class="storeDataFromSellCart">
                @csrf
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel11">Quotation</h3>
                    <button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-dismiss="modal" aria-label="Close">
                        <svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path
                                fill-rule="evenodd"
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"
                            ></path>
                        </svg>
                    </button>
                </div>
                <div class="modal-body" style="padding-left:50px;padding-right:50px;">
                    <div class="quotation_data_response"></div>
                    
                    <input type="hidden" name="sell_type" value="2">
                    <div class="form-group row justify-content-end mb-0">
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" style="padding:7px 20px;">Close</button>
                            <input type="submit"  class="btn btn-primary" value="Submit Quotation" style="padding:7px 20px;">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
