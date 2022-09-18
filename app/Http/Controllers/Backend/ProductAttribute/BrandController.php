<?php

namespace App\Http\Controllers\Backend\ProductAttribute;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductAttribute\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Validator;

use App\Http\Requests\Backend\ProductAttribute\BrandValidationTrait;
use App\Traits\Backend\ProductAttribute\Unit\UnitTrait;
use App\Traits\Permission\Permission;
class BrandController extends Controller
{
    use BrandValidationTrait;
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['datas'] = Brand::latest()->paginate(50);
        //return $this->callTraitForTest();
        return view('backend.product-attribute.brand.index',$data);
    }

     /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function brandListByAjaxResponse(Request $request)
    {
        if($request->ajax())
        {
            $qry = Brand::query();
            if($request->search)
            {
                $qry->where('name','like','%'.$request->search.'%');
            }
            $data['datas'] = $qry->latest()->paginate(50);
            $html = view('backend.product-attribute.brand.ajax.list_ajax_response',$data)->render();
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
        $data['datas'] = Brand::latest()->get();
        return view('backend.product-attribute.brand.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validators = $this->brandValidationWhenStoreBrand($request->all());
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }

        $saveData =  auth()->user()->brandUsers()->create($request->all());

        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Brand added successfully",
            'create_from'   => $request->create_from, // regular, another page name
            'data_id'       => $saveData->id,
            'data_name'     => $saveData->name,
            'data_created_class_name' => $request->created_from_class_name ?? "",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\ProductAttribute\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\ProductAttribute\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand,Request $request)
    {
        $data['brand'] = Brand::findOrFail($request->id);
        return view('backend.product-attribute.brand.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\ProductAttribute\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $validators = $this->brandValidationWhenUpdateBrand($request->all(),$request->id);
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }
        $updateData = Brand::findOrFail($request->id);
        $updateData->update($request->all());//auth()->user()->unitUsers()->
        $updateData->created_by = Auth::user()->id;
        $updateData->save();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Brand updated successfully"
        ]);
    }
    public function delete(Brand $brand, Request $request)
    {
        Brand::findOrFail($request->id)->delete();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Brand Deleted successfully"
        ]);
    } 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\ProductAttribute\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
