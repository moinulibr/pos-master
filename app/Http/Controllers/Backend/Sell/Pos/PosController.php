<?php

namespace App\Http\Controllers\Backend\Sell\Pos;

use App\Http\Controllers\Controller;
use App\Models\Backend\Customer\Customer;
use Illuminate\Http\Request;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

use App\Models\Backend\Price\Price;
use App\Models\Backend\Stock\Stock;

//use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Traits\Permission\Permission;
use App\Models\Backend\Product\Product;
use App\Models\Backend\Supplier\Supplier;
use App\Models\Backend\Price\ProductPrice;
use App\Models\Backend\Stock\ProductStock;
use App\Models\Backend\Warehouse\Warehouse;
use App\Models\Backend\ProductAttribute\Unit;
use App\Models\Backend\ProductAttribute\Brand;
use App\Models\Backend\ProductAttribute\Color;
use App\Models\Backend\Supplier\SupplierGroup;
use App\Models\Backend\ProductAttribute\Category;
use App\Models\Backend\ProductAttribute\SubCategory;
use App\Traits\Backend\Product\Logical\ProductTrait;
use App\Models\Backend\ProductAttribute\ProductGrade;
use App\Models\Backend\Reference\Reference;
use App\Traits\Backend\Product\Request\ProductValidationTrait;
use App\Traits\Backend\Pos\Create\SellCreateAddToCart;

use App\Traits\Backend\Pos\Create\StoreDataFromSellCartTrait;

class PosController extends Controller
{
    use SellCreateAddToCart, StoreDataFromSellCartTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayProductList(Request $request)
    {
        $query = Product::query();
        if($request->product_id){
            $query->where('id',$request->product_id);
        }
        if($request->category_id){
            $query->where('category_id',$request->category_id);
        }
        if($request->custom_search){
            $query->where('name','like',"%".$request->custom_search."%");
            $query->orWhere('custom_code','like',"%".$request->custom_search."%");
            $query->orWhere('company_code','like',"%".$request->custom_search."%");
            $query->orWhere('sku','like',"%".$request->custom_search."%");
        }
        $data['products']       = $query->select('name','id','photo','available_base_stock')
                                ->latest()
                                ->paginate(15);
        $view = view('backend.sell.pos.ajax-response.landing.product-list.product_list',$data)->render();
        return response()->json([
            'status'    => true,
            'html'      => $view,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // first time default sell session create
        firstTimeDefaultMasterSellSessionCreate_hh();

        /* $mastersessionname = masterSellingSession_hh();
        $mastersession    = [];
        $mastersession    = session()->has($mastersessionname) ? session()->get($mastersessionname)  : [];
        if(count($mastersession) == 0)
        {
            $mastersession[defaultSellingSession()] = [
                    'session_name' => defaultSellingSession(),
                    'name' => defaultSellingSessionName(),
                    'status' => 'active',
                ];
            session([$mastersessionname => $mastersession]);
        } */
           
        /* $mastersessionname = masterSellingSession_hh();
        //session([$mastersessionname => []]);
        $mastersession    = [];
        $mastersession    = session()->has($mastersessionname) ? session()->get($mastersessionname)  : [];
        echo "<pre>";
        print_r($mastersession);
        echo "</pre>";
        echo"<br/><br/>";
        echo getSellingCurrentSession();
        echo"<br/><br/>";
        return var_dump($mastersession); */
        /* $data['brands']         = Brand::latest()->get();
        $data['colors']         = Color::latest()->get();
        $data['suppliers']      = Supplier::latest()->get();
        $data['productGrades']  = ProductGrade::latest()->get();
        $data['supplierGroups'] = SupplierGroup::latest()->get();
        $data['units']          = Unit::latest()->get();

        $data['warehouses']     = Warehouse::latest()->get();
        $data['prices']         = Price::where('status',1)
                                ->where('branch_id',authBranch_hh())
                                ->whereNull('deleted_at')
                                ->orderBy('custom_serial','ASC')
                                ->get(); */


        $data['customers']      = Customer::latest()->get();
        $data['references']     = Reference::latest()->get();

        $data['categories']     = Category::latest()->get();
        $data['allproducts']    = Product::select('name','id')->latest()->get();
        $data['products']       = Product::select('name','id','photo','available_base_stock')
                                ->latest()
                                ->paginate(15);
        return view('backend.sell.pos.landing.create_pos',$data);
        return view('backend.sell.pos.zdesign.design_single_product',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function singleProductDetails(Request $request)
    {
        $data['product']        = Product::find($request->id);
        $unitBaseId             = Unit::find($data['product']->unit_id)->base_unit_id;
        $data['units']          = Unit::where('base_unit_id',$unitBaseId)->latest()->get();
        
        //default price id 
        $data['defaultPriceId'] = 1;
        //default stock 
        $defaultStock = 1 ;
        $dafault = ProductStock::select("product_stocks.id","stocks.id as sId")
                ->join("stocks","stocks.id","=","product_stocks.stock_id")
                ->where('product_stocks.product_id',$request->id)
                ->where('product_stocks.branch_id',authBranch_hh())
                ->where('stocks.id',defaultSelectedProductStockId_hh())//default stock id
                ->where('product_stocks.status',1)
                ->where('stocks.status',1)
                ->orderBy('stocks.custom_serial','ASC')
                ->where('stocks.branch_id',authBranch_hh())
                ->first(); 
        $data['defaultProductStockId'] = $dafault ? $dafault->id : 1;
        //default stock 

        //default product stocks price
        $product                = $data['product'];
        $data['productStock']   = $product->productStockWithActivePriceByProductStockIdNORWhereStatusIsActiveWhenCreateSale($dafault->id);
        //default product stocks price

        $view   = view('backend.sell.pos.ajax-response.single-product.single_product',$data)->render();
        $stock  = view('backend.sell.pos.ajax-response.single-product.include.product_stock',$data)->render();
        return response()->json([
            'status'    => true,
            'html'      => $view,
            'stock'     => $stock,
        ]);
    }


    public function displaySinglePriceListByProductStockId(Request $request)
    {
        $product                = Product::find($request->product_id);
        $data['productStock']   = $product->productStockWithActivePriceByProductStockIdNORWhereStatusIsActiveWhenCreateSale($request->product_stock_id);

        $stock = view('backend.sell.pos.ajax-response.single-product.include.product_stock_price',$data)->render();
        return response()->json([
            'status'    => true,
            'stock'     => $stock,
        ]);
    }

    //display product stock and price, when sell create. more than stock, from others stock
    public function displayQuantityWiseSingleProductStockByProductId(Request $request)
    {
        $product                        = Product::find($request->product_id);
        $data['sellingQuantity']        = $request->sellingQuantity;
        $data['sellingPrice']           = $request->sellingPrice;
        $data['primarySellingStock']    = $request->primarySellingStock;
        $data['product'] = $product;
        $stock = view('backend.sell.pos.ajax-response.single-product.include.quantity_wise_product_stock',$data)->render();
        return response()->json([
            'status'    => true,
            'stock'     => $stock,
        ]);
    }
  
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->cartName     = sellCreateCartSessionName_hh();//"SellCreateAddToCart";
        $this->requestAllCartData = $request;
        $this->addingToCartWhenSellCreate();
        $list = view('backend.sell.pos.ajax-response.landing.added-to-cart.list')->render();
        return response()->json([
            'status'    => true,
            'list'      => $list,
            'message'   => "This item is added in the cart",
            'type'      => 'success'
        ]);
    }

    //display sell created added to cart product list
    public function displaySellCreateAddedToCartProductList()
    {
        $list = view('backend.sell.pos.ajax-response.landing.added-to-cart.list')->render();
        return response()->json([
            'status'    => true,
            'list'     => $list,
        ]);
    }

    //sell final invoice calculation summery [save in session]
    public function invoiceFinalSellCalculationSummery(Request $request)
    {
        $this->cartName     = sellCreateCartInvoiceSummerySessionName_hh();//"SellCartInvoiceSummery";
        $this->requestAllCartData = $request;
        $this->sellCartInvoiceSummery();
        $cartName           = [];
        $cartName           = session()->has($this->cartName) ? session()->get($this->cartName)  : [];
        return $cartName;
        return response()->json([
            'status'    => true,
        ]);
        $cartName['totalInvoicePayableAmount'];
    }



    //remove single item confirmation modal
    public function removeConfirmationRequiredForSingleItemFromSellAddedToCartList(Request $request)
    {
        $data['product_id'] = $request->product_id;
        $html = view('backend.sell.pos.ajax-response.landing.remove-added-to-cart.remove_single_item',$data)->render();
        return response()->json([
            'status'    => true,
            'html'     => $html,
        ]);
    }

    public function removeSingleItemFromSellAddedToCartList(Request $request)
    {
        $this->requestAllCartData = $request;
        $this->removeSingleItemFromSellCreateAddedToCartList();

        $list = view('backend.sell.pos.ajax-response.landing.added-to-cart.list')->render();
        return response()->json([
            'status'    => true,
            'list'     => $list,
            'message'   => "Delete this item from the cart",
            'type'      => 'success'
        ]);
    }

    //remove all itme confirmation modal
    public function removeConfirmationRequiredForAllItemFromSellAddedToCartList()
    {
        $html = view('backend.sell.pos.ajax-response.landing.remove-added-to-cart.remove_all_item')->render();
        return response()->json([
            'status'    => true,
            'html'     => $html,
        ]);
    }

    public function removeAllItemFromSellAddedToCartList()
    {
        $this->removeAllItemFromSellCreateAddedToCartList();
        $list = view('backend.sell.pos.ajax-response.landing.added-to-cart.list')->render();
        return response()->json([
            'status'    => true,
            'list'     => $list,
            'message'   => "All item are deleted from the cart",
            'type'      => 'success'
        ]);
    }


    public function changeQuantity(Request $request)
    {
        $this->requestAllCartData = $request;
        $this->whenChangingQuantityFromCartList();
        $list = view('backend.sell.pos.ajax-response.landing.added-to-cart.list')->render();
        return response()->json([
            'status'    => true,
            'list'     => $list,
            'message'   => "Quantity is updated for this item",
            'type'      => 'success'
        ]);
    }






    /*======================================================= */
    //customer shipping address from sell cart (pos)
    public function customerShippingAddress(Request $request)
    {
        //return $request; 
        $this->requestAllCartData = $request;
        $this->cartName = sellCreateCartShippingAddressSessionName_hh();
        $this->shippingAddressStoreInSession();
        return response()->json([
            'status'    => true,
        ]);
    }
    /*======================================================= */
    // store sell and quotation data from sell cart (pos)
    public function storeDataFromSellCart(Request $request)
    {   
        DB::beginTransaction();

        try {
            $this->sellCreateFormData = $request;
            $this->storeSessionDataFromSellCart();   
            DB::commit();
            
            session([sellCreateCartSessionName_hh() => []]);
            session([sellCreateCartInvoiceSummerySessionName_hh() => []]);
            session([sellCreateCartShippingAddressSessionName_hh() => []]);
            $list = view('backend.sell.pos.ajax-response.landing.added-to-cart.list')->render();
            return response()->json([
                'status'    => true,
                'list'      => $list,
                'message'   => "Action submited successfully!",
                'type'      => 'success'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return response()->json([
                'status'    => true,
                'message'   => "Something went wrong",
                'type'      => 'error'
            ]);
        } /* catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        } */
    }
    /*======================================================= */
    
}
