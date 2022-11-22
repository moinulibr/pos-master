<div class="table-responsive table-responsive-index-page">
    <table class="table table-bordered mb-0">
        <thead>
            <tr>
                <th  style="width:3%;">#</th>
                <th style="width:5%;">Action</th>
                <th style="width:;">Invoice No</th>
                <th style="width:;">Date(Time) </th>
                <th style="width:;">Customer </th>
                <th style="width:;">Total Amount </th>
                <th style="width:;">Payment Status </th>
                <th style="width:;">Paid Amount </th>
                <th style="width:;">Due Amount </th>
                <th style="width:;">Less Amount </th>
                <th style="width:;">Created By </th>
                <th style="width:;">Total Item </th>
                <th style="width:;">Reference By</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $index => $item)
                <tr>
                    <th scope="row">
                        {{$index + 1}}
                    </th>
                    
                    <td style="width:3%;">
                        <div class="btn-group btnGroupForMoreAction">
                            <button type="button" class="btn btn-sm" data-toggle="dropdown" aria-expanded="true">
                                <i class="fas fa-ellipsis-v"></i>
                                {{-- <i class="fas fa-cogs"></i> --}}
                            </button>
                            <div class="dropdown-menu " x-placement="top-start" style="position: absolute; will-change: top, left; top: -183px; left: 0px;">
                                <a class="dropdown-item singleSellView" data-id="{{$item->id}}" style="cursor: pointer">View</a>
                                <a class="dropdown-item print" target="_blank" data-id="{{$item->id}}" href="{{route('admin.sell.regular.normal.print.from.sell.list',$item->id)}}" style="cursor: pointer">Print</a>
                                <a class="dropdown-item print"  target="_blank" data-id="{{$item->id}}" href="{{route('admin.sell.regular.pos.print.from.sell.list',$item->id)}}" style="cursor: pointer">Print (POS)</a>
                                <a class="dropdown-item singleSellInvoiceWiseDelivery" data-id="{{$item->id}}" style="cursor: pointer">Delivery</a>
                                <a class="dropdown-item singleSellInvoiceProfitLossView" data-id="{{$item->id}}" style="cursor: pointer">View Profit/Loss</a>
                                <a class="dropdown-item singleSellInvoiceReturnModalView" data-id="{{$item->id}}" style="cursor: pointer">Product Return</a>
                                <a class="dropdown-item singleSellInvoiceReceivePaymentModalView" data-id="{{$item->id}}" style="cursor: pointer">Make Payment</a>
                                <a class="dropdown-item singleViewSellInvoiceWisePaymentDetailsModal" data-id="{{$item->id}}" style="cursor: pointer">View Payment</a>
                                {{-- <a class="dropdown-item singleEditModal" data-id="{{$item->id}}" href="javascript:void(0)">Edit</a>
                                <a class="dropdown-item singleDeleteModal" data-id="{{$item->id}}" data-name="{{$item->name}}" href="javascript:void(0)">Delete</a> --}}
                            {{-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)">Separated link</a>
                            </div> --}}
                        </div>
                    </td>
                    <td> <a  class="singleSellView" data-id="{{$item->id}}" style="cursor: pointer">{{$item->invoice_no}} </a> </td>
                    <td>
                        <a  class="singleSellView" data-id="{{$item->id}}" style="cursor: pointer">
                            {{date('d-m-Y h:i:s A',strtotime($item->created_at))}}
                        </a>
                    </td>
                    <td>{{$item->customer?$item->customer->name:NULL}}</td>
                    <td>{{$item->total_payable_amount}}</td>
                    <td>{{paymentStatus_hh($item->total_payable_amount,$item->total_paid_amount)}}</td>
                    <td>{{$item->total_paid_amount}}</td>
                    <td>{{$item->due_amount}}</td>
                    <td>{{$item->total_discount}}</td>
                    <td>{{$item->createdBy?$item->createdBy->name:NULL}}</td>
                    <td>{{$item->total_item}}</td>
                    <td>{{$item->referenceBy?$item->referenceBy->name:NULL}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$datas->links()}}
</div>