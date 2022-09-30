<?php

namespace App\Http\Controllers\Backend\Purchase\Details;

use App\Http\Controllers\Controller;
use App\Models\Backend\Sell\SellInvoice;
use Illuminate\Http\Request;
use App\Models\Backend\Purchase\PurchaseInvoice;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['datas'] = PurchaseInvoice::where('purchase_type',1)
                        ->where('branch_id',authBranch_hh())
                        ->whereNull('deleted_at')
                        //->orderBy('custom_serial','ASC')
                        ->paginate(50);
        return view('backend.purchase.purchase_details.index',$data);
    }

    public function purchaseListByAjaxResponse(Request $request)
    {
        $purchase  = PurchaseInvoice::query();
        if($request->ajax())
        {
            if($request->search)
            {
                $purchase->where('invoice_no','like','%'.$request->search.'%')
                ->orWhere('reference_no','like','%'.$request->search.'%')
                ->orWhere('chalan_no','like','%'.$request->search.'%');
            }
            $data['datas']  =  $purchase->where('purchase_type',1)->latest()->paginate(50);
            $html = view('backend.purchase.purchase_details.ajax.list_ajax_response',$data)->render();
            return response()->json([
                'status' => true,
                'html' => $html
            ]);
        }
    }


    public function singleView(Request $request)
    {
        $data['data']  =  PurchaseInvoice::where('id',$request->id)->first();
        $html = view('backend.purchase.purchase_details.show.show',$data)->render();
        return response()->json([
            'status' => true,
            'html' => $html
        ]);
    }


    public function viewSingleInvoiceWiseProductReceive(Request $request)
    {
        $data['data']  =  PurchaseInvoice::where('id',$request->id)->first();
        $html = view('backend.purchase.purchase_details.show.receive_product',$data)->render();
        return response()->json([
            'status' => true,
            'html' => $html
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
        //
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
