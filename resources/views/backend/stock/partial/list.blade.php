<div class="table-responsive">
    <table class="table table-bordered mb-0">
        <thead>
            <tr>
                <th  style="width:3%;">#</th>
                <th>Photo</th>
                <th>
                    <small>AS Code</small>
                </th>
                <th>Name</th>
                <th>Total Stock</th>
                @foreach ($stocks as $stock)
                    <th>
                        {{$stock->label}}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $index => $item)
                <tr>
                    <th scope="row">
                        {{$index + 1}}
                    </th>
                    <td style="width:5%;">
                        <span style="cursor:pointer;" class="singleShowModal" data-id="{{$item->id}}" href="javascript:void(0)">
                            @if($item->photo)
                                <img src="{{ asset(productImageViewLocation_hh().$item->id.".".$item->photo) }}" alt="" width="40" height="40" style="padding:2px;border:1px solid #c7bbbb;background-color:#fbf8f8;border-radius:4px">
                                @else
                                <img src="{{ asset(defaultProductImageUrl_hh()) }}" alt="" width="40" height="40" style="padding:2px;border:1px solid #c7bbbb;background-color:#fbf8f8;border-radius:4px">
                            @endif
                        </span>
                    </td>
                    <td style="width:5%;">
                        <small>
                            {{ $item->custom_code }}
                        </small>
                    </td>
                    <td>
                        @php
                            $product = $item->name;
                            if(strlen($item->name) > 30)
                            {
                                $len = substr($item->name,0,30);
                                if(str_word_count($len) > 1)
                                {
                                    $product = implode(" ",(explode(' ',$len,-1)));
                                }else{
                                    $product = $len;
                                }
                                $product = $product ."...";
                            }
                        @endphp
                        {{$product}}
                    </td> 
                    <td style="background-color: #ebebeb;text-align: center;">
                        {{ $item->total_product_stock_with_remaining_delivery }}
                    </td>
                    @foreach ($item->productStockNORWhereStatusIsActive() as $productStock)
                    <td style="text-align: center;">
                        {{ number_format($productStock->available_base_stock + $productStock->reduced_base_stock_remaining_delivery,2,'.', '') }}
                    </td>
                @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$datas->links()}}
</div>