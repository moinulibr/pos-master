<table class="table right-table">
    <tbody>
        <tr class="d-flex align-items-center justify-content-between" style="width: 100%;">
            <th class="border-0" style="text-align: left !important;background-color:#f5f5f5;width:25%">
                <div class="d-flex align-items-center font-size-h5 mb-0 font-size-bold text-dark"  style="padding-left:4px;">
                    <strong style="color:#9e53ee!important">
                        Total Items
                    </strong> 
                </div>
            </th>
            <td class="border-0 " style="width:25%;">
                <strong style="color:#8428e7">
                    <span class="totalItemFromSellCartList">0</span>
                </strong>
            </td>
            <th class="border-0" style="width:25%;text-align: left !important;">
                <div class="d-flex align-items-center font-size-h5 mb-0 font-size-bold text-dark" style="color:#9e53ee">
                    <strong style="color:#9e53ee!important;padding-left: 4%;">
                    Subtotal
                    </strong> 
                </div>
            </th>
            <td class="border-0  d-flex text-dark font-size-base" >
                <strong style="color:#9e53ee">
                    <span class="subtotalFromSellCartList">0</span>
                    <input type="hidden" class="subtotalFromSellCartListValue" name="invoice_subtotal_before_discount" value="">
                    <input type="hidden" class="totalPurchasePriceForThisInvoiceFromSellCartList" name="invoice_subtotal_before_discount" value="">
                </strong>
            </td>
        </tr>

        <tr class="d-flex align-items-center justify-content-between" style="width: 100%;">
            <th class="border-0" style="text-align: left !important;background-color:#f5f5f5;width:25%">
                <div class="d-flex align-items-center font-size-h5 mb-0 font-size-bold text-dark" style="padding-left:4px;">
                    Shipping Cost
                    <span class="badge badge-secondary white rounded-circle ml-2 invoiceShippingCostApplyModal" data-toggle="modal" data-target="#shippingCostPopUpModal" style="cursor: pointer">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                @include('backend.sell.pos.landing.modal.shipping_cost_modal')
            </th>
            <td class="border-0 " style="width:25%;text-align: left !important;">
               <strong class="invoiceFinalShippingCostAmount">0.0</strong>
            </td>

            <th class="border-0" style="width:25%;text-align: left !important;margin-left:0px;padding-left:0px">
                <div class="d-flex align-items-center font-size-h5 mb-0 font-size-bold text-dark">
                    <span style="font-size: 11px;">Less Amount</span> 
                    <span class="invoiceDiscount">
                        (<span class="invoiceDiscountAmount">0</span>
                        <span class="invoiceDiscountType" style="margin-left: -3px;"></span>)
                    </span>
                    <span class="badge badge-secondary white rounded-circle ml-2 invoiceDiscountApplyModal" data-toggle="modal" data-target="#discountPopUpModal" style="cursor: pointer;">
                        <i class="fa fa-minus"></i>
                    </span>
                </div>
                @include('backend.sell.pos.landing.modal.discount_modal')
            </th>
            <td class="border-0  d-flex text-dark font-size-base" >
                <strong class="invoiceFinalTotalDiscountAmount">0</strong>
            </td>
        </tr>

        <tr class="d-flex align-items-center justify-content-between" style="width: 100%;">
            <th class="border-0" style="background-color:#f5f5f5;width:25%;text-align:left !important">
                <div class="d-flex align-items-center font-size-h5 mb-0 font-size-bold text-dark" style="padding-left:4px;">
                    Others Cost
                    <span class="badge badge-secondary white rounded-circle ml-2 invoiceOtherCostApplyModal" data-toggle="modal" data-target="#otherCostPopUpModal" style="cursor: pointer">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                @include('backend.sell.pos.landing.modal.other_cost_modal')
            </th>
            <td  class="border-0"  style="text-align: left !important;width:25%;">
                <strong  class="invoiceFinalTotalOtherCostAmount" style="padding-left: 25%;">0.0</strong>
            </td>
            
            <th class="border-0"  style="text-align: left !important;width:30%;">
                <div class="d-flex align-items-center font-size-h5 mb-0 font-size-bold text-dark" style="padding-left: 52%">
                    Vat
                    <span class="invoiceVat">
                        (<span class="invoiceVatAmount">0</span>
                        <span class="invoiceVatType" style="margin-left: -3px;"></span>)
                    </span>
                    <span class="badge badge-secondary white rounded-circle ml-2 invoiceVatApplyModal" data-toggle="modal" data-target="#vatPopUpModal" style="cursor: pointer">
                        <i class="fa fa-plus"></i>
                    </span>
                </div>
                @include('backend.sell.pos.landing.modal.vat_modal')
            </th>
            <td class="border-0 justify-content-end d-flex text-dark font-size-base" style="width:20%;">
                <strong  class="invoiceFinalTotalVatAmount">0.0</strong>
            </td>
        </tr>
      
        <tr class="d-flex align-items-center justify-content-between item-price" style="background-color:#f5f5f5;width: 100%;">
            <th colspan="3" class="border-0 font-size-h5 mb-0 font-size-bold text-primary" style="color:#6010b3;width: 82%;text-align:right">
                <strong style="color:#6010b3">Payable Amount </strong>
            </th>
            <td class="border-0 justify-content-end d-flex text-primary font-size-base" style="background-color:#f5f5f5;width: 18%;">
                <strong style="color:#6010b3;" class="netPayableInvoiceTotal">00.00</strong>
            </td>
        </tr>
    </tbody>
</table>