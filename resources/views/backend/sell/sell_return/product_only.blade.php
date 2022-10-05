<div class="table-responsive">
    <table id="example1" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th style="width:5%;">AS Code</th>
                <th style="width:35%;">Product</th>
                <th style="width:5%;"><small>Total Sell Qty</small></th>
                <th style="width:55%;">
                    <div class="table-responsive"  style="padding-bottom: 0px;margin-bottom: -7px !important;">
                        <table id="example1" class="table table-bordered table-striped table-hover" style="padding-bottom: 0px;margin-bottom: 0px;">
                            <tr>
                                <td  style="width:25%;">Stock Name</td>
                                <td>Sell Unit</td>
                                <td>Sell Price</td>
                                <td>Sell Qty</td>
                                <td  style="width:25%;">
                                    Return Qty
                                </td>
                                <td><small>Return Subtotal</small></td>
                                <td  style="width:10%;text-align: center">
                                    <input class="check_all_class_for_return form-control" type="checkbox" value="all" name="check_all" style="box-shadow:none;">
                                </td>
                            </tr>
                        </table>
                    </div> 
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data->sellProducts ? $data->sellProducts : NULL  as $item)
            <tr>
                @php
                    $cats = json_decode($item->cart,true);
                @endphp
                <td> {{$item->custom_code}}</td>
                <td>
                    @if (array_key_exists('productName',$cats))
                        {{$cats['productName']}}
                        @else
                        NULL
                    @endif
                </td>
                <td style="text-align: center">
                    {{$item->quantity}}
                </td>
                <td>
                    <div class="table-responsive" style="padding-bottom: 0px;margin-bottom: -7px !important;">
                        <table id="example1" class="table table-bordered table-striped table-hover"  style="padding-bottom: 0px;margin-bottom: 0px;">
                            @foreach ($item->sellProductStocks as $pstock)
                            <tr>
                                <td style="width:17%;">
                                    <small>
                                        {{ $pstock->stock ? $pstock->stock->label : NULL}}
                                    </small>
                                </td>
                                <td style="width: 11%">
                                    @if (array_key_exists('unitName',$cats))
                                        <small>{{$cats['unitName']}}</small>
                                        @else
                                        NULL
                                    @endif
                                </td>
                                <td style="width:10%;text-align: center">
                                    {{$pstock->sold_price}}
                                    <input type="hidden" class="sold_price_for_return sold_price_for_return_{{$pstock->id}}" value="{{$pstock->sold_price}}">
                                </td>
                                <td style="width:8%;text-align: center">{{$pstock->total_quantity}}</td>
                                <td style="width:15%;text-align: center">
                                    @php
                                        if($pstock->total_quantity > 0) 
                                        {
                                            $returningQtyNow = $pstock->total_quantity; 
                                        }
                                        else{
                                            $returningQtyNow = 0; 
                                        }
                                    @endphp
                                    @if ($returningQtyNow > 0)
                                        <input type="text" name="returning_qty_{{$pstock->id}}" value="{{$returningQtyNow}}" class="form-control returning_qty returning_qty_{{$pstock->id}} inputFieldValidatedOnlyNumeric" data-id="{{$pstock->id}}">
                                        @elseif ($returningQtyNow == 0)
                                        <input type="text" disabled value="{{$returningQtyNow}}" class="form-control" style="background-color: red;color:#ffff;">
                                    @endif
                                    <input type="hidden" value="{{$pstock->total_quantity}}" class="total_quantity total_quantity_{{$pstock->id}}">
                                </td>
                                <td style="width:15%;text-align: center">
                                    <input type="text" class="line_subtotal_for_return line_subtotal_for_return_{{$pstock->id}} form-control" disabled>
                                </td>
                                <td style="width:5%;text-align: center">
                                    @if ($returningQtyNow > 0)
                                    <input type="hidden" value="{{$data->id}}" name="sell_invoice_id">
                                    <input class="check_single_class_for_return form-control check_single_class_for_return_{{$pstock->id}}" type="checkbox"  name="checked_id[]" value="{{ $pstock->id }}" id="{{$pstock->id}}" style="box-shadow:none;">
                                        @else
                                        <input class="form-control" type="checkbox" disabled style="box-shadow:none;" >
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div> 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
