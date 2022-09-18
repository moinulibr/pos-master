<style>
    .hovereffect {
        width: 100%;
        height: 100%;
        float: left;
        overflow: hidden;
        position: relative;
        text-align: center;
        cursor: pointer;
    }
    .hovereffect .overlay {
        width: 100%;
        position: absolute;
        overflow: hidden;
        left: 0;
        top: 70px;
        bottom: 0;
        padding: 5px;
        height: 4.75em;
        background: #79fac4;
        color: #3c4a50;
        -webkit-transition: -webkit-transform 0.35s;
        transition: transform 0.35s;
        -webkit-transform: translate3d(0, 100%, 0);
        transform: translate3d(0, 100%, 0);
        visibility: hidden;
    }
    .hovereffect h4 {
        color: #fff;
        text-align: center;
        position: relative;
        font-size: 10px;
        padding: 5px;
        background: rgba(0, 0, 0, 0.6);
        margin: 0px;
        display: inline-block;
    }
    .hovereffect h4,
    .hovereffect p.icon-links a {
        -webkit-transition: -webkit-transform 0.35s;
        transition: transform 0.35s;
        -webkit-transform: translate3d(0, 200%, 0);
        transform: translate3d(0, 200%, 0);
        visibility: visible;
    }
    .hovereffect:hover .overlay,
    .hovereffect:hover h4,
    .hovereffect:hover p.icon-links a {
        -webkit-transform: translate3d(0, 0, 0);
        transform: translate3d(0, 0, 0);
    }

    .hovereffect:hover h4 {
        -webkit-transition-delay: 0.05s;
        transition-delay: 0.05s;
    }
</style>

    {{-- <div style="width:100%;background-color:red;height:100%;margin-left:-10px;margin-right:-30px;margin-top:20px;">
    </div> --}}
    <div class="row" style="margin-top:20px;">
        @foreach ($products as $item)    
            <div class="col-lg-4 col-md-4 col-sm-4 col-6" style="border-bottom:5px solid #ffffff;border-right:2px solid #ffffff;border-left:2px solid #ffffff;border-top:5px solid #ffffff;margin-bottom: 10px;padding-top: 10px;">
                <div class="productDetails productCard hovereffect"  data-id="{{$item->id}}"> {{--data-toggle="modal" data-target="#product-details"--}}
                    <div class="productThumb" style="border:5px solid #6e6d6d;">
                        @if($item->photo)
                            <img  src="{{ asset(productImageViewLocation_hh().$item->id.".".$item->photo) }}" alt=""class="img-fluid"  style="padding:2px;border:1px solid #c7bbbb;background-color:#fbf8f8;border-radius:4px">
                            @else
                            <img  src="{{ asset(defaultProductImageUrl_hh()) }}" alt="" class="img-fluid"  style="padding:2px;border:1px solid #c7bbbb;background-color:#fbf8f8;border-radius:4px">
                        @endif
                        {{-- <img class="img-fluid" src="assets/images/carousel/element-banner2-right.jpg" alt="ix" /> --}}
                        <div class="overlay">
                            <h4>
                                @foreach ($item->onlyRegularProductPricesWithPriceWhereStatusIsActive as $prices)
                                    
                                Price: Tk {{ $prices->price }} <br />
                                @endforeach
                                Stock: {{ $item->available_base_stock ?? 0 }}
                            </h4>
                        </div>
                    </div>
                    <div class="productContent" style="margin-top:0px;">
                        <a href="#" class="productDetails"  data-id="{{$item->id}}">
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
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-12">
            {{ $products->links() }}
        </div>
    </div>

    {{-- <div class="row">
        <div class="col-md-4">
            Showing {{$products->count()}} from {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() }} of {{ $products->total() }}  entries 
        </div>
        <div class="col-md-8">
            <div style="float: right">
            {{ $products->links() }}
            </div>
        </div>
    </div> --}}
    