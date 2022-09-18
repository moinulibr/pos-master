<?php

namespace App\Http\Controllers\Backend\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Backend\Warehouse\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Backend\Warehouse\WarehouseValidationTrait;
use App\Traits\Backend\ProductAttribute\Unit\UnitTrait;
class WarehouseController extends Controller
{
    use WarehouseValidationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['datas'] = Warehouse::latest()->paginate(50);
        //return $this->callTraitForTest();
        return view('backend.warehouse.warehouse.index',$data);
    }


    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function warehouseListByAjaxResponse(Request $request)
    {
        if($request->ajax())
        {
            $qry = Warehouse::query();
            if($request->search)
            {
                $qry->where('name','like','%'.$request->search.'%');
            }
            $data['datas'] = $qry->latest()->paginate(50);
            $html = view('backend.warehouse.warehouse.ajax.list_ajax_response',$data)->render();
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
        return view('backend.warehouse.warehouse.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validators = $this->warehouseValidationWhenStoreWarehouse($request->all());
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }

        $saveData =  auth()->user()->warehouseUsers()->create($request->all());

        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Warehouse added successfully",
            'create_from'   => $request->create_from, // regular, another page name
            'data_id'       => $saveData->id,
            'data_name'     => $saveData->name,
            'data_created_class_name' => $request->created_from_class_name ?? "",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Warehouse\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Warehouse\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse,Request $request)
    {
        $data['warehouse'] = Warehouse::findOrFail($request->id);
        return view('backend.warehouse.warehouse.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Warehouse\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $validators = $this->warehouseValidationWhenUpdateWarehouse($request->all(),$request->id);
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }
        $updateData = Warehouse::findOrFail($request->id);
        $updateData->update($request->all());//auth()->user()->unitUsers()->
        $updateData->created_by = Auth::user()->id;
        $updateData->save();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Warehouse updated successfully"
        ]);
    }


    
    public function delete(Warehouse $Warehouse, Request $request)
    {
        Warehouse::findOrFail($request->id)->delete();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Warehouse Deleted successfully"
        ]);
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Warehouse\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        //
    }
}
