<?php

namespace App\Http\Controllers\Backend\ProductAttribute;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ProductAttribute\UnitRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\ProductAttribute\Unit;

use App\Traits\Backend\ProductAttribute\Unit\Request\UnitValidationTrait;
use App\Traits\Backend\ProductAttribute\Unit\Logical\UnitTrait;
use App\Traits\Permission\Permission;

class UnitController extends Controller
{
    use Permission;
    use UnitTrait, UnitValidationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['datas'] = Unit::latest()->paginate(50);
        return view('backend.product-attribute.unit.index',$data);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function unitListByAjaxResponse(Request $request)
    {
        if($request->ajax())
        {
            $qry = Unit::query();
            if($request->search)
            {
                $qry->where('full_name','like','%'.$request->search.'%')
                ->orWhere('short_name','like','%'.$request->search.'%');
            }
            $data['datas'] = $qry->latest()->paginate(50);
            $html = view('backend.product-attribute.unit.ajax.unit_list_ar',$data)->render();
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
        $data['datas'] = Unit::latest()->get();
        return view('backend.product-attribute.unit.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validators = $this->unitValidationWhenStoreUnit($request->all());
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }
      
        $saveData =  auth()->user()->unitUsers()->create($request->all());

        $this->unitId = $request->parent_id;
        $unit = $this->getUnitByUnitId();
        $calculationResult = $request->calculation_value;
        $parent_cal_result = NULL;
        if($unit['status'] == true){
            $calculationResult =  $unit['unit']->calculation_result * $request->calculation_value;
            $parent_cal_result = $unit['unit']->calculation_result;
        }
        $saveData->calculation_result   = $calculationResult;
        $saveData->parent_cal_result    = $parent_cal_result;

        $this->unitId = $request->base_unit_id;
        $unit = $this->getUnitByUnitId();
        $baseUnitId = $request->base_unit_id;
        if($unit['status'] == true){
            $baseUnitId =  $unit['unit']->id;
        }
        //$saveData->created_by = Auth::user()->id;
        $saveData->base_unit_id = $request->base_unit_id == 0 ? $saveData->id : $baseUnitId;
        $saveData->save();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Unit added successfully",
            'create_from'   => $request->create_from, // regular, another page name
            'data_id'       => $saveData->id,
            'data_name'     => $saveData->short_name,
            'data_created_class_name' => $request->created_from_class_name ?? "",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\ProductAttribute\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\ProductAttribute\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit, Request $request)
    {
        $data['unit'] = Unit::findOrFail($request->id);
        $data['datas'] = Unit::latest()->get();
        return view('backend.product-attribute.unit.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\ProductAttribute\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        $validators = $this->unitValidationWhenUpdateUnit($request->all(),$request->id);
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }
        $updateData = Unit::findOrFail($request->id);
        $updateData->update($request->all());//auth()->user()->unitUsers()->

        $this->unitId   = $request->parent_id;
        $unit           = $this->getUnitByUnitId();
        $calculationResult = $request->calculation_value;
        $parent_cal_result = NULL;
        if($unit['status'] == true){
            $calculationResult =  $unit['unit']->calculation_result * $request->calculation_value;
            $parent_cal_result = $unit['unit']->calculation_result;
        }
        $updateData->calculation_result = $calculationResult;
        $updateData->parent_cal_result  = $parent_cal_result;

        $this->unitId = $request->base_unit_id;
        $unit = $this->getUnitByUnitId();
        $baseUnitId = $request->base_unit_id;
        if($unit['status'] == true){
            $baseUnitId =  $unit['unit']->id;
        }
        //$updateData->created_by = Auth::user()->id;
        $updateData->base_unit_id = $request->base_unit_id == 0 ? $updateData->id : $baseUnitId;
        $updateData->save();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Unit updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\ProductAttribute\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function delete(Unit $unit, Request $request)
    {
        $unit = Unit::findOrFail($request->id);
        $unit->delete();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Unit Deleted successfully"
        ]);
    } 

    public function destroy(Unit $unit)
    {
        //
    }
}
