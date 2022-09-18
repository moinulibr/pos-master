<?php

namespace App\Http\Controllers\Backend\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Backend\Supplier\SupplierGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Validator;

use App\Http\Requests\Backend\Supplier\SupplierGroupValidationTrait;
use App\Traits\Permission\Permission;
class SupplierGroupController extends Controller
{
    use SupplierGroupValidationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['datas'] = SupplierGroup::latest()->paginate(50);
        //return $this->callTraitForTest();
        return view('backend.supplier.supplier-group.index',$data);
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function supplierGroupListByAjaxResponse(Request $request)
    {
        if($request->ajax())
        {
            $qry = SupplierGroup::query();
            if($request->search)
            {
                $qry->where('name','like','%'.$request->search.'%')
                ->orWhere('company_name','like','%'.$request->search.'%');
            }
            $data['datas'] = $qry->latest()->paginate(50);
            $html = view('backend.supplier.supplier-group.ajax.list_ajax_response',$data)->render();
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
        $data['datas'] = SupplierGroup::latest()->get();
        return view('backend.supplier.supplier-group.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validators = $this->supplierGroupValidationWhenStoreSupplierGroup($request->all());
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }

        $saveData =  auth()->user()->supplierGroupUsers()->create($request->all());

        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Supplier Group added successfully",
            'create_from'   => $request->create_from, // regular, another page name
            'data_id'       => $saveData->id,
            'data_name'     => $saveData->name,
            'data_created_class_name' => $request->created_from_class_name ?? "",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Supplier\SupplierGroup  $supplierGroup
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierGroup $supplierGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Supplier\SupplierGroup  $supplierGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierGroup $supplierGroup,Request $request)
    {
        $data['supplierGroup'] = SupplierGroup::findOrFail($request->id);
        return view('backend.supplier.supplier-group.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Supplier\SupplierGroup  $supplierGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplierGroup $supplierGroup)
    {
        $validators = $this->supplierGroupValidationWhenUpdateSupplierGroup($request->all(),$request->id);
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }
        $updateData = SupplierGroup::findOrFail($request->id);
        $updateData->update($request->all());//auth()->user()->unitUsers()->
        $updateData->created_by = Auth::user()->id;
        $updateData->save();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Supplier Groupd updated successfully"
        ]);
    }

    
    public function delete(SupplierGroup $supplierGroup, Request $request)
    {
        SupplierGroup::findOrFail($request->id)->delete();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Supplier Groupd Deleted successfully"
        ]);
    } 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Supplier\SupplierGroup  $supplierGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierGroup $supplierGroup)
    {
        //
    }
}
