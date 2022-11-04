<?php

namespace App\Http\Controllers\Backend\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    
    //payment banking option
    public function paymentBankingOptionData(Request $request)
    {
        $data['banking_option_id'] = $request->banking_option_id;
        $data['moibleBankingAccounts'] = mobileBankingAccounts_hh();
        $data['bankingAccounts'] = onlyBankingAccounts_hh();
        $list = view('backend.payment.ajax.common.payment_banking_option',$data)->render();
        return response()->json([
            'status'    => true,
            'list'     => $list,
        ]);
    }

   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
