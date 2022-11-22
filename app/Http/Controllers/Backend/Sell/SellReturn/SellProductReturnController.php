<?php

namespace App\Http\Controllers\Backend\Sell\SellReturn;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Backend\Sell\SellInvoice;
use App\Models\Backend\Sell\SellProduct;
use App\Models\Backend\Sell\SellProductStock;
use App\Models\Backend\SellDelivery\SellProductDelivery;
use App\Models\Backend\SellReturn\SellReturnProduct;
use App\Models\Backend\SellReturn\SellReturnProductInvoice;
use App\Traits\Backend\Stock\Logical\StockChangingTrait;
use App\Traits\Backend\Payment\PaymentProcessTrait;
class SellProductReturnController extends Controller
{
    use StockChangingTrait, PaymentProcessTrait;

    private $invoiceTotalQuantity;
    private $invoiceTotalPayableAmount;
    private $invoiceSubtotal;
    private $invoiceTotalPurchaseAmount;
    private $invoiceTotalProfit;

    private $sellProductTotalQuantity;
    private $sellProductTotalSoldPrice;
    private $sellProductTotalPurchasePrice;
    private $sellProductTotalProfitPrice;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['data']  =  SellInvoice::where('id',$request->id)->first();
        
        $data['cashAccounts'] = cashAccounts_hh();
        $data['advanceAccounts'] = advanceAccounts_hh();
        
        $html = view('backend.sell.sell_return.index',$data)->render();
        $product = view('backend.sell.sell_return.product_only',$data)->render();
        $payment = view('backend.sell.sell_return.payment',$data)->render();
        return response()->json([
            'status' => true,
            'html' => $html,
            'product' => $product,
            'payment' => $payment,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            if((isset($request->checked_id)) && (count($request->checked_id) > 0))
            {
                $dataRequest['return_note'] = $request->return_note;
                $dataRequest['receive_note'] = $request->receive_note;
                $dataRequest['discount_amount'] = $request->return_invoice_discount_amount;
                $dataRequest['discount_type'] = $request->return_invoice_discount_type;
                $dataRequest['subtotal_before_discount'] = $request->return_invoice_subtotal_before_discount;
                $dataRequest['total_amount_after_discount'] = $request->return_invoice_total_amount_after_discount;
                $dataRequest['total_discount_amount'] = $request->return_invoice_total_discount_amount;
                $dataRequest['invoice_total_paying_amount'] = $request->invoice_total_paying_amount ?? 0 ;
                $dataRequest['customer_id'] = $request->customer_id;
                $rand = rand(01,99);
                $makeInvoice = 'SREL'.date("iHsymd").$rand;
                $invoiceData = SellInvoice::where('id',$request->sell_invoice_id)->first();
                
                $returnInvoice  = $this->sellReturnProductInvoice($makeInvoice,$invoiceData,$dataRequest);

                foreach($request->checked_id as $sell_product_stock_id)
                {
                    $this->sellProductStockChangesData($returnInvoice,$invoiceData, $sell_product_stock_id, $request->input('returning_qty_'.$sell_product_stock_id));
                }
                $this->updateSellInvoiceTable($invoiceData);

                //payment process
                if(($request->invoice_total_paying_amount ?? 0) > 0)
                {
                    //for payment processing 
                    $this->mainPaymentModuleId = getModuleIdBySingleModuleLebel_hh('Sell');
                    $this->paymentModuleId = getModuleIdBySingleModuleLebel_hh('Sell Return');
                    $this->paymentCdfTypeId = getCdfIdBySingleCdfLebel_hh('Debit');
                    $moduleRelatedData = [
                        'main_module_invoice_no' => $invoiceData->invoice_no,
                        'main_module_invoice_id' => $invoiceData->id,
                        'module_invoice_no' => $makeInvoice,
                        'module_invoice_id' => $returnInvoice->id,
                        'user_id' => $invoiceData->customer_id,//client[customer,supplier,others staff]
                    ];
                    $this->paymentProcessingRequiredOfAllRequestOfModuleRelatedData = $moduleRelatedData;
                    $this->paymentProcessingRelatedOfAllRequestData = paymentDataProcessingWhenSellingSubmitFromPos_hh($request);// $paymentAllData;
                    $this->invoiceTotalPayingAmount = $request->invoice_total_paying_amount ?? 0 ;
                    $this->processingPayment();
                }

                DB::commit();
            }else{
                return response()->json([
                    'status'    => false,
                    'message'   => "Please, checked minimum quantity of a item for return",
                    'type'      => 'error'
                ]);
            }
            $data['cashAccounts'] = cashAccounts_hh();
            $data['advanceAccounts'] = advanceAccounts_hh();
            
            $data['data']  = SellInvoice::where('id',$request->sell_invoice_id)->first();
            $product = view('backend.sell.sell_return.product_only',$data)->render();
            $payment = view('backend.sell.sell_return.payment',$data)->render();
            $printRoute = route('admin.sell.product.return.print.product.returned.invoice.wise.returned.list',$makeInvoice);
            $printRouteHtml = '<a href="'.$printRoute.'" class="print" target="_blank">Print</a>';
            return response()->json([
                'status'    => true,
                'product' => $product,
                'payment' => $payment,
                'print' => $printRouteHtml,
                'message'   => "Return submited successfully!",
                'type'      => 'success'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return response()->json([
                'status'    => false,
                'message'   => "Something went wrong fasedfdfa",
                'type'      => 'error'
            ]);
        }
    }


    //update some fields in the sell invoice table
    private function updateSellInvoiceTable($invoiceData)
    {
        $subtotal = $invoiceData->sellProducts->sum('total_sold_price');
        $totalPurchasePrice = $invoiceData->sellProducts->sum('total_purchase_price');
        
        $totalDiscountAmount = $this->getTotalDiscountAmount($subtotal,$invoiceData->discount_amount,$invoiceData->discount_type);
        $payableAmount = ($subtotal - $totalDiscountAmount) + $invoiceData->total_vat +  $invoiceData->shipping_cost + $invoiceData->others_cost; 
        
        if($invoiceData->round_type == '+')
        {
            $payableAmount = $payableAmount + $invoiceData->round_amount;
        }else{
            $payableAmount = $payableAmount - $invoiceData->round_amount;
        }
        $invoiceData->subtotal = $subtotal;
        $invoiceData->total_discount = $totalDiscountAmount;
        $invoiceData->total_payable_amount = $payableAmount;
        $invoiceData->total_purchase_amount = $totalPurchasePrice;
        $invoiceData->total_invoice_profit = (($subtotal - $totalDiscountAmount) - $totalPurchasePrice);
        $invoiceData->save();
    }


    //sell product stock table 
    private function sellProductStockChangesData($returnInvoice,$invoiceData,$sell_product_stock_id, $returningQty)
    {
        $sellProductStockDetails = SellProductStock::where('id',$sell_product_stock_id)
                ->select('id','sell_product_id','product_id','stock_id','product_stock_id','total_quantity','stock_process_instantly_qty',
                    'stock_process_instantly_qty_reduced','total_stock_processed_qty','remaining_delivery_qty','total_delivered_qty','total_stock_remaining_process_qty'
                    ,'total_return_qty','sold_price','purchase_price','total_sold_price','total_purchase_price','total_profit'
                )
                ->first();

        $sellProduct =  SellProduct::select('id','unit_id','quantity','sold_price','total_sold_price','total_purchase_price','total_profit')->where('id',$sellProductStockDetails->sell_product_id)->first();

        $totalSoldQty = $sellProductStockDetails->total_quantity;
        if($totalSoldQty > 0)
        {
            if($returningQty > $totalSoldQty)
            {
                $returningQty = $totalSoldQty;
            }
            else if($returningQty == $totalSoldQty)
            {
                $returningQty = $totalSoldQty;
            }
            else if($returningQty < $totalSoldQty)
            {
                $returningQty = $returningQty;
            }else{
                $returningQty = 0;
            }
        }else{
            $returningQty = 0;
        }
        
        //sell product stock table single single row wise data update
        $currentTotalQuantity = $sellProductStockDetails->total_quantity - $returningQty;

        //delivery and remaining delivery based on current total quantity
            $deliveredQty = 0;
            $remainingDelivertQty = 0;
            $previousDeliveredQty = $sellProductStockDetails->total_delivered_qty;
            if($currentTotalQuantity < $previousDeliveredQty)
            {
                $deliveredQty = $currentTotalQuantity;
                $remainingDelivertQty = 0;
            }
            else if($currentTotalQuantity == $previousDeliveredQty)
            {
                $deliveredQty = $currentTotalQuantity;
                $remainingDelivertQty = 0;
            }
            else if($currentTotalQuantity > $previousDeliveredQty)
            {
                $deliveredQty = $previousDeliveredQty;
                $remainingDelivertQty = $currentTotalQuantity - $previousDeliveredQty;
            }
            $sellProductStockDetails->total_delivered_qty = $deliveredQty;
            $sellProductStockDetails->remaining_delivery_qty = $remainingDelivertQty;
        //delivery and remaining delivery based on current total quantity


        $sellProductStockDetails->total_quantity = $currentTotalQuantity;
        $sellProductStockDetails->total_return_qty = $sellProductStockDetails->total_return_qty + $returningQty;
            //sold price, total_sold_price, purchase_price, total_purchase_price,total_profit, 
            $totalSoldPrice =  $sellProductStockDetails->sold_price * $currentTotalQuantity;
            $totalPurchasePrice =  $sellProductStockDetails->purchase_price * $currentTotalQuantity;
            $sellProductStockDetails->total_sold_price = $totalSoldPrice;
            $sellProductStockDetails->total_purchase_price = $totalPurchasePrice;
            $sellProductStockDetails->total_profit = $totalSoldPrice - $totalPurchasePrice;
            //sold price, total_sold_price, purchase_price, total_purchase_price,total_profit, 
        $sellProductStockDetails->save();
        //sell product stock table single single row wise data update


        //update some fields from sell product table 
            //amount calculation (in the sell product table)
            $currentQuantityOfSellProduct = $sellProduct->quantity - $returningQty;

            $subtotalSoldPriceOfSellProduct = $sellProduct->sold_price * $currentQuantityOfSellProduct;

            $totalDiscountAmountOfSellProduct = $this->getTotalDiscountAmount($subtotalSoldPriceOfSellProduct,$sellProduct->discount_amount,$sellProduct->discount_type);

            $sellProduct->total_discount = $totalDiscountAmountOfSellProduct;
            $totalSoldPriceOfSellProduct = $subtotalSoldPriceOfSellProduct - $totalDiscountAmountOfSellProduct;
            $sellProduct->total_sold_price = $totalSoldPriceOfSellProduct;

            $purchasePriceFromSellProductStock = $sellProductStockDetails->purchase_price;
            $totalPurchasePriceFromSellProductStock = $purchasePriceFromSellProductStock * $currentQuantityOfSellProduct;

            $sellProduct->total_purchase_price = $totalPurchasePriceFromSellProductStock;
            $sellProduct->total_profit =  $totalSoldPriceOfSellProduct - $totalPurchasePriceFromSellProductStock;
            //amount calculation

            //sell product table
            $sellProduct->quantity = $sellProduct->quantity - $returningQty;
            $sellProduct->save();
            //sell product table
        //update some fields from sell product table 


        //sell invoice
        //sell product table
        $invoiceData->total_quantity = $invoiceData->total_quantity - $returningQty;
        $invoiceData->save();
        //sell invoice
        
        //base stock increment quantity
            $baseStockIncrementQuantity = 0;
            if($deliveredQty == $returningQty && $deliveredQty > 0)
            {
                $baseStockIncrementQuantity = $returningQty;
            }
            else if($deliveredQty > $returningQty && $deliveredQty > 0)
            {
                $baseStockIncrementQuantity = $returningQty;
            }
            else if($deliveredQty < $returningQty && $deliveredQty > 0)
            {
                $baseStockIncrementQuantity = $deliveredQty;
            }
            else if($deliveredQty == 0)
            {
                $baseStockIncrementQuantity = 0;
            }
        //base stock increment quantity
            
        //increment stock from product stock
        if($invoiceData->sell_type == 1 && $returningQty > 0 && $baseStockIncrementQuantity > 0)
        {
            $this->stock_id_FSCT = $sellProductStockDetails->stock_id;
            $this->product_id_FSCT = $sellProductStockDetails->product_id;
            $this->stock_quantity_FSCT = $baseStockIncrementQuantity;
            $this->unit_id_FSCT = $sellProduct ? $sellProduct->unit_id:0;
            $this->sellingReturnStockTypeIncrement();
        }
        //increment stock from product stock

        return $this->sellReturnProductStore($returnInvoice,$invoiceData,$sellProductStockDetails,$returningQty);
    }


    //get Total Discount amount
    private function getTotalDiscountAmount($totalAmount,$discount_amount,$discount_type)
    {
        $discountAmount = 0;
        if($discount_amount == 'fixed')
        {
            $discountAmount = $discount_amount;
        }else{
            $discountAmount = (($totalAmount * $discount_amount) / 100);
        }
        return  $discountAmount;
    }

  


    //sell return product invoice
    private function sellReturnProductInvoice($makeInvoice,$sellInvoiceData,$dataRequest)
    {
        $returnInvoice = new SellReturnProductInvoice();
        $returnInvoice->branch_id = authBranch_hh();
        $returnInvoice->invoice_no = $makeInvoice;
        $returnInvoice->sell_invoice_no = $sellInvoiceData->invoice_no;
        $returnInvoice->sell_invoice_id = $sellInvoiceData->id;
        $returnInvoice->customer_id = $dataRequest['customer_id'];
        //$returnInvoice->quantity = $makeInvoice;
        $returnInvoice->subtotal_before_discount = $dataRequest['subtotal_before_discount'];
        $returnInvoice->discount_amount = $dataRequest['discount_amount'];
        $returnInvoice->discount_type = $dataRequest['discount_type'];
        $returnInvoice->total_discount = $dataRequest['total_discount_amount'];
        $returnInvoice->total_amount_after_discount = $dataRequest['total_amount_after_discount'];
        $returnInvoice->total_payable_amount = $dataRequest['total_amount_after_discount'];
        $returnInvoice->return_note = $dataRequest['return_note'];
        $returnInvoice->receive_note = $dataRequest['receive_note'];

        $returnInvoice->paid_amount	 = $dataRequest['invoice_total_paying_amount'];
        $returnInvoice->due_amount	 = $dataRequest['total_amount_after_discount'] - $dataRequest['invoice_total_paying_amount'];
       
        $returnInvoice->return_date = date('Y-m-d');
        $returnInvoice->created_by = authId_hh();
        $returnInvoice->save();
        return $returnInvoice;
    }

    //sell return product
    private function sellReturnProductStore($returnInvoice,$sellInvoice,$sellProductStockDetails,$returningQty)
    {
        $returnProduct = new SellReturnProduct();
        $returnProduct->branch_id = authBranch_hh();
        $returnProduct->sell_return_product_invoice_id = $returnInvoice->id; 
        $returnProduct->sell_invoice_id = $sellInvoice->id; 
        $returnProduct->sell_product_id = $sellProductStockDetails->sell_product_id;
        $returnProduct->sell_product_stock_id = $sellProductStockDetails->id;
        $returnProduct->product_id = $sellProductStockDetails->product_id;
        $returnProduct->stock_id = $sellProductStockDetails->stock_id;
        $returnProduct->product_stock_id = $sellProductStockDetails->product_stock_id;
        $returnProduct->quantity = $returningQty;
        $returnProduct->sell_price = $sellProductStockDetails->sold_price;
        $returnProduct->total_sell_price = $sellProductStockDetails->sold_price * $returningQty;
        $returnProduct->delivery_status = 1;
        $returnProduct->created_by = authId_hh();
        $returnProduct->save();
        return $returnProduct;
    }


   


    //print
    public function printSellReturnProducInvoiceWisedProductList($invoiceId)
    {
        $data['delivery_invoice'] = $invoiceId;
        $data['sellProductDelivery']  =  SellReturnProductInvoice::where('invoice_no',$invoiceId)->first();
        $data['data']  =  SellReturnProductInvoice::where('invoice_no',$invoiceId)->get();
        return view('backend.sell.sell_return.print',$data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
