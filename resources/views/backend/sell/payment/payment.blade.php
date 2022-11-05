<style>
    .modal-full {
            min-width: 90%;
            margin: 0;
            margin-left:5%;
        }

        .modal-full .modal-content {
            min-height: 100vh;
        }
</style>
<div class="modal-dialog modal-lg modal-full" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">
                <strong style="mergin-right:20px;">Sell Details (Invoice No.: {{$data->invoice_no}})</strong>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </h4>
        </div>

        <div class="modal-body">


                    <div class="payment_data_response"></div>
                    
                    
                    

                    <input type="hidden" name="sell_type" value="1">
                    <div class="form-group row justify-content-end mb-0">
                        <div class="col-md-6 text-right">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" style="padding:7px 20px;">Close</button>
                            <input type="submit" class="submitButton btn btn-primary" value="Payment" style="padding:7px 20px;">
                        </div>
                    </div>
                   
        </div>
            
    </div>
</div>
