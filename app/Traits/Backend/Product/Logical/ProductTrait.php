<?php
namespace App\Traits\Backend\Product\Logical;

use App\Models\Backend\Price\ProductPrice;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Models\Backend\Product\Product;
use App\Traits\Backend\FileUpload\FileUploadTrait;
use App\Setting\Backend\Product\ProductSetting;

use App\Traits\Backend\Stock\Logical\StockChangingTrait;
use App\Traits\Backend\Price\Logical\PricingTrait;

 /**
  * 
  */
 trait ProductTrait
 {
    use FileUploadTrait;
    use ProductSetting;
    use StockChangingTrait;
    use PricingTrait;
    /**
     * Its containt product mainid
     * @var integer
     */
    public int $productId;


    public function getProductByProductId()
    {
        return "ye";
        $data['status'] = false;
        if($this->unitId > 0)
        {
            $data['unit'] = Product::find($this->unitId);
            if($data['unit'])
            {
                $data['status'] = true;
            }
        }
        return $data;
    }


    /**
     * product store
     * @param array $request
     */
    public function productStore(array $request)
    {
        //return $this->productSetting(["imageSize",'uploadProduct',"width"]);
        //return $this->storeImage();
        //$this->dbImageField = "png";
        //return $this->imageDelete();
        
        foreach($request['form_data'] as  $form_index)
        {
            $product = new Product();
            $product->sku               = Str::random(10);
            $product->bacode            = $product->sku;
            $product->status            = 1;

            $product->supplier_id       = $request['supplier_id'];
            $product->category_id       = $request['category_id'];
            $product->sub_category_id   = $request['sub_category_id'];
            $product->brand_id          = $request['brand_id'];
            $product->product_grade_id  = $request['product_grade_id'];
            $product->unit_id           = $request['unit_id'];
            $product->supplier_group_id = $request['supplier_group_id'];

            $product->warehouse_id      = $request['warehouse_id'];
            $product->warehouse_rack_id = $request['warehouse_rack_id'];
            

            $product->custom_code = $request['custom_code_'.$form_index];
            $product->company_code = $request['company_code_'.$form_index];

            $variant = $request['product_variant_'.$form_index];
            $variant_position = $request['variant_position_'.$form_index];
            
            $product->variants = json_encode([
                "name"              => $request['name'],
                "variant"           => $variant,
                "variant_position"  => $variant_position, //befor_name, after_name
            ]);
            if($variant_position == 'befor_name')
            {
                $product->name = $variant ." ". $request['name'];
            }else{
                $product->name = $request['name']." ". $variant ;
            }

            $product->color_id          = $request['color_id_'.$form_index];

            $product->initial_stock     = floatval($request['initial_stock_'.$form_index]);
            $product->alert_stock       = floatval($request['alert_stock_'.$form_index]);
            $product->description       = $request['description_'.$form_index]; 
            $product->created_by        = Auth::guard('web')->user()->id;
            $product->branch_id         = authBranch_hh();
            $product->save();
            
            if(isset($request['photo_'.$form_index]))
            {
                $this->destination  = $this->productSetting(["imageUpload",'location',"storage_location"]);  //its mandatory;
                $this->imageWidth   = $this->productSetting(["imageSize",'uploadProduct',"width"]);  //its mandatory
                $this->imageHeight  = $this->productSetting(["imageSize",'uploadProduct',"height"]);  //its nullable
                $this->requestFile  = $request['photo_'.$form_index];  //its mandatory
                $this->id           = $product->id;
                $product->photo = $this->storeImage();
                $product->save();
            }

            /*
            |-----------------------------------------------------
            | stock changing section
            |-----------------------------------------------------
            */
                $this->stock_id_FSCT                = regularStockId_hh();
                $this->product_id_FSCT              = $product->id;
                $this->stock_quantity_FSCT          = $product->initial_stock;
                $this->unit_id_FSCT                 = $product->unit_id;
                $product->available_stock           = $this->initialStockTypeIncrement();
                $product->save();
            /*
            |-----------------------------------------------------
            | stock changing section
            |-----------------------------------------------------
            */


            /*
            |-----------------------------------------------------
            | product price section
            |-----------------------------------------------------
            */
                $priceData = [];
                foreach($request[$form_index."_price"] as $index => $pric)
                {
                    $priceData[$pric] = $request[$pric."_".$form_index];
                }
                $this->productPrices_FPT    = $priceData;
                $this->product_id_FPT       = $product->id;
                $this->insertPriceInTheProductPrice();
            /*
            |-----------------------------------------------------
            | product price section
            |-----------------------------------------------------
            */
            
        }
        return true;
    }//product store


    /**
     * product update
     *
     * @param [type] $request
     */
    public function productUpdate($request)
    {
        $product =  Product::find($request['id']);
        $product->supplier_id       = $request['supplier_id'];
        $product->category_id       = $request['category_id'];
        $product->sub_category_id   = $request['sub_category_id'];
        $product->brand_id          = $request['brand_id'];
        $product->product_grade_id  = $request['product_grade_id'];
        $product->unit_id           = $request['unit_id'];
        $product->supplier_group_id = $request['supplier_group_id'];

        $product->warehouse_id      = $request['warehouse_id'];
        $product->warehouse_rack_id = $request['warehouse_rack_id'];

        $product->custom_code       = $request['custom_code'];
        $product->company_code      = $request['company_code'];

        $variant                    = $request['product_variant'];
        $variant_position           = $request['variant_position'];
        
        $product->variants = json_encode([
            "name"              => $request['name'],
            "variant"           => $variant,
            "variant_position"  => $variant_position, //befor_name, after_name
        ]);
        if($variant_position == 'befor_name')
        {
            $product->name = $variant ." ". $request['name'];
        }else{
            $product->name = $request['name']." ". $variant ;
        }

        $product->color_id          = $request['color_id'];

        $initialStock = $product->initial_stock;
        if(isset($request['initial_stock']))
        {
            $initialStock = floatval($request['initial_stock']);
        }
        $product->initial_stock     = $initialStock;
        $product->alert_stock       = floatval($request['alert_stock']);
        $product->description       = $request['description'];
        $product->save();
        
        if(isset($request['photo']))
        {
            $this->destination  = $this->productSetting(["imageUpload",'location',"storage_location"]);  //its mandatory;
            $this->imageWidth   = $this->productSetting(["imageSize",'uploadProduct',"width"]);  //its mandatory
            $this->imageHeight  = $this->productSetting(["imageSize",'uploadProduct',"height"]);  //its nullable
            $this->requestFile  = $request['photo']; //its mandatory
            $this->id           = $product->id;
            $this->dbImageField = $product->photo;  //its mandatory
            $product->photo     = $this->updateImage();
            $product->save();
        }

        
        /*
        |-----------------------------------------------------
        | product price section : update
        |-----------------------------------------------------
        */
            $priceData = [];
            foreach($request["price"] as $productPriceId)
            {
                $priceData[$productPriceId] = $request[$productPriceId."_0"];
            }
            $this->productPrices_FPT = $priceData;
            $this->product_id_FPT    = $product->id;
            $this->productPriceUpdateWhenProductUpdate($priceData,$product->id);
        /*
        |-----------------------------------------------------
        | product price section : update
        |-----------------------------------------------------
        */
        if($product->initial_stock > 0 && 
            ($product->getTotalAvailableStockFromProductStock() == 0 
            && $product->getTotalUsedStockFromProductStock() == 0
            )
        )
        {
            $this->stock_id_FSCT                = regularStockId_hh();
            $this->product_id_FSCT              = $product->id;
            $this->stock_quantity_FSCT          = $product->initial_stock;
            $this->unit_id_FSCT                 = $product->unit_id;
            $product->available_stock           = $this->updateStockWhenProductUpdateStockTypeIncrement();
            $product->save();
        }

        return $product;

    }


    




    /**
     * product delete
     *
     * @param [type] $id, product id
     * @param [type] $field , product photo field
     */
    public function productDelete($id,$field)
    {
        $this->destination  = $this->productSetting(["imageUpload",'location',"storage_location"]);  //its mandatory;
        $this->dbImageField = $field;   //its mandatory
        $this->id           = $id;
        $this->imageDelete();
        return true;
    }



}
 













    //old product insert system, not using this
    /*
        foreach($request->form_data as $index => $form_index)
        {
            $product = new Product();
            $product->sku               = Str::random(10);
            $product->bacode            = Str::random(10);

            $product->supplier_id       = $request->supplier_id;
            $product->category_id       = $request->category_id;
            $product->sub_category_id   = $request->sub_category_id;
            $product->brand_id          = $request->brand_id;
            $product->product_grade_id  = $request->product_grade_id;
            $product->unit_id           = $request->unit_id;
            $product->supplier_group_id = $request->supplier_group_id;

            $product->custom_code = $request->input('custom_code_'.$form_index);
            $product->company_code = $request->input('company_code_'.$form_index);

            $variant = $request->input('product_variant_'.$form_index);
            $variant_position = $request->input('variant_position_'.$form_index);
            
            $product->variants = json_encode([
                "variant"           => $variant,
                "variant_position" => $variant_position, //befor_name, after_name
            ]);
            if($variant_position == 'befor_name')
            {
                $product->name = $variant ." ". $request->name;
            }else{
                $product->name = $request->name ." ". $variant ;
            }

            $product->color_id = $request->input('color_id_'.$form_index);
            $product->purchase_price = $request->input('purchase_price_'.$form_index);
            $product->mrp_price = $request->input('mrp_price_'.$form_index);
            $product->whole_sell_price = $request->input('whole_sell_price_'.$form_index);
            $product->sell_price = $request->input('sell_price_'.$form_index);
            $product->initial_stock = $request->input('initial_stock_'.$form_index);
            $product->created_by = Auth::user()->id;
            $product->save();
        }
    */