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
use App\Traits\Backend\Stock\Logical\StockChangingTrait;

class SellProductReturnController extends Controller
{
    use StockChangingTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['data']  =  SellInvoice::where('id',$request->id)->first();
        $html = view('backend.sell.sell_return.index',$data)->render();
        $product = view('backend.sell.sell_return.product_only',$data)->render();
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
                $makeInvoice = 'SDEL'.date("iHsymd").$rand;
                $invoiceData  =  SellInvoice::where('id',$request->sell_invoice_id)->first();
                foreach($request->checked_id as $sell_product_stock_id)
                {
                    $this->sellProductStockProcessing($makeInvoice,$invoiceData, $sell_product_stock_id, $request->input('deliverying_qty_'.$sell_product_stock_id));
                }
                DB::commit();
            }else{
                return response()->json([
                    'status'    => false,
                    'message'   => "Please, checked minimum quantity of a item for delivery",
                    'type'      => 'error'
                ]);
            }
            $data['data']  = SellInvoice::where('id',$request->sell_invoice_id)->first();
            $product = view('backend.sell.delivery.product_only',$data)->render();
            $printRoute = route('admin.sell.product.delivery.print.product.delivered.invoice.wise.delivered.list',$makeInvoice);
            $printRouteHtml = '<a href="'.$printRoute.'" class="print" target="_blank">Print</a>';
            return response()->json([
                'status'    => true,
                'product' => $product,
                'print' => $printRouteHtml,
                'message'   => "Delivery submited successfully!",
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

    private function sellProductStockProcessing($makeInvoice,$invoiceData,$sell_product_stock_id, $deliverying_quantity)
    {
        $sellProductStockDetails = SellProductStock::where('id',$sell_product_stock_id)
                ->select('id','sell_product_id','product_id','stock_id','product_stock_id','total_quantity','stock_process_instantly_qty',
                    'stock_process_instantly_qty_reduced','total_stock_processed_qty','remaining_delivery_qty','total_delivered_qty','total_stock_remaining_process_qty'
                )
                ->first();

        $sellProduct =  SellProduct::select('id','unit_id')->where('id',$sellProductStockDetails->sell_product_id)->first();

       
        $remainingStockProcessInstantlyQty = $sellProductStockDetails->stock_process_instantly_qty - $sellProductStockDetails->stock_process_instantly_qty_reduced;
        
        $stockReduceFromMainBaseStock = 0;
        $stockReduceFromRemainingDelivery = 0;
        if($remainingStockProcessInstantlyQty > 0)
        {
            if($deliverying_quantity > $remainingStockProcessInstantlyQty)
            {
                $stockReduceFromMainBaseStock = $deliverying_quantity - $remainingStockProcessInstantlyQty;
                $stockReduceFromRemainingDelivery = $remainingStockProcessInstantlyQty;
            }
            else if($deliverying_quantity == $remainingStockProcessInstantlyQty)
            {
                $stockReduceFromMainBaseStock = $deliverying_quantity - $remainingStockProcessInstantlyQty;
                $stockReduceFromRemainingDelivery = $remainingStockProcessInstantlyQty;
            }
            else if($deliverying_quantity < $remainingStockProcessInstantlyQty)
            {
                $stockReduceFromMainBaseStock = 0;
                $stockReduceFromRemainingDelivery = $deliverying_quantity;
            }else{
                $stockReduceFromMainBaseStock = $deliverying_quantity;
                $stockReduceFromRemainingDelivery = 0;
            }
        }else{
            $stockReduceFromMainBaseStock = $deliverying_quantity;
            $stockReduceFromRemainingDelivery = 0;
        }
      
        $totalDeliveredQty = (($sellProductStockDetails->total_delivered_qty) + $deliverying_quantity);

        $sellProductStockDetails->total_delivered_qty = $totalDeliveredQty; 
        $sellProductStockDetails->remaining_delivery_qty = $sellProductStockDetails->total_quantity - $totalDeliveredQty;
       
        $sellProductStockDetails->stock_process_instantly_qty_reduced += $stockReduceFromRemainingDelivery;
        $sellProductStockDetails->save();

        $productStock = productStockByProductStockId_hh($sellProductStockDetails->product_stock_id);
        if($productStock &&  $stockReduceFromRemainingDelivery)
        {
            $productStock->reduced_base_stock_remaining_delivery = (($productStock->reduced_base_stock_remaining_delivery) - $stockReduceFromRemainingDelivery);
            $productStock->save();
        }

        /* if($productStock &&   $stockReduceFromMainBaseStock > 0)
        {
            $productStock->available_base_stock = (($productStock->available_base_stock) - $stockReduceFromMainBaseStock);
            //$productStock->save();
        } */

        //reduce stock from product stock
        if($invoiceData->sell_type == 1 && $stockReduceFromMainBaseStock > 0)
        {
            $this->stock_id_FSCT = $sellProductStockDetails->stock_id;
            $this->product_id_FSCT = $sellProductStockDetails->product_id;
            $this->stock_quantity_FSCT = $stockReduceFromMainBaseStock;
            $this->unit_id_FSCT = $sellProduct ? $sellProduct->unit_id:0;
            $this->sellingFromPossStockTypeDecrement();
        }
        //reduce stock from product stock

       return $this->sellProductDeliveryProcess($makeInvoice,$invoiceData,$sellProductStockDetails,$deliverying_quantity);
    }

    private function sellProductDeliveryProcess($makeInvoice,$sellInvoice,$sellProductStockDetails,$deliverying_quantity)
    {
        $delivery = new SellProductDelivery();
        $delivery->branch_id = authBranch_hh();
        $delivery->invoice_no = $makeInvoice; 
        $delivery->sell_invoice_id = $sellInvoice->id; 
        $delivery->sell_product_id = $sellProductStockDetails->sell_product_id;
        $delivery->sell_product_stock_id = $sellProductStockDetails->id;
        $delivery->product_id = $sellProductStockDetails->product_id;
        $delivery->stock_id = $sellProductStockDetails->stock_id;
        $delivery->product_stock_id = $sellProductStockDetails->product_stock_id;
        $delivery->quantity = $deliverying_quantity;
        $delivery->delivery_status = 1;
        $delivery->created_by = authId_hh();
        $delivery->save();
        return $makeInvoice;
    }

    //print
    public function printSellProductDeliveredInvoiceWiseDeliveredProductList($invoiceId)
    {
        $data['delivery_invoice'] = $invoiceId;
        $data['sellProductDelivery']  =  SellProductDelivery::where('invoice_no',$invoiceId)->first();
        $data['data']  =  SellProductDelivery::where('invoice_no',$invoiceId)->get();
        return view('backend.sell.delivery.delivered_print',$data);
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
