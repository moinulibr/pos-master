<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
use App\Models\Backend\Customer\Customer;
use App\Models\Backend\Reference\Reference;
use Illuminate\Http\Request;

class ShippingAddressController extends Controller
{

    /*
    |------------------------------------------------------
    | Only from pos 
    | get customer shipping address details by costomer id
    |------------------------------------------------------
    */
        public function getCustomerShippingAddressDetailsByCustomerId(Request $request)
        {
            $data['customer'] = Customer::where('id',$request->customer_id)->first();
            $data['reference'] = Reference::where('id',$request->reference_id)->first();
            $view = view('backend.customer.shipping_address.create_from_pos_shipping_address',$data)->render();
            return response()->json([
                'html' => $view,
                'status' => true
            ]);
        }
    /*
    |------------------------------------------------------
    | Only from pos 
    | get customer shipping address details by costomer id
    |------------------------------------------------------
    */

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
