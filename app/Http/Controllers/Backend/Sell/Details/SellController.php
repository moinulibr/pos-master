<?php

namespace App\Http\Controllers\Backend\Sell\Details;

use App\Http\Controllers\Controller;
use App\Models\Backend\Sell\SellInvoice;
use Illuminate\Http\Request;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['datas'] = SellInvoice::where('sell_type',1)
                        ->where('branch_id',authBranch_hh())
                        ->whereNull('deleted_at')
                        //->orderBy('custom_serial','ASC')
                        ->paginate(50);
        return view('backend.sell.sell_details.index',$data);
    }

    public function sellListByAjaxResponse(Request $request)
    {
        $sell  = SellInvoice::query();
        if($request->ajax())
        {
            if($request->search)
            {
                $sell->where('invoice_no','like','%'.$request->search.'%');
            }
            $data['datas']  =  $sell->where('sell_type',1)->latest()->paginate(50);
            $html = view('backend.sell.sell_details.ajax.list_ajax_response',$data)->render();
            return response()->json([
                'status' => true,
                'html' => $html
            ]);
        }
    }


    public function singleView(Request $request)
    {
        $data['data']  =  SellInvoice::where('id',$request->id)->first();
        $html = view('backend.sell.sell_details.show.show',$data)->render();
        return response()->json([
            'status' => true,
            'html' => $html
        ]);
    }


    public function viewSingleInvoiceProfitLoss(Request $request)
    {
        $data['data']  =  SellInvoice::where('id',$request->id)->first();
        $html = view('backend.sell.sell_details.show.profit_lost',$data)->render();
        return response()->json([
            'status' => true,
            'html' => $html
        ]);
    }


    //payment mmodal open with customer information and invoice information
    //admin.sell.regular.sell.view.receive.payment.modal
    public function receivePayment(Request $request)
    {   
        $data['data'] = SellInvoice::findOrFail($request->id);
        if($data['data'])
        {
            $list = view('backend.sell.payment.payment',$data)->render();
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
    public function paymentModalOpen(Request $request)
    {
        //sellCreateCartSessionName_hh();
        $sellInvoiceSummeryCartName = sellCreateCartInvoiceSummerySessionName_hh();
        $sellInvoiceSummeryCart = [];
        $sellInvoiceSummeryCart = session()->has($sellInvoiceSummeryCartName) ? session()->get($sellInvoiceSummeryCartName)  : [];
        $data['totalPayableAmount'] = $sellInvoiceSummeryCart['lineInvoicePayableAmountWithRounding'];
        
        $data['customer'] = Customer::findOrFail($request->customer_id);

        $data['cashAccounts'] = cashAccounts_hh();
        $data['advanceAccounts'] = advanceAccounts_hh();
        
        if($data['totalPayableAmount'] > 0)
        {
            $list = view('backend.sell.pos.ajax-response.payment_quotation.payment_data',$data)->render();
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
