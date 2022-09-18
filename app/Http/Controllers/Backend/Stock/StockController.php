<?php

namespace App\Http\Controllers\Backend\Stock;

use Illuminate\Http\Request;
use App\Models\Backend\Stock\Stock;
use App\Http\Controllers\Controller;
use App\Models\Backend\Product\Product;

class StockController extends Controller
{

    public function index()
    {
        $data['datas']  = Product::latest()->paginate(50);
        $data['stocks'] = Stock::where('status',1)
                        ->where('branch_id',authBranch_hh())
                        ->whereNull('deleted_at')
                        ->select('id','name','label','branch_id','deleted_at')
                        ->orderBy('custom_serial','ASC')
                        ->get();
        return view('backend.stock.index',$data);
    }


    public function stockListByAjaxResponse(Request $request)
    {
        $data['stocks'] = Stock::where('status',1)
                        ->where('branch_id',authBranch_hh())
                        ->whereNull('deleted_at')
                        ->select('id','name','label','branch_id','deleted_at')
                        ->orderBy('custom_serial','ASC')
                        ->get();
        $product  = Product::query();
        if($request->ajax())
        {
            if($request->search)
            {
                $product->where('name','like','%'.$request->search.'%')
                        ->orWhere('sku','like','%'.$request->search.'%')
                        ->orWhere('bacode','like','%'.$request->search.'%')
                        ->orWhere('custom_code','like','%'.$request->search.'%')
                        ->orWhere('company_code','like','%'.$request->search.'%');
            }
            $data['datas']  =  $product->latest()->paginate(50);
            $html = view('backend.stock.ajax.list_ajax_response',$data)->render();
            return response()->json([
                'status' => true,
                'html' => $html
            ]);
        }
    }


}
