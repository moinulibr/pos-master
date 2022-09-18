<?php

namespace App\Http\Controllers\Backend\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Backend\Supplier\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Validator;

use App\Http\Requests\Backend\Supplier\SupplierValidationTrait;
use App\Models\Backend\Supplier\SupplierType;
use App\Traits\Backend\ProductAttribute\Unit\UnitTrait;
use App\Traits\Permission\Permission;
class SupplierController extends Controller
{
    use SupplierValidationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['datas']  = Supplier::latest()->paginate(50);
        $data['typies'] = SupplierType::latest()->get();
        return view('backend.supplier.supplier.index',$data);
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function supplierListByAjaxResponse(Request $request)
    {
        if($request->ajax())
        {
            $qry = Supplier::query();

            if(!empty($request->supplier_type_id) && empty($request->search))
            {
                $qry->where('supplier_type_id',$request->supplier_type_id);
            }
            else if(!empty($request->search) && empty($request->supplier_type_id))
            {
                $qry->where('name','like','%'.$request->search.'%')
                    ->orWhere('phone','like','%'.$request->search.'%')
                    ->orWhere('email','like','%'.$request->search.'%')
                    ->orWhere('custom_id','like','%'.$request->search.'%');
                    //->orWhere('company_name','like','%'.$request->search.'%');
            }
            else if(!empty($request->search) && !empty($request->supplier_type_id))
            {
                $qry->where('supplier_type_id',$request->supplier_type_id)
                    ->where('name','like','%'.$request->search.'%')
                    ->orWhere('phone','like','%'.$request->search.'%')
                    ->orWhere('email','like','%'.$request->search.'%')
                    ->orWhere('custom_id','like','%'.$request->search.'%');
                    //->orWhere('company_name','like','%'.$request->search.'%');
            }
            
            $data['datas'] = $qry->latest()->paginate(50);
            $html = view('backend.supplier.supplier.ajax.list_ajax_response',$data)->render();
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
        $data['datas'] = SupplierType::latest()->get();
        return view('backend.supplier.supplier.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validators = $this->supplierValidationWhenStoreSupplier($request->all());
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }

        $saveData =  auth()->user()->supplierUsers()->create($request->all());
        
        return response()->json([
            'status'        => true,
            'type'          => 'success',
            'message'       => "Supplier added successfully",
            'create_from'   => $request->create_from, // regular, another page name
            'data_id'       => $saveData->id,
            'data_name'     => $saveData->name,
            'data_created_class_name' => $request->created_from_class_name ?? "",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Supplier\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Supplier\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier,Request $request)
    {
        $data['supplier'] = Supplier::findOrFail($request->id);
        $data['datas'] = SupplierType::latest()->get();
        return view('backend.supplier.supplier.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Supplier\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validators = $this->supplierValidationWhenUpdateSupplier($request->all(),$request->id);
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }
        $updateData = Supplier::findOrFail($request->id);
        $updateData->update($request->all());//auth()->user()->unitUsers()->
        $updateData->created_by = Auth::user()->id;
        $updateData->save();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Supplier updated successfully"
        ]);
    }

    
    public function delete(Supplier $supplier, Request $request)
    {
        Supplier::findOrFail($request->id)->delete();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Supplier Deleted successfully"
        ]);
    } 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Supplier\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
