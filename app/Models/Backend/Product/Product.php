<?php

namespace App\Models\Backend\Product;

use App\Models\Backend\Price\Price;
use App\Models\Backend\Price\ProductPrice;
use App\Models\Backend\ProductAttribute\Brand;
use App\Models\Backend\ProductAttribute\Category;
use App\Models\Backend\ProductAttribute\Color;
use App\Models\Backend\ProductAttribute\ProductGrade;
use App\Models\Backend\ProductAttribute\SubCategory;
use App\Models\Backend\ProductAttribute\Unit;
use App\Models\Backend\Stock\ProductStock;
use App\Models\Backend\Stock\Stock;
use App\Models\Backend\Supplier\Supplier;
use App\Models\Backend\Warehouse\Warehouse;
use App\Models\Backend\Warehouse\WarehouseRack;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    protected $dates = ['deleted_at']; 
    
    public function brands()
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function subCategories()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id','id');
    }

    public function colors()
    {
        return $this->belongsTo(Color::class,'color_id','id');
    }

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }

    public function productGrades()
    {
        return $this->belongsTo(ProductGrade::class,'product_grade_id','id');
    }

    public function units()
    {
        return $this->belongsTo(Unit::class,'unit_id','id');
    }

    public function warehouses()
    {
        return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }

    public function warehouseRacks()
    {
        return $this->belongsTo(WarehouseRack::class,'warehouse_rack_id','id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    /*
    |---------------------------------
    | product stocks
    |---------------------------------
    */
        //total product stock. call: total_product_stock
        public function getTotalProductStockAttribute()
        {
            return ($this->productStocks()->sum('available_base_stock'));
        }

        //total product stock . call: total_product_stock_with_remaining_delivery
        public function getTotalProductStockWithRemainingDeliveryAttribute()
        {
            return number_format( ($this->productStocks()->sum('available_base_stock') + $this->productStocks()->sum('reduced_base_stock_remaining_delivery')),2,'.', '');
        }


        public function productStocks()
        {
            return $this->hasMany(ProductStock::class,'product_id','id');
        }
        public function productStocksWhereStatusIsActive()
        {
            return $this->hasMany(ProductStock::class,'product_id','id')->where('status',1);
        }

        public function productStockNORWhereStatusIsActive()
        {
            $activeStockAndProductStock = ProductStock::select("product_stocks.*",
            "stocks.id as sId","stocks.name as sName",'stocks.label',"stocks.status"
            )
            ->join("stocks","stocks.id","=","product_stocks.stock_id")
            ->where('product_stocks.product_id',$this->id)
            ->where('product_stocks.branch_id',authBranch_hh())
            ->where('product_stocks.status',1)
            ->where('stocks.status',1)
            ->orderBy('stocks.custom_serial','ASC')
            ->where('stocks.branch_id',authBranch_hh())
            ->get();
            return $activeStockAndProductStock;
        }

        public function stockNORWhereStatusIsActive()
        {
            return Stock::where('status',1)
            ->where('branch_id',authBranch_hh())
            ->whereNull('deleted_at')
            ->select('id','name','label','branch_id','deleted_at')
            ->orderBy('custom_serial','ASC')
            ->get();
        }
        public function stockNORWhereStatusIsBothActiveAndInActive()
        {
            return Stock::where('branch_id',authBranch_hh())
            ->whereNull('deleted_at')
            ->select('id','name','label','branch_id','deleted_at')
            ->orderBy('custom_serial','ASC')
            ->get();
        }

        //stockNORWhenThisStockIsNotStoreInPreviousTime
        public function stockNORWhenThidStockIsNotStoreInPreviousTime()
        {
            $stockId = ProductStock::where('branch_id',authBranch_hh())
            ->select('id','stock_id','product_id','deleted_at')
            ->where('product_id',$this->id)
            ->where('status',1)
            ->whereNull('deleted_at')
            ->pluck('stock_id')
            ->toArray();
            return Stock::where('status',1)
            ->where('branch_id',authBranch_hh())
            ->whereNull('deleted_at')
            ->select('id','label','name','branch_id','deleted_at')
            ->whereNotIn('id',$stockId)
            ->orderBy('custom_serial','ASC')
            ->get();
        }
    /*
    |---------------------------------
    | product price
    |---------------------------------
    */
        public function productPrices()
        {
            return $this->hasMany(ProductPrice::class,'product_id','id');
        }
        public function productPricesWhereStatusIsActive()
        {
            return $this->hasMany(ProductPrice::class,'product_id','id')->where('status',1);
        }

        public function productPricesNORWhereStatusIsActive()
        {
            $activePriceAndProductPrice = ProductPrice::select("product_prices.id","product_prices.price_id",
                "product_prices.stock_id","product_prices.product_id","product_prices.price","product_prices.product_stock_id",
                "prices.id as pId","prices.name as pName",'prices.label',"prices.status as pStatus"
                )
                ->join("prices","prices.id","=","product_prices.price_id")
                ->where('product_prices.product_id',$this->id)
                ->where('product_prices.branch_id',authBranch_hh())
                ->where('product_prices.status',1)
                ->where('prices.status',1)
                ->orderBy('prices.custom_serial','ASC')
                ->where('prices.branch_id',authBranch_hh())
                ->get();
            return $activePriceAndProductPrice;
        }

        public function priceNORWhereStatusIsActive()
        {
            return Price::where('status',1)
                ->where('branch_id',authBranch_hh())
                ->whereNull('deleted_at')
                ->select('id','name','label','branch_id','deleted_at')
                ->orderBy('custom_serial','ASC')
                ->get();
        }
        public function priceNORWhereStatusIsBothActiveAndInActive()
        {
            return Price::where('branch_id',authBranch_hh())
                ->whereNull('deleted_at')
                ->select('id','name','label','branch_id','deleted_at')
                ->orderBy('custom_serial','ASC')
                ->get();
        }


        //priceNORWhenThisPriceIsNotStoreInPreviousTime
        public function priceNORWhenThidPriceIsNotStoreInPreviousTime()
        {
            $priceId = ProductPrice::where('branch_id',authBranch_hh())
            ->select('id','price_id','product_id','deleted_at')
            ->where('product_id',$this->id)
            ->where('status',1)
            ->whereNull('deleted_at')
            ->pluck('price_id')
            ->toArray();
            return Price::where('status',1)
            ->where('branch_id',authBranch_hh())
            ->whereNull('deleted_at')
            ->select('id','branch_id','deleted_at')
            ->whereNotIn('id',$priceId)
            ->orderBy('custom_serial','ASC')
            ->get();
        }

        
        /**
         * only regular product prices where status is active
         * this method uses in the : all product list
         */
        public function onlyRegularProductPricesWhereStatusIsActive()
        {
            return $this->hasMany(ProductPrice::class,'product_id','id')
                ->select("product_prices.id","product_prices.price_id","product_prices.price",
                //"product_prices.stock_id","product_prices.product_id","product_prices.price","product_prices.product_stock_id",
                "prices.id as pId","prices.name as pName",'prices.label',"prices.status as pStatus"
                )
                ->join("prices","prices.id","=","product_prices.price_id")
                ->where('product_prices.branch_id',authBranch_hh())
                ->where('product_prices.status',1)
                ->where('product_prices.stock_id',regularStockId_hh())// status 1 = regular stock
                ->where('prices.status',1)
                ->orderBy('prices.custom_serial','ASC')
                ->where('prices.branch_id',authBranch_hh());
        }

        /**
         * only regular product prices where status is active
         * this method uses in the :  product edit
         */
        public function onlyRegularProductPricesWithPriceAllDataWhereStatusIsActive()
        {
            return $this->hasMany(ProductPrice::class,'product_id','id')
                ->select("product_prices.id","product_prices.price_id","product_prices.price",
                //"product_prices.stock_id","product_prices.product_id","product_prices.price","product_prices.product_stock_id",
                "prices.id as pId","prices.name as pName",'prices.label',"prices.status as pStatus",
                "prices.css_style","prices.class"
                )
                ->join("prices","prices.id","=","product_prices.price_id")
                ->where('product_prices.branch_id',authBranch_hh())
                ->where('product_prices.status',1)
                ->where('product_prices.stock_id',regularStockId_hh())// status 1 = regular stock
                ->where('prices.status',1)
                ->orderBy('prices.custom_serial','ASC')
                ->where('prices.branch_id',authBranch_hh());
        }

        /**
         * only regular product prices where status is active
         * this method uses in the :  pos - product list
         */
        public function onlyRegularProductPricesWithPriceWhereStatusIsActive()
        {
            return $this->hasMany(ProductPrice::class,'product_id','id')
                ->select("product_prices.id","product_prices.price_id","product_prices.price",
                "prices.id as pId","prices.name as pName",'prices.label',"prices.status as pStatus",
                "prices.css_style","prices.class"
                )
                ->join("prices","prices.id","=","product_prices.price_id")
                ->where('product_prices.branch_id',authBranch_hh())
                ->where('product_prices.status',1)
                ->where('product_prices.stock_id',regularStockId_hh())// status 1 = regular stock
                ->where('product_prices.price_id',regularSellId_hh())
                ->where('prices.status',1)
                ->orderBy('prices.custom_serial','ASC')
                ->where('prices.branch_id',authBranch_hh());
        }


        /**
         * this method is used in
         * product edit, productTrail in update section 
         */
        public function getTotalAvailableStockFromProductStock()
        {
           return ProductStock::where('branch_id',authBranch_hh())
            ->where('product_id',$this->id)
            ->select('available_stock')
            ->where('status',1)
            ->whereNull('deleted_at')
            ->sum('available_stock');
        }


        /**
         * this method is used in
         * product edit, productTrail in update section 
         */
        public function getTotalUsedStockFromProductStock()
        {
           return ProductStock::where('branch_id',authBranch_hh())
            ->where('product_id',$this->id)
            ->select('used_stock')
            ->where('status',1)
            ->whereNull('deleted_at')
            ->sum('used_stock');
        }

        


    /*
    |---------------------------------------------------------------------------------
    | Sell/Pos Special
    |---------------------------------------------------------------------------------
    | 
    | This section is special for 
    | sell / pos
    |
    */
        public function productStocksNORWhereStatusIsActiveWhenCreateSale()
        {
            return ProductStock::select("product_stocks.*",
            "stocks.id as sId","stocks.name as sName",'stocks.label',"stocks.status"
            )
            ->join("stocks","stocks.id","=","product_stocks.stock_id")
            ->where('product_stocks.product_id',$this->id)
            ->where('product_stocks.branch_id',authBranch_hh())
            ->where('product_stocks.status',1)
            ->where('stocks.status',1)
            ->orderBy('stocks.custom_serial','ASC')
            ->where('stocks.branch_id',authBranch_hh())
            ->get();
        }

        public function productStockWithActivePriceByProductStockIdNORWhereStatusIsActiveWhenCreateSale($product_stock_id)
        {
            return ProductStock::select("product_stocks.*",
            "stocks.id as sId","stocks.name as sName",'stocks.label',"stocks.status"
            )
            ->join("stocks","stocks.id","=","product_stocks.stock_id")
            ->where('product_stocks.product_id',$this->id)
            ->where('product_stocks.id',$product_stock_id)
            ->where('product_stocks.branch_id',authBranch_hh())
            ->where('product_stocks.status',1)
            ->where('stocks.status',1)
            ->orderBy('stocks.custom_serial','ASC')
            ->where('stocks.branch_id',authBranch_hh())
            ->first();
        }

        


    /*
    |---------------------------------------------------------------------------------
    | Sell/Pos Special
    |---------------------------------------------------------------------------------
    | 
    | This section is special for 
    | sell / pos
    |
    */




}
