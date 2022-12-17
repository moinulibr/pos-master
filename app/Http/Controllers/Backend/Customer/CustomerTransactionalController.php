<?php

namespace App\Http\Controllers\Backend\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Traits\Permission\Permission;
use App\Models\Backend\Customer\Customer;

use App\Traits\Backend\Payment\CustomerPaymentProcessTrait;

class CustomerTransactionalController extends Controller
{
    use CustomerPaymentProcessTrait;

    public function history($id)
    {
        $data['customer'] = Customer::findOrFail($id);
        return view('backend.customer.customer.history.history',$data);
    }

    public function customerTransactionalStatement(Request $request)
    {
        $data['customer'] = Customer::findOrFail($request->id);
        $transactionalSummary =  view('backend.customer.customer.history.transactional_summary',$data)->render();
        $transactionalStatement =  view('backend.customer.customer.history.transactional_statement',$data)->render();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Customer updated successfully",
            'transactionalSummary' => $transactionalSummary,
            'transactionalStatement' => $transactionalStatement,
        ]);
    }

    //render next payment data
    public function renderNextPaymentDateModal(Request $request)
    {
        $data['customer'] = Customer::select('id','next_payment_date')->findOrFail($request->id);
        $view =  view('backend.customer.customer.transactionHistory.next_payment_date',$data)->render();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'view' => $view,
        ]);
    }
    //store next payment data
    public function soteNextPaymentDate(Request $request)
    {
        DB::beginTransaction();
        try {
            $data['customer'] = Customer::select('id','next_payment_date')->findOrFail($request->customer_id);
            $data['customer']->update(['next_payment_date'=>$request->next_payment_date]);
    
            $this->processingOfAllCustomerTransactionRequestData = customerTransactionRequestDataProcessing_hp($request);
            $this->amount = 0;
            $this->ctsCurrentPaymentAmount = 0;
            $this->ctsTTModuleId = getCTSModuleIdBySingleModuleLebel_hp('Change Payment Date');
            $this->ctsCustomerId = $request->customer_id;
            $ttModuleInvoics = [
                'invoice_no' => NULL,
                'invoice_id' => NULL
            ];
            $this->ttModuleInvoicsDataArrayFormated = $ttModuleInvoics;
            $this->ctsCdsTypeId = getCTSCdfIdBySingleCdfLebel_hp('-');
            $this->processingOfAllCustomerTransaction();
            DB::commit();
            return response()->json([
                'status' => true,
                'type' => 'success',
                'message' => "Next payment date store successfully",
            ]);
        } catch (\Exception  $e) {
            DB::rollback();
            throw $e;
            return response()->json([
                'status' => 'exception',
                'type' => 'warning',
                'message'=>  $e->getMessage()
            ]);
        }
    }

    //add loan
    public function renderAddLoanModal(Request $request)
    {
        $data['customer'] = Customer::select('id','total_loan')->findOrFail($request->id);
        $view =  view('backend.customer.customer.transactionHistory.add_loan',$data)->render();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'view' => $view,
        ]);
    }
    //store loan data
    public function soteAddLoanDate(Request $request)
    {
        DB::beginTransaction();
        try {
            $data['customer'] = Customer::select('id','next_payment_date')->findOrFail($request->customer_id);
            $data['customer']->update(['next_payment_date'=>$request->next_payment_date]);
    
            $this->processingOfAllCustomerTransactionRequestData = customerTransactionRequestDataProcessing_hp($request);
            $this->amount = $request->amount;
            $this->ctsCurrentPaymentAmount = $request->amount;
            $this->ctsTTModuleId = getCTSModuleIdBySingleModuleLebel_hp('Loan');
            $this->ctsCustomerId = $request->customer_id;
            $ttModuleInvoics = [
                'invoice_no' => NULL,
                'invoice_id' => NULL
            ];
            $this->ttModuleInvoicsDataArrayFormated = $ttModuleInvoics;
            $this->ctsCdsTypeId = getCTSCdfIdBySingleCdfLebel_hp('Due');
            $this->processingOfAllCustomerTransaction();
            DB::commit();
            return response()->json([
                'status' => true,
                'type' => 'success',
                'message' => "Date store successfully",
            ]);
        } catch (\Exception  $e) {
            DB::rollback();
            throw $e;
            return response()->json([
                'status' => 'exception',
                'type' => 'warning',
                'message'=>  $e->getMessage()
            ]);
        }
    }

    //add advance
    public function renderAddAdvanceModal(Request $request)
    {
        $data['customer'] = Customer::select('id','next_payment_date')->findOrFail($request->id);
        $view =  view('backend.customer.customer.transactionHistory.add_advance',$data)->render();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'view' => $view,
        ]);
    }
    //store advance
    public function soteAddAdvance(Request $request)
    {
        DB::beginTransaction();
        try {
            $data['customer'] = Customer::select('id','total_advance')->findOrFail($request->customer_id);
            $data['customer']->update(['next_payment_date'=>$request->next_payment_date]);
    
            $this->processingOfAllCustomerTransactionRequestData = customerTransactionRequestDataProcessing_hp($request);
            $this->amount = $request->amount;
            $this->ctsCurrentPaymentAmount = $request->amount;
            $this->ctsTTModuleId = getCTSModuleIdBySingleModuleLebel_hp('Advance');
            $this->ctsCustomerId = $request->customer_id;
            $ttModuleInvoics = [
                'invoice_no' => NULL,
                'invoice_id' => NULL
            ];
            $this->ttModuleInvoicsDataArrayFormated = $ttModuleInvoics;
            $this->ctsCdsTypeId = getCTSCdfIdBySingleCdfLebel_hp('Paid');
            $this->processingOfAllCustomerTransaction();
            DB::commit();
            return response()->json([
                'status' => true,
                'type' => 'success',
                'message' => "Date store successfully",
            ]);
        } catch (\Exception  $e) {
            DB::rollback();
            throw $e;
            return response()->json([
                'status' => 'exception',
                'type' => 'warning',
                'message'=>  $e->getMessage()
            ]);
        }
    }

    //receive previous data
    public function renderReceivePreviousDueModal(Request $request)
    {
        $data['customer'] = Customer::select('id','previous_total_due')->findOrFail($request->id);
        $view =  view('backend.customer.customer.transactionHistory.receive_previous_due',$data)->render();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'view' => $view,
        ]);
    }

    //store receive previous data
    public function soteReceivePreviousDue(Request $request)
    {
        DB::beginTransaction();
        try {
            $data['customer'] = Customer::select('id','total_advance')->findOrFail($request->customer_id);
            $data['customer']->update(['next_payment_date'=>$request->next_payment_date]);
    
            $this->processingOfAllCustomerTransactionRequestData = customerTransactionRequestDataProcessing_hp($request);
            $this->amount = $request->amount;
            $this->ctsCurrentPaymentAmount = $request->amount;
            $this->ctsTTModuleId = getCTSModuleIdBySingleModuleLebel_hp('Previous Due Payment');
            $this->ctsCustomerId = $request->customer_id;
            $ttModuleInvoics = [
                'invoice_no' => NULL,
                'invoice_id' => NULL
            ];
            $this->ttModuleInvoicsDataArrayFormated = $ttModuleInvoics;
            $this->ctsCdsTypeId = getCTSCdfIdBySingleCdfLebel_hp('Paid');
            $this->processingOfAllCustomerTransaction();
            DB::commit();
            return response()->json([
                'status' => true,
                'type' => 'success',
                'message' => "Date store successfully",
            ]);
        } catch (\Exception  $e) {
            DB::rollback();
            throw $e;
            return response()->json([
                'status' => 'exception',
                'type' => 'warning',
                'message'=>  $e->getMessage()
            ]);
        }
    }

}
