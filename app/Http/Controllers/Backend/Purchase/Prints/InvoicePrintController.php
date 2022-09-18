<?php

namespace App\Http\Controllers\Backend\Sell\Prints;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Sell\SellInvoice;

class InvoicePrintController extends Controller
{
    
    public function posPrintFromDirectSellCart()
    {
        return view('backend.sell.print.invoice-from-sell-cart.pos_print');
    }
    public function normalPrintFromDirectSellCart()
    {
        return "normal print";
    }


    
    public function posPrintFromSellList($invoiceId)
    {
        $data['data']  =  SellInvoice::where('id',$invoiceId)->first();
        return view('backend.sell.print.invoice-from-sell.pos_print',$data);
    }
    public function normalPrintFromSellList($invoiceId)
    {
        $data['data']  =  SellInvoice::where('id',$invoiceId)->first();
        return view('backend.sell.print.invoice-from-sell.normal_print',$data);
    }


    
    public function index()
    {
        //
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
