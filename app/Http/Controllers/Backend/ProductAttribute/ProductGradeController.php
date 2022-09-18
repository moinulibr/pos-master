<?php

namespace App\Http\Controllers\Backend\ProductAttribute;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductAttribute\ProductGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Validator;

use App\Http\Requests\Backend\ProductAttribute\ProductGradeValidationTrait;
use App\Traits\Backend\ProductAttribute\Unit\UnitTrait;
use App\Traits\Permission\Permission;
class ProductGradeController extends Controller
{
    use ProductGradeValidationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['datas'] = ProductGrade::latest()->paginate(50);
        //return $this->callTraitForTest();
        return view('backend.product-attribute.product-grade.index',$data);
    }
    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function productGradeListByAjaxResponse(Request $request)
    {
        $data['datas'] = ProductGrade::latest()->paginate(50);
        if($request->ajax())
        {
            $html = view('backend.product-attribute.product-grade.ajax.list_ajax_response',$data)->render();
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
        $data['datas'] = ProductGrade::latest()->get();
        return view('backend.product-attribute.product-grade.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validators = $this->productGradeValidationWhenStoreProductGrade($request->all());
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }

        $saveData =  auth()->user()->productGradeUsers()->create($request->all());

        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Product Grade added successfully",
            'create_from'   => $request->create_from, // regular, another page name
            'data_id'       => $saveData->id,
            'data_name'     => $saveData->name,
            'data_created_class_name' => $request->created_from_class_name ?? "",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\ProductAttribute\ProductGrade  $productGrade
     * @return \Illuminate\Http\Response
     */
    public function show(ProductGrade $productGrade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\ProductAttribute\ProductGrade  $productGrade
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductGrade $productGrade,Request $request)
    {
        $data['productGrade'] = ProductGrade::findOrFail($request->id);
        return view('backend.product-attribute.product-grade.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\ProductAttribute\ProductGrade  $productGrade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductGrade $productGrade)
    {
        $validators = $this->productGradeValidationWhenUpdateProductGrade($request->all(),$request->id);
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }
        $updateData = ProductGrade::findOrFail($request->id);
        $updateData->update($request->all());//auth()->user()->unitUsers()->
        $updateData->created_by = Auth::user()->id;
        $updateData->save();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Product Grade updated successfully"
        ]);
    }

    public function delete(ProductGrade $productGrade, Request $request)
    {
        ProductGrade::findOrFail($request->id)->delete();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Product Grade Deleted successfully"
        ]);
    } 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\ProductAttribute\ProductGrade  $productGrade
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductGrade $productGrade)
    {
        //
    }
}
