<?php
namespace App\Traits\Backend\Customer\Shipping;

use App\Models\Backend\Customer\CustomerShippingAddress;

/**
 * customer shipping address
 * 
 */
trait ShippingAddressTrait
{
   
    protected $customerId;
    protected $customerFormData;

    
    protected function insertCustomerShippingAddress()
    {
        $customer = new CustomerShippingAddress();
        $customer = $this->customerFormData['customer_id'];
    }
 
   
    protected function getCustomerShippingAddressByCustomerId($customer_id)
    {
        CustomerShippingAddress::where('customer_id',$customer_id)->get();
    }


    //working perfect
    //inserting data from sell create part : pos
    protected function insertCustomerShippingAddressFromPosCreate()
    {
        $customer = new CustomerShippingAddress();
        $customer->branch_id = authBranch_hh();
        $customer->customer_id = $this->customerFormData['customer_id'];
        $customer->phone  = $this->customerFormData['phone'];
        $customer->email = $this->customerFormData['email'];
        $customer->address = $this->customerFormData['new_shipping_address'];
        $customer->save();
        return $customer->id;
    }
    //inserting data from sell create part : pos

}