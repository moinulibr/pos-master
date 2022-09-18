<?php

namespace App\Http\Controllers\Backend\Warehouse;

use App\Http\Controllers\Controller;
use App\Models\Backend\Warehouse\WarehouseRack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\Backend\Warehouse\RackValidationTrait;
use App\Models\Backend\Warehouse\Warehouse;
use App\Traits\Backend\ProductAttribute\Unit\UnitTrait;
class WarehouseRackController extends Controller
{
    use RackValidationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['datas'] = WarehouseRack::latest()->paginate(50);
        return view('backend.warehouse.rack.index',$data);
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function warehouseRackListByAjaxResponse(Request $request)
    {
        if($request->ajax())
        {
            $qry = WarehouseRack::query();
            if($request->search)
            {
                $qry->where('name','like','%'.$request->search.'%');
            }
            $data['datas'] = $qry->latest()->paginate(50);
            $html = view('backend.warehouse.rack.ajax.list_ajax_response',$data)->render();
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
        $data['warehouses'] = Warehouse::latest()->get();
        return view('backend.warehouse.rack.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validators = $this->WarehouseRackValidationWhenStoreWarehouseRack($request->all());
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }

        $saveData =  auth()->user()->warehouseRackUsers()->create($request->all());

        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Warehouse Rack added successfully",
            'create_from'   => $request->create_from, // regular, another page name
            'data_id'       => $saveData->id,
            'data_name'     => $saveData->name,
            'data_created_class_name' => $request->created_from_class_name ?? "",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Warehouse\WarehouseRack  $warehouseRack
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseRack $warehouseRack)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Warehouse\WarehouseRack  $warehouseRack
     * @return \Illuminate\Http\Response
     */
    public function edit(WarehouseRack $warehouseRack,Request $request)
    {
        $data['warehouseRack']  = WarehouseRack::findOrFail($request->id);
        $data['datas']      = Warehouse::latest()->get();
        return view('backend.warehouse.rack.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Warehouse\WarehouseRack  $warehouseRack
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WarehouseRack $warehouseRack)
    {
        $validators = $this->WarehouseRackValidationWhenUpdateWarehouseRack($request->all(),$request->id);
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }
        $updateData = WarehouseRack::findOrFail($request->id);
        $updateData->update($request->all());//auth()->user()->unitUsers()->
        $updateData->created_by = Auth::user()->id;
        $updateData->save();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Warehouse Rack updated successfully"
        ]);
    }

      

    public function delete(WarehouseRack $WarehouseRack, Request $request)
    {
        WarehouseRack::findOrFail($request->id)->delete();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Warehouse Rack Deleted successfully"
        ]);
    } 



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Warehouse\WarehouseRack  $warehouseRack
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseRack $warehouseRack)
    {
        //
    }






    
    //sub category by category id
    public function warehouseRackByWarehouseId(Request $request)
    {
        $warehouses = WarehouseRack::where('warehouse_id',$request->warehouse_id)->get();
        $html = "";
        if(count($warehouses) > 0)
        {
            $html .= '<option value="" >'."Select Warehouse" . '</option>';
            foreach($warehouses as $warehouse)
            {
                $html .= '<option value="'.$warehouse->id.'" >'.$warehouse->name . '</option>';
            }
        }else{
            $html .= '<option value="" >'."No Warehouse Found" . '</option>';
        }
        return response()->json([
            'status' => true,
            'html'  => $html
        ]);
    }




}
