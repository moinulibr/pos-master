<?php

namespace App\Http\Controllers\Backend\Purchase\Receive;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Backend\Sell\SellInvoice;
use App\Models\Backend\Sell\SellProduct;
use App\Models\Backend\Sell\SellProductStock;
use App\Models\Backend\Purchase\PurchaseInvoice;
use App\Models\Backend\Purchase\PurchaseProduct;
use App\Models\Backend\Purchase\PurchaseProductReceive;
use App\Models\Backend\Purchase\PurchaseProductStock;
use App\Models\Backend\SellDelivery\SellProductDelivery;
use App\Traits\Backend\Stock\Logical\StockChangingTrait;

class PurchaseProductReceiveController extends Controller
{
    use StockChangingTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['data']  =  PurchaseInvoice::where('id',$request->id)->first();
        $html = view('backend.purchase.receive.index',$data)->render();
        $product = view('backend.purchase.receive.product_only',$data)->render();
        return response()->json([
            'status' => true,
            'html' => $html,
            'product' => $product
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
                $rand = rand(01,99);
                $makeInvoice = 'PREL'.date("iHsymd").$rand;
                $invoiceData  =  PurchaseInvoice::where('id',$request->purchase_invoice_id)->first();
                foreach($request->checked_id as $purchase_product_stock_id)
                {
                    $this->purchaseProductStockProcessing($makeInvoice,$invoiceData, $purchase_product_stock_id, $request->input('deliverying_qty_'.$purchase_product_stock_id));
                }
                DB::commit();
            }else{
                return response()->json([
                    'status'    => false,
                    'message'   => "Please, checked minimum quantity of a item for delivery",
                    'type'      => 'error'
                ]);
            }

            $data['data']  = PurchaseInvoice::where('id',$request->purchase_invoice_id)->first();
            $product = view('backend.purchase.receive.product_only',$data)->render();
            $printRoute = route('admin.purchase.product.receive.print.product.received.invoice.wise.received.list',$makeInvoice);
            $printRouteHtml = '<a href="'.$printRoute.'" class="print" target="_blank">Print</a>';
            return response()->json([
                'status'    => true,
                'product' => $product,
                'print' => $printRouteHtml,
                'message'   => "Received submited successfully!",
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

    private function purchaseProductStockProcessing($makeInvoice,$invoiceData,$purchase_product_stock_id, $receiving_quantity)
    {
        $purchaseProductStockDetails = PurchaseProductStock::where('id',$purchase_product_stock_id)
                ->select('id','purchase_product_id','product_id','stock_id','product_stock_id','total_quantity',
                    'remaining_delivery_qty','total_delivered_qty',
                )
                ->first();

        $purchaseProduct =  PurchaseProduct::select('id','unit_id')->where('id',$purchaseProductStockDetails->purchase_product_id)->first();

        $remainingStockProcessQty = $purchaseProductStockDetails->total_quantity - $purchaseProductStockDetails->total_delivered_qty;
        
        $stockIncrementQuantity = 0;
        if($remainingStockProcessQty > 0)
        {
            if($receiving_quantity > $remainingStockProcessQty)
            {
                $stockIncrementQuantity =  $remainingStockProcessQty;
            }
            else if($receiving_quantity == $remainingStockProcessQty)
            {
                $stockIncrementQuantity = $remainingStockProcessQty;
            }
            else if($receiving_quantity < $remainingStockProcessQty)
            {
                $stockIncrementQuantity = $receiving_quantity;
            }else{
                $stockIncrementQuantity = $receiving_quantity;
            }
        }else{
            $stockIncrementQuantity = $receiving_quantity;
        }
      

        $totalDeliveredQty = (($purchaseProductStockDetails->total_delivered_qty) + $stockIncrementQuantity);
        $purchaseProductStockDetails->total_delivered_qty = $totalDeliveredQty; 
        $purchaseProductStockDetails->remaining_delivery_qty = $purchaseProductStockDetails->total_quantity - $totalDeliveredQty;
        $purchaseProductStockDetails->save();


        //reduce stock from product stock
        if($invoiceData->purchase_type == 1 && $stockIncrementQuantity > 0)
        {
            $this->stock_id_FSCT = $purchaseProductStockDetails->stock_id;
            $this->product_id_FSCT = $purchaseProductStockDetails->product_id;
            $this->stock_quantity_FSCT = $stockIncrementQuantity;
            $this->unit_id_FSCT = $purchaseProduct ? $purchaseProduct->unit_id:0;
            $this->purchaseRegularStockTypeIncrement();
        }
        //reduce stock from product stock

       return $this->purchaseProductReceiveProcess($makeInvoice,$invoiceData,$purchaseProductStockDetails,$receiving_quantity);
    }


    //purchase product receive history
    private function purchaseProductReceiveProcess($makeInvoice,$purchaseInvoice,$purchaseProductStockDetails,$receiving_quantity)
    {
        $delivery = new PurchaseProductReceive();
        $delivery->branch_id = authBranch_hh();
        $delivery->invoice_no = $makeInvoice; 
        $delivery->purchase_invoice_id = $purchaseInvoice->id; 
        $delivery->purchase_product_id = $purchaseProductStockDetails->purchase_product_id;
        $delivery->purchase_product_stock_id = $purchaseProductStockDetails->id;
        $delivery->product_id = $purchaseProductStockDetails->product_id;
        $delivery->stock_id = $purchaseProductStockDetails->stock_id;
        $delivery->product_stock_id = $purchaseProductStockDetails->product_stock_id;
        $delivery->quantity = $receiving_quantity;
        $delivery->delivery_status = 1;
        $delivery->created_by = authId_hh();
        $delivery->save();
        return $makeInvoice;
    }



    //print
    public function printPurchaseProductReceivedInvoiceWiseReceivedProductList($invoiceId)
    {
        $data['delivery_invoice'] = $invoiceId;
        $data['sellProductDelivery']  =  PurchaseProductReceive::where('invoice_no',$invoiceId)->first();
        $data['data']  =  PurchaseProductReceive::where('invoice_no',$invoiceId)->get();
        return view('backend.purchase.receive.received_print',$data);
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
