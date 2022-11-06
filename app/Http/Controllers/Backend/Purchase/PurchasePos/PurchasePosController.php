<?php

namespace App\Http\Controllers\Backend\Purchase\PurchasePos;

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
use App\Traits\Backend\PurchasePos\Create\PurchaseCreateAddToCart;

use App\Traits\Backend\PurchasePos\Create\StoreDataFromPurchaseCartTrait;

class PurchasePosController extends Controller
{
    use PurchaseCreateAddToCart, StoreDataFromPurchaseCartTrait;
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
        $view = view('backend.purchase.purchase_pos.ajax-response.landing.product-list.product_list',$data)->render();
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
        //$this->removeAllItemFromPurchaseCreateAddedToCartList();
        // first time default Purchase session create
        firstTimeDefaultMasterSellSessionCreate_hh();

        $data['suppliers']      = Supplier::latest()->get();

        $data['categories']     = Category::latest()->get();
        $data['allproducts']    = Product::select('name','id')->latest()->get();
        $data['products']       = Product::select('name','id','photo','available_base_stock')
                                        ->latest()
                                        ->paginate(15);
        return view('backend.purchase.purchase_pos.landing.create_pos',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function singleProductDetails(Request $request)
    {
        $data['product'] = Product::findOrFail($request->id);
        $html = view('backend.purchase.purchase_pos.ajax-response.single-product.single_product',$data)->render();
        return response()->json([
            'status' => true,
            'data' => $html
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
        //return $request;
        $this->cartName     = purchaseCreateCartSessionName_hh();//"PurchaseCreateAddToCart";
        $this->requestAllCartData = $request;
        $this->addingToCartWhenPurchaseCreate();
        $list = view('backend.purchase.purchase_pos.ajax-response.landing.added-to-cart.list')->render();
        return response()->json([
            'status'    => true,
            'list'      => $list,
            'message'   => "This item is added in the cart",
            'type'      => 'success'
        ]);
    }

    //display Purchase created added to cart product list
    public function displayPurchaseCreateAddedToCartProductList()
    {
        $list = view('backend.purchase.purchase_pos.ajax-response.landing.added-to-cart.list')->render();
        return response()->json([
            'status'    => true,
            'list'     => $list,
        ]);
    }

    //Purchase final invoice calculation summery [save in session]
    public function invoiceFinalPurchaseCalculationSummery(Request $request)
    {
        $this->cartName     = purchaseCreateCartInvoiceSummerySessionName_hh();//"purchaseCartInvoiceSummery";
        $this->requestAllCartData = $request;
        $this->purchaseCartInvoiceSummery();
        $cartName           = [];
        $cartName           = session()->has($this->cartName) ? session()->get($this->cartName)  : [];
        return $cartName;
        return response()->json([
            'status'    => true,
        ]);
        $cartName['totalInvoicePayableAmount'];
    }



    //remove single item confirmation modal
    public function removeConfirmationRequiredForSingleItemFromPurchaseAddedToCartList(Request $request)
    {
        $data['product_id'] = $request->product_id;
        $html = view('backend.purchase.purchase_pos.ajax-response.landing.remove-added-to-cart.remove_single_item',$data)->render();
        return response()->json([
            'status'    => true,
            'html'     => $html,
        ]);
    }

    public function removeSingleItemFromPurchaseAddedToCartList(Request $request)
    {
        $this->requestAllCartData = $request;
        $this->removeSingleItemFromPurchaseCreateAddedToCartList();

        $list = view('backend.purchase.purchase_pos.ajax-response.landing.added-to-cart.list')->render();
        return response()->json([
            'status'    => true,
            'list'     => $list,
            'message'   => "Delete this item from the cart",
            'type'      => 'success'
        ]);
    }

    //remove all itme confirmation modal
    public function removeConfirmationRequiredForAllItemFromPurchaseAddedToCartList()
    {
        $html = view('backend.purchase.purchase_pos.ajax-response.landing.remove-added-to-cart.remove_all_item')->render();
        return response()->json([
            'status'    => true,
            'html'     => $html,
        ]);
    }

    public function removeAllItemFromPurchaseAddedToCartList()
    {
        $this->removeAllItemFromPurchaseCreateAddedToCartList();
        $list = view('backend.purchase.purchase_pos.ajax-response.landing.added-to-cart.list')->render();
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
        $list = view('backend.purchase.purchase_pos.ajax-response.landing.added-to-cart.list')->render();
        return response()->json([
            'status'    => true,
            'list'     => $list,
            'message'   => "Quantity is updated for this item",
            'type'      => 'success'
        ]);
    }




    /*======================================================= */
    //purchase shipping cost and other (pos)
    public function purchaseShippingCostAndOther(Request $request)
    {
        //return $request; 
        $this->requestAllCartData = $request;
        $this->cartName = purchaseCreateCartShippingCostSessionName_hh();
        $this->shippingCostAndOtherInformationStoreInSession();
        return response()->json([
            'status'    => true,
        ]);
    }
    //purchase shipping cost and other  (pos)

    //payment modal open
    public function paymentModalOpen(Request $request)
    {
        $purchaseInvoiceSummeryCartName = purchaseCreateCartInvoiceSummerySessionName_hh();
        $purchaseInvoiceSummeryCart = [];
        $purchaseInvoiceSummeryCart = session()->has($purchaseInvoiceSummeryCartName) ? session()->get($purchaseInvoiceSummeryCartName)  : [];
        
        $data['cashAccounts'] = cashAccounts_hh();
        $data['advanceAccounts'] = advanceAccounts_hh();
        $data['totalPayableAmount'] = $purchaseInvoiceSummeryCart['lineInvoicePayableAmountWithRounding'];

        $data['supplier'] = Supplier::findOrFail($request->supplier_id);

         if($data['totalPayableAmount'] > 0)
        {
            $list = view('backend.purchase.purchase_pos.ajax-response.payment_quotation.payment_data',$data)->render();
            return response()->json([
                'status'    => true,
                'list'     => $list,
            ]);
        }else{
            return response()->json([
                'status'    => false,
            ]);
        }
    }
    //payment modal open

    /*======================================================= */
    // store Purchase and quotation data from Purchase cart (pos)
    public function storeDataFromPurchaseCart(Request $request)
    {   
        DB::beginTransaction();

        try {
            $this->purchaseCreateFormRequestData = $request;
            $this->storeSessionDataFromPurchaseCart();   
            DB::commit();
            
            session([purchaseCreateCartSessionName_hh() => []]);
            session([purchaseCreateCartInvoiceSummerySessionName_hh() => []]);
            session([purchaseCreateCartShippingCostSessionName_hh() => []]);
            $list = view('backend.purchase.purchase_pos.ajax-response.landing.added-to-cart.list')->render();
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
