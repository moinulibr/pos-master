<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
use App\Models\Backend\Customer\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Validator;

use App\Http\Requests\Backend\Customer\CustomerValidationTrait;
use App\Models\Backend\Customer\CustomerShippingAddress;
use App\Models\Backend\Customer\CustomerType;
use App\Traits\Backend\ProductAttribute\Unit\UnitTrait;
use App\Traits\Permission\Permission;
class CustomerController extends Controller
{
    use CustomerValidationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['datas'] = Customer::latest()->paginate(50);
        return view('backend.customer.customer.index',$data);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function customerListByAjaxResponse(Request $request)
    {
        if($request->ajax())
        {   
            $qry = Customer::query();
            if($request->search)
            {
                $qry->where('name','like','%'.$request->search.'%')
                    ->orWhere('phone','like','%'.$request->search.'%')
                    ->orWhere('email','like','%'.$request->search.'%')
                    ->orWhere('custom_id','like','%'.$request->search.'%');
            }
            $data['datas'] = $qry->latest()->paginate(50);
            $html = view('backend.customer.customer.ajax.list_ajax_response',$data)->render();
            return response()->json([
                'status' => true,
                'html' => $html
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
        $data['datas'] = CustomerType::latest()->get();
        return view('backend.customer.customer.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validators = $this->customerValidationWhenStoreCustomer($request->all());
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }

        $saveData =  auth()->user()->customerUsers()->create($request->all());

        //shipping address
        $shipping = new CustomerShippingAddress();
        $shipping->branch_id = authBranch_hh();
        $shipping->customer_id = $saveData->id;
        $shipping->phone = $saveData->phone;
        $shipping->email = $saveData->email;
        $shipping->address = $saveData->address;
        $shipping->save();
        //shipping address

        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Customer added successfully",
            'create_from'   => $request->create_from, // regular, another page name
            'data_id'       => $saveData->id,
            'data_name'     => $saveData->name,
            'data_created_class_name' => $request->created_from_class_name ?? "",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Customer\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Customer\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer,Request $request)
    {
        $data['datas'] = CustomerType::latest()->get();
        $data['customer'] = Customer::findOrFail($request->id);
        return view('backend.customer.customer.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Customer\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $validators = $this->customerValidationWhenUpdateCustomer($request->all(),$request->id);
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }
        $updateData = Customer::findOrFail($request->id);
        $updateData->update($request->all());//auth()->user()->unitUsers()->
        //$updateData->created_by = Auth::user()->id;
        //$updateData->save();

        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Customer updated successfully"
        ]);
    }

    
    public function delete(Customer $customer, Request $request)
    {
        Customer::findOrFail($request->id)->delete();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Customer Deleted successfully"
        ]);
    } 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Customer\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
