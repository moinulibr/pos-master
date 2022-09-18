<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="keywords" content="ebaskat">
        <meta name="author" content="GeniusOcean">

        <title>eBaskat Admin Panel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('backend/print/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('backend/print/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('backend/print/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend/print/css/style.css')}}">
  <link href="{{asset('backend/print/css/print.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        <link rel="icon" type="image/png" href="{{asset('backend/images/favicon.ipg')}}"> 
  <style type="text/css">
@page { size: auto;  margin: 0mm; }
@page {
  size: A4;
  margin: 0;
}
@media print {
  html, body {
    width: 210mm;
    height: 287mm;
  }

html {

}
::-webkit-scrollbar {
    width: 0px;  /* remove scrollbar space */
    background: transparent;  /* optional: just make scrollbar invisible */
}
  </style>
</head>
<body onload="window.print();">
    <div class="invoice-wrap">
            <div class="invoice__title">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="invoice__logo text-left">
                            <img src="{{ asset('assets/images/e-basket.png') }}" alt="eBaskat">
                        </div>
                    </div>
                </div>
            </div>

            <br>
            /* <div class="invoice__metaInfo">
                <div class="col-lg-6">
                    <div class="invoice__orderDetails">
                        
                        <p><strong>{{ __('Order Details') }} </strong></p>
                        <span><strong>{{ __('Invoice Number') }} :</strong> {{ sprintf("%'.08d", $order->id) }}</span><br>
                        <span><strong>{{ __('Order Date') }} :</strong> {{ date('d-M-Y',strtotime($order->created_at)) }}</span><br>
                        <span><strong>{{  __('Order ID')}} :</strong> {{ $order->order_number }}</span><br>
                        @if($order->dp == 0)
                        <span> <strong>{{ __('Shipping Method') }} :</strong>
                            @if($order->shipping == "pickup")
                            {{ __('Pick Up') }}
                            @else
                            {{ __('Ship To Address') }}
                            @endif
                        </span><br>
                        @endif
                        <span> <strong>{{ __('Payment Method') }} :</strong> {{$order->method}}</span>
                    </div>
                </div>
            </div>

            <div class="invoice__metaInfo" style="margin-top:0px;">
                @if($order->dp == 0)
                <div class="col-lg-6">
                        <div class="invoice__orderDetails" style="margin-top:5px;">
                            <p><strong>{{ __('Shipping Details') }}</strong></p>
                           <span><strong>{{ __('Customer Name') }}</strong>: {{ $order->shipping_name == null ? $order->customer_name : $order->shipping_name}}</span><br>
                           <span><strong>{{ __('Address') }}</strong>: {{ $order->shipping_address == null ? $order->customer_address : $order->shipping_address }}</span><br>
                           <span><strong>{{ __('City') }}</strong>: {{ $order->shipping_city == null ? $order->customer_city : $order->shipping_city }}</span><br>
                           <span><strong>{{ __('Country') }}</strong>: {{ $order->shipping_country == null ? $order->customer_country : $order->shipping_country }}</span>
                        </div>
                </div>
                @endif
                <div class="col-lg-6" style="width:50%;">
                        <div class="invoice__orderDetails" style="margin-top:5px;">
                            <p><strong>{{ __('Billing Details') }}</strong></p>
                            <span><strong>{{ __('Customer Name') }}</strong>: {{ $order->customer_name}}</span><br>
                            <span><strong>{{ __('Address') }}</strong>: {{ $order->customer_address }}</span><br>
                            <span><strong>{{ __('City') }}</strong>: {{ $order->customer_city }}</span><br>
                            <span><strong>{{ __('Country') }}</strong>: {{ $order->customer_country }}</span>
                        </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="invoice_table">
                    <div class="mr-table">
                        <div class="table-responsive">
                            <table id="example2" class="table table-hover dt-responsive" cellspacing="0"
                                width="100%">
                                <thead style="border-top:1px solid rgba(0, 0, 0, 0.1) !important;">
                                    <tr>
                                        <th>{{ __('Package Number') }}</th>
                                        <th>{{ __('Product') }}</th>
                                        <th>{{ __('Details') }}</th>
                                        <th>{{ __('Total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $subtotal = 0;
                                    $tax = 0;
                                    @endphp
                                
                                    @foreach($order->merchantPckages as $package)
                                        @foreach($package->orderProducts as $product)
                                        @php 
                                            $productName = json_decode($product->cart);
                                            $user = App\Models\User::find($package->merchant_id);
                                        @endphp
                                            <tr>
                                                <td>{{ $package->order_package_number }}</td>
                                                <td>{{ $productName->productName }}
                                                </td>
                                                <td>
                                                    Qty: {{ $product->product_quantity }} <br>
                                                    Color: {{ $productName->productColor ?? NULL }}
                                                </td>
                                                <td>{{ $subtotals = $product->product_quantity * $product->per_product_price }}</td>
                                            </tr>
                                            @php $subtotal += $subtotals; @endphp
                                        @endforeach
                                    @endforeach


                                    <tr class="semi-border">
                                        <td colspan="2"></td>
                                        <td><strong>{{ __('Subtotal') }}</strong></td>
                                        <td>{{$order->currency_sign}}{{ number_format($subtotal ,2, '.', '') }}</td>

                                    </tr>
                                    @if($order->shipping_cost != 0)
                                    @php 
                                    $price = number_format(($order->shipping_cost / $order->currency_value),2, '.', '');
                                    @endphp
                                        @if(DB::table('shippings')->where('price','=',$price)->count() > 0)
                                        <tr class="no-border">
                                            <td colspan="1"></td>
                                            <td><strong>{{ DB::table('shippings')->where('price','=',$price)->first()->title }}({{$order->currency_sign}})</strong></td>
                                            <td>{{ number_format($order->shipping_cost ,2, '.', '') }}</td>
                                        </tr>
                                        @endif
                                    @endif

                                    @if($order->packing_cost != 0)
                                    @php 
                                    $pprice = number_format(($order->packing_cost / $order->currency_value),2, '.', '');
                                    @endphp
                                    @if(DB::table('packages')->where('price','=',$pprice)->count() > 0)
                                    <tr class="no-border">
                                        <td colspan="2"></td>
                                        <td><strong>{{ DB::table('packages')->where('price','=',$pprice)->first()->title }}({{$order->currency_sign}})</strong></td>
                                        <td>{{ number_format($order->packing_cost ,2, '.', '') }}</td>
                                    </tr>
                                    @endif
                                    @endif

                                    @if($order->tax != 0)
                                    <tr class="no-border">
                                        <td colspan="1"></td>
                                        <td><strong>{{ __('TAX') }}({{$order->currency_sign}})</strong></td>

                                        @php
                                        $tax = ($subtotal / 100) * $order->tax;
                                        @endphp

                                        <td>{{number_format($tax ,2, '.', '')}}</td>
                                    </tr>

                                    @endif
                                    @if($order->coupon_discount != null)
                                    <tr class="no-border">
                                        <td colspan="2"></td>
                                        <td><strong>{{ __('Coupon Discount') }}({{$order->currency_sign}})</strong></td>
                                        <td>€{{number_format($order->coupon_discount ,2, '.', '')}}</td>
                                    </tr>
                                    @endif
                                    <tr class="final-border">
                                        <td colspan="2"></td>
                                        <td><strong>{{ __('Total') }}</strong></td>
                                        <td>€{{$order->currency_sign}}{{ number_format($order->pay_amount * $order->currency_value ,2, '.', '') }}
                                        </td>
                                    </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div> */

        </div>

<script type="text/javascript">
setTimeout(function () {
        window.close();
      }, 500);
</script>

</body>
</html>