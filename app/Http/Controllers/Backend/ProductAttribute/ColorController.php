<?php

namespace App\Http\Controllers\Backend\ProductAttribute;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductAttribute\Color;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Validator;

use App\Http\Requests\Backend\ProductAttribute\ColorValidationTrait;
use App\Traits\Backend\ProductAttribute\Unit\UnitTrait;
use App\Traits\Permission\Permission;
class ColorController extends Controller
{
    use ColorValidationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['datas'] = Color::latest()->paginate(50);
        //return $this->callTraitForTest();
        return view('backend.product-attribute.color.index',$data);
    }

     /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function colorListByAjaxResponse(Request $request)
    {
        if($request->ajax())
        {
            $qry = Color::query();
            if($request->search)
            {
                $qry->where('name','like','%'.$request->search.'%');
            }
            $data['datas'] = $qry->latest()->paginate(50);
            $html = view('backend.product-attribute.color.ajax.list_ajax_response',$data)->render();
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
          /* $this->unitId = 0;
        $unit = $this->getUnitByUnitId();
        if($unit['status'] == true){
           return $unit['unit']->full_name;
        }else{
            return "nai";
        } */
        $data['datas'] = Color::latest()->get();
        return view('backend.product-attribute.color.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validators = $this->colorValidationWhenStoreColor($request->all());
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }

        $saveData =  auth()->user()->colorUsers()->create($request->all());

        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Color added successfully",
            'create_from'   => $request->create_from, // regular, another page name
            'data_id'       => $saveData->id,
            'data_name'     => $saveData->name,
            'data_created_class_name' => $request->created_from_class_name ?? "",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\ProductAttribute\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\ProductAttribute\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color, Request $request)
    {
        $data['color'] = Color::findOrFail($request->id);
        return view('backend.product-attribute.color.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\ProductAttribute\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        $validators = $this->colorValidationWhenUpdateColor($request->all(),$request->id);
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }
        $updateData = Color::findOrFail($request->id);
        $updateData->update($request->all());//auth()->user()->unitUsers()->
        $updateData->created_by = Auth::user()->id;
        $updateData->save();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Color updated successfully"
        ]);
    }
    public function delete(Color $color, Request $request)
    {
        Color::findOrFail($request->id)->delete();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Color Deleted successfully"
        ]);
    } 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\ProductAttribute\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        //
    }
}
