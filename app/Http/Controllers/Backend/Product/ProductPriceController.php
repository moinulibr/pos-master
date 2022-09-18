<?php

namespace App\Http\Controllers\Backend\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Price\Price;
use App\Models\Backend\Price\ProductPrice;
use App\Models\Backend\Product\Product;
use App\Models\Backend\Stock\ProductStock;

class ProductPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['product'] = Product::findOrFail($request->id);
        $html = view('backend.product.product-price.update_price',$data)->render();
        return response()->json([
            'status' => true,
            'data' => $html
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
        foreach($request->stocks as $stockId)
        {
            foreach($request->prices as $priceId)
            {
                //check product stock is exist or not,
                    //if not exist, then add in the product stock table 
                $podctStock = ProductStock::where('stock_id',$stockId)   
                    ->where('product_id',$request->product_id)
                    ->where('branch_id',authBranch_hh()) 
                    ->where('status',1)
                    ->first();

                $exitProuctStockId = NULL;
                if($podctStock)
                {
                    $exitProuctStockId = $podctStock->id;
                }
                $newProductStockId = NULL;
                if(!$podctStock)
                {
                    $nps = new ProductStock();
                    $nps->product_id        = $request->product_id;
                    $nps->branch_id         = authBranch_hh();
                    $nps->stock_id          = $stockId;
                    $nps->status            = 1;
                    $nps->available_base_stock = 0;
                    $nps->used_stock        = 0;
                    $nps->used_base_stock   = 0;
                    $nps->used_base_stock   = 0;
                    $nps->save();
                    $newProductStockId = $nps->id;
                } 

                $podctPrice = ProductPrice::where('stock_id',$stockId)   
                    ->where('product_id',$request->product_id)
                    ->where('price_id',$priceId)
                    ->where('stock_id',$stockId)
                    ->where('branch_id',authBranch_hh()) 
                    ->where('status',1)
                    ->first();
                if($podctPrice)
                {
                    $podctPrice->price = $request->input('p_'.$priceId."_s_".$stockId);
                    $podctPrice->save();
                }
                else{
                    $npp = new ProductPrice();
                    $npp->product_id    = $request->product_id;
                    $npp->branch_id     = authBranch_hh();
                    $npp->price_id      = $priceId;
                    $npp->stock_id      = $stockId;
                    $npp->product_stock_id = $exitProuctStockId ? $exitProuctStockId : $newProductStockId;
                    $npp->price         = $request->input('p_'.$priceId."_s_".$stockId);
                    $npp->status        = 1;
                    $npp->save();
                }
                
            }//end foreach
        }//end foreach
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Product price updated successfully"
        ]);
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
