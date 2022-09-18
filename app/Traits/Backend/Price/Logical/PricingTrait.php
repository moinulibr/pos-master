<?php
namespace App\Traits\Backend\Price\Logical;

use App\Models\Backend\Price\Price;
use App\Models\Backend\Price\ProductPrice;
use App\Models\Backend\Stock\ProductStock;
use App\Models\Backend\Stock\Stock;
use Illuminate\Support\Facades\Auth;


/**
 * pricing trait
 * 
 */
trait PricingTrait
{
    //fsct == for pricing trait
    protected $stock_id_FPT;
    protected $product_stock_id_FPT;
    protected $product_id_FPT;
    protected $unit_id_FPT;

    protected $productPrices_FPT;

    private $authId_FPT;
    private $authBranchId_FPT;

    
    /**
     * insert price in the product price table
     * when product create only
     * 
     */
    private function insertPriceInTheProductPrice()
    {
        $this->stock_id_FPT     = NULL;
        $this->authBranchId_FPT = Auth::guard('web')->user()->id ;
        $this->authId_FPT       = Auth::guard('web')->user()->branch_id;
        foreach($this->getProductStockByProductAndStockId() as $stockProduct)
        {
            foreach($this->productPrices_FPT as $index => $pprice)
            {
                $priceLabel         = $this->getSinglePriceById($index);
                $price              = new ProductPrice();
                $price->branch_id   = authBranch_hh();
                $price->product_id  = $this->product_id_FPT;
                $price->price_id    = $priceLabel?$priceLabel->id:"";
                $price->stock_id    = $stockProduct->stock_id;
                $price->product_stock_id = $stockProduct->id;
                $price->price       = $pprice;
                $price->status      = 1;
                $price->created_by  = $this->authId_FPT;
                $price->save();
            }  
        }
        return true;
        // branch_id, product_id , price_id, stock_id
        // product_stock_id, price ,status, 
    }





    /**
     * get array formated single stock id by stock id
     * 
     */
    private function getArrayFormatedSingleStockIdByStockId()
    {
        return Stock::where('id',$this->stock_id_FPT)
        ->where('branch_id',authBranch_hh())
        ->select('id','branch_id','deleted_at')
        ->pluck('id')
        ->toArray();
    }

   
    /**
     * get array formated all stock ids
     * 
     */
    private function getArrayFormatedAllStockIds()
    {
        return  Stock::where('status',1)
        ->where('branch_id',authBranch_hh())
        ->whereNull('deleted_at')
        ->select('id','branch_id','deleted_at')
        ->pluck('id')
        ->toArray();
    }

    
    /**
     * get array formated all stock ids 
     * where status is only active
     */
    private function getArrayFormatedAllStockIdsWhereStatusIsActive()
    {
        return  Stock::where('status',1)
        ->where('branch_id',authBranch_hh())
        ->whereNull('deleted_at')
        ->select('id','branch_id','deleted_at')
        ->pluck('id')
        ->toArray();
    }


    /** not using this
     * get array formated all stock ids 
     * where status is active and in-active
     */
    /* private function getArrayFormatedAllStockIdsWhereStatusIsActiveAndInActive()
    {
        return  Stock::where('branch_id',authBranch_hh())
        ->whereNull('deleted_at')
        ->select('id','branch_id','deleted_at')
        ->pluck('id')
        ->where('status',1)
        ->toArray();
    } */



    /**
     * get product stock by product id
     * when product create and update
     * 
     */
    private function getProductStockByProductAndStockId()
    {
        if($this->stock_id_FPT)
        {
            $stockIds = $this->getArrayFormatedSingleStockIdByStockId();
        }else{
            $stockIds = $this->getArrayFormatedAllStockIds();
        }
        return ProductStock::where('branch_id',authBranch_hh())
        ->where('product_id',$this->product_id_FPT)
        ->select('id','stock_id','product_id','deleted_at')
        ->whereIn('stock_id',$stockIds)
        ->where('status',1)
        ->whereNull('deleted_at')
        ->get();
    }


    /**
     * get single price by price id
     *
     * @param [type] $id
     */
    private function getSinglePriceById($id)
    {
        return Price::where('id',$id)->first();
    }
    /**
     * get Single Price By Price name
     *
     * @param [type] $name
     */
    private function getSinglePriceByPriceName($name)
    {
        return Price::where('name',$name)->first();
    }
    








    /*
    |----------------------------------------------------------------------------------
    | when product update from product update option 
    |----------------------------------------------------
    |
    */
        /**
         * product price udpate when product update 
         * 
         * @param [type] $priceData
         * @param [type] $productId
         */
        protected function productPriceUpdateWhenProductUpdate($priceData , $productId)
        {
            foreach($priceData as $pPId =>  $price)
            {
                ProductPrice::where('id',$pPId)
                ->where('product_id',$productId)
                ->update([
                    'price' => $price
                ]);
            }
            return true;
        }
    /*
    |----------------------------------------------------
    | when product update from product update option 
    |----------------------------------------------------
    |
    */

    
    /** not using this 
    * update price in the product price table
    * when product update only
    * 
    */
        /* 
            private function updatePriceInTheProductPrice()
            {
                $this->stock_id_FPT     = 1;
                $this->authBranchId_FPT = Auth::guard('web')->user()->id ;
                $this->authId_FPT       = Auth::guard('web')->user()->branch_id;
                foreach($this->getProductStockByProductAndStockId() as $stockProduct)
                {
                    foreach($this->productPrices_FPT as $index => $pprice)
                    {
                        $priceLabel = $this->getSinglePriceById($index);
                        if($priceLabel)
                        {
                            $price = ProductPrice::where('branch_id',authBranch_hh())
                                    ->where('product_id',$this->product_id_FPT)    
                                    ->where('price_id',$priceLabel->id) 
                                    ->where('stock_id',$stockProduct->stock_id) 
                                    ->where('product_stock_id',$stockProduct->id) 
                                    ->first();
                            $price->price = $pprice;
                            $price->save();
                        }
                    }  
                }
                return true;
            } 
        */



}
