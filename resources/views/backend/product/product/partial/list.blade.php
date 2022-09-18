<div class="table-responsive">
    <table class="table table-bordered mb-0" style="font-size: 13px;">
        <thead>
            <tr>
                <th  style="width:3%;">#</th>
                <td style="width:3%;">Action</td>
                <th>Photo</th>
                <th>Name</th>
                <th>
                    <small>AS Code</small>
                </th>
                <th>Category</th>
                <th>Grade</th>
                <th>Stock</th>
                @foreach ($prices as $price)
                    <th>{{$price->label}}</th>
                @endforeach
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
                            <button type="button" class="btn btn-sm btn-see-more-action" data-toggle="dropdown" aria-expanded="true">
                                <i class="fas fa-ellipsis-h"></i>
                                {{-- <i class="fas fa-cogs"></i> --}}
                            </button>
                            <div class="dropdown-menu " x-placement="top-start" style="position: absolute; will-change: top, left; top: -183px; left: 0px;">
                                <a class="dropdown-item singleShowModal" data-id="{{$item->id}}"  href="javascript:void(0)">View</a>
                                <a class="dropdown-item singleEditModal" data-id="{{$item->id}}" href="javascript:void(0)">Edit</a>
                                <a class="dropdown-item singlePriceEditModal" data-id="{{$item->id}}" href="javascript:void(0)">Edit Price</a>
                                <a class="dropdown-item singleDeleteModal" data-id="{{$item->id}}" data-name="{{$item->name}}" href="javascript:void(0)">Delete</a>
                                {{-- <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)">Separated link</a>
                            </div> --}}
                        </div>
                    </td>
                    <td>
                        {{-- @if(Storage::disk('public')->exists("storage/backend/product/product/{$item->id}.",$item->photo)) --}}
                        <span style="cursor:pointer;" class="singleShowModal" data-id="{{$item->id}}" href="javascript:void(0)">
                            @if($item->photo)
                                <img src="{{ asset(productImageViewLocation_hh().$item->id.".".$item->photo) }}" alt="" width="40" height="40" style="padding:2px;border:1px solid #c7bbbb;background-color:#fbf8f8;border-radius:4px">
                                @else
                                <img src="{{ asset(defaultProductImageUrl_hh()) }}" alt="" width="40" height="40" style="padding:2px;border:1px solid #c7bbbb;background-color:#fbf8f8;border-radius:4px">
                            @endif
                        </span>
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
                    <td>
                        <small>
                            {{ $item->custom_code }}
                        </small>
                    </td> 
                    <td>
                        <small>
                        {{$item->categories ? $item->categories->name : ""}}
                        </small>
                    </td>
                    <td>
                        <small>
                        {{$item->productGrades ? $item->productGrades->name : ""}}
                        </small>
                    </td> 
                    <td>
                        <strong>
                        {{ $item->total_product_stock }}
                        </strong>
                    </td> 

                    @foreach ($item->onlyRegularProductPricesWhereStatusIsActive as $pp)    
                    <td>
                        <small>
                        {{$pp->price}}
                        </small>
                    </td>
                    @endforeach

                </tr>
            @endforeach
        </tbody>
    </table>
    {{$datas->links()}}
</div>