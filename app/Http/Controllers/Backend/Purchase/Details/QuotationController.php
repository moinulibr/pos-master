<?php

namespace App\Http\Controllers\Backend\Sell\Details;

use App\Http\Controllers\Controller;
use App\Models\Backend\Sell\SellInvoice;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['datas'] = SellInvoice::where('sell_type',2)
                        ->where('branch_id',authBranch_hh())
                        ->whereNull('deleted_at')
                        //->orderBy('custom_serial','ASC')
                        ->paginate(50);
        return view('backend.sell.sell_quotation.index',$data);
    }

    public function quotationListByAjaxResponse(Request $request)
    {
        $sell  = SellInvoice::query();
        if($request->ajax())
        {
            if($request->search)
            {
                $sell->where('invoice_no','like','%'.$request->search.'%');
            }
            $data['datas']  =  $sell->where('sell_type',2)->latest()->paginate(50);
            $html = view('backend.sell.sell_quotation.ajax.list_ajax_response',$data)->render();
            return response()->json([
                'status' => true,
                'html' => $html
            ]);
        }
    }


    public function singleView(Request $request)
    {
        $data['data']  =  SellInvoice::where('id',$request->id)->first();
        $html = view('backend.sell.sell_quotation.show.show',$data)->render();
        return response()->json([
            'status' => true,
            'html' => $html
        ]);
    }


    public function viewSingleInvoiceProfitLoss(Request $request)
    {
        $data['data']  =  SellInvoice::where('id',$request->id)->first();
        $html = view('backend.sell.sell_quotation.show.profit_lost',$data)->render();
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
