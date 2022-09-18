
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#f9f5f4;"> <!---#e2f7f6;-->
                        <h5 class="modal-title">&nbsp;</h5>
                        <button type="button" style="color:red;" class="close" data-dismiss="modal" aria-label="Close">×</button>
                    </div>


                    <div class="modal-body " style="background-color:#ede7e7;"><!-- #e2f7f6; modal body-->
                        
                        <div class="form-group" style="text-align: center">
                            <strong>Do you want to delete this?</strong>
                            <input type="hidden" class="remove_product_id" value="{{$product_id}}">
                        </div>

                    </div>
                    <!--modal body-->

                    <div class="modal-footer" style="background-color:#f9f5f4;">
                        <button type="button" style="padding:6px;color:white;cursor: pointer;" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <strong style="cursor: pointer; padding:6px;" class="removeSingleItemFromSellCartProductList btn btn-primary">Yes</strong>
                    </div>
                </div>
            </div>

