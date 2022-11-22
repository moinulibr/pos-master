<?php

namespace App\Http\Controllers\Backend\Purchase\Details;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Backend\Sell\SellInvoice;
use App\Models\Backend\Purchase\PurchaseInvoice;

use App\Traits\Backend\Payment\PaymentProcessTrait;
class PurchaseController extends Controller
{
    use PaymentProcessTrait;
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


    //payment mmodal open with customer information and invoice information
    public function makeSingleInvoiceWisePayment(Request $request)
    {   
        $data['data'] = PurchaseInvoice::findOrFail($request->id);
        if($data['data'])
        {
            $data['cashAccounts'] = cashAccounts_hh();
            $data['advanceAccounts'] = advanceAccounts_hh();
            
            $html = view('backend.purchase.payment.single_payment',$data)->render();
            return response()->json([
                'status'    => true,
                'html'     => $html,
            ]);
        }else{
            return response()->json([
                'status'    => false,
            ]);
        }
    }

    //store receiving single invoice swise payment
    public function makingSingleInvoiceWisePayment(Request $request)
    {
        //return $request;
        DB::beginTransaction();
        try {
            //payment process
            if(($request->invoice_total_paying_amount ?? 0) > 0)
            {
                $invoiceData = PurchaseInvoice::findOrFail($request->purchase_invoice_id);
                //for payment processing 
                $this->mainPaymentModuleId = getModuleIdBySingleModuleLebel_hh('Purchase');
                $this->paymentModuleId = getModuleIdBySingleModuleLebel_hh('Purchase');
                $this->paymentCdfTypeId = getCdfIdBySingleCdfLebel_hh('Debit');
                $moduleRelatedData = [
                    'main_module_invoice_no' => $invoiceData->invoice_no,
                    'main_module_invoice_id' => $invoiceData->id,
                    'module_invoice_no' => $invoiceData->invoice_no,
                    'module_invoice_id' => $invoiceData->id,
                    'user_id' => $invoiceData->supplier_id,//client[customer,supplier,others staff]
                ];
                $this->paymentProcessingRequiredOfAllRequestOfModuleRelatedData = $moduleRelatedData;
                $this->paymentProcessingRelatedOfAllRequestData = paymentDataProcessingWhenSellingSubmitFromPos_hh($request);// $paymentAllData;
                $this->invoiceTotalPayingAmount = $request->invoice_total_paying_amount ?? 0 ;
                $this->processingPayment();

                //change amount from PurchaseInvoice 
                $invoiceData->paid_amount = $invoiceData->paid_amount + $request->invoice_total_paying_amount ?? 0;
                $invoiceData->due_amount = $invoiceData->due_amount - $request->invoice_total_paying_amount ?? 0;
                $invoiceData->total_paid_amount = $invoiceData->total_paid_amount + $request->invoice_total_paying_amount ?? 0;
                $invoiceData->save();
            } 
            DB::commit();

            $data['data'] = PurchaseInvoice::findOrFail($request->purchase_invoice_id);
            $data['cashAccounts'] = cashAccounts_hh();
            $data['advanceAccounts'] = advanceAccounts_hh();
            $html = view('backend.purchase.payment.single_payment',$data)->render();
            return response()->json([
                'status'    => true,
                'message'   => "Payment process successfully!",
                'type'      => 'success',
                'html'     => $html,
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return response()->json([
                'status'    => true,
                'message'   => "Something went wrong",
                'type'      => 'error'
            ]);
        }
    }
 
    


    //view single invoice Payment details
    public function viewSingleInvoicePaymentDetails(Request $request)
    {   
        $data['data'] = PurchaseInvoice::findOrFail($request->id);
        if($data['data'])
        {
            $html = view('backend.purchase.payment.view_single_payment',$data)->render();
            return response()->json([
                'status'    => true,
                'html'     => $html,
            ]);
        }else{
            return response()->json([
                'status'    => false,
            ]);
        }
    }


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
