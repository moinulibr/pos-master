<?php
namespace App\Traits\Backend\Customer\Logical;

use App\Models\Backend\Customer\Customer;

/*
* 
*/
trait ManagingCalculationOfCustomerSummaryTrait
{

    protected function managingCustomerCalculation($customerId,$dbField,$calType,$amount)
    {
        /* $existingCustomerData = Customer::findOrFail($customerId);
        $existingCustomerData->{$dbField} = $amount;
        $existingCustomerData->save();
        return $existingCustomerData->{$dbField}; */
        return $this->customerDBField(2);
    }

    private function customerDBField($key)
    {
        $arrayLabel = "";
        if(array_key_exists($key,$this->customerDatabaseFiled()))
        {
            $arrayLabel = $this->customerDatabaseFiled()[$key];
        }
        return $arrayLabel;
    }
 
    private function updateCustomerCalculationField($customerId,$dbField,$calType,$amount)
    {
        //1='plus', 2='minus'
        $existingCustomerData = Customer::select('id',"$dbField")->where('id',$customerId)->first();
        $existingCustomerData->{$dbField} = $existingCustomerData->{$dbField} + $amount;
        $amountAfterCalculation = 0;
        if($calType == 1)
        {
            $amountAfterCalculation = $existingCustomerData->{$dbField} + $amount;
        }else{
            $amountAfterCalculation = $existingCustomerData->{$dbField} - $amount;
        }
        $existingCustomerData->{$dbField} = $amountAfterCalculation;
        $existingCustomerData->save();
        return $existingCustomerData->{$dbField};
    }

    private function customerDatabaseFiled()
    {
        return [
             1 => 'previous_due' , //just note, never change this value
             2 => 'previous_advance' , //just note, never change this value
             3 => 'previous_loan' , //just note, never change this value
             4 => 'previous_return' , //just note, never change this value

             5 => 'previous_due_paid' , //just note, never change this value
             6 => 'previous_advance_paid' , //just note, never change this value
             7 => 'previous_loan_paid' , //just note, never change this value
             8 => 'previous_return_paid' , //just note, never change this value

             9 => 'previous_due_paid_now' ,
            10 => 'previous_advance_paid_now' ,
            11 => 'previous_loan_paid_now' ,
            12 => 'previous_return_paid_now' ,

            13 => 'previous_total_due' ,
            14 => 'previous_total_advance' ,
            15 => 'previous_total_loan' ,
            16 => 'previous_total_return' ,

            17 => 'current_due' ,
            18 => 'current_advance' ,
            19 => 'current_loan' ,
            20 => 'current_return' ,

            21 => 'current_paid_due' ,
            22 => 'current_paid_advance',
            23 => 'current_paid_loan',
            24 => 'current_paid_return' ,

            25 => 'current_total_due' ,
            26 => 'current_total_advance' ,
            27 => 'current_total_loan' ,
            28 => 'current_total_return' ,

            29 => 'total_due' ,
            30 => 'total_advance' ,
            31 => 'total_loan' ,
            32 => 'total_return' ,

            33 => 'current_total_sell_amount' ,
            34 => 'current_total_sell_reference_amount' ,
            35 => 'current_total_sell_profit_amount' ,

            36 => 'total_sell_amount',
            36 => 'total_sell_reference_amount' ,
            37 => 'total_sell_profit_amount' ,
        ];
    }


}
