<?php

namespace App\Http\Controllers\Backend\ProductAttribute;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductAttribute\SubCategory;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\Backend\ProductAttribute\Category;

//use Illuminate\Support\Facades\Validator;

use App\Http\Requests\Backend\ProductAttribute\SubCategoryValidationTrait;
use App\Traits\Backend\ProductAttribute\Unit\UnitTrait;
use App\Traits\Permission\Permission;
class SubCategoryController extends Controller
{
    use SubCategoryValidationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['datas'] = SubCategory::latest()->paginate(50);
        //return $this->callTraitForTest();
        return view('backend.product-attribute.sub-category.index',$data);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function subCategoryListByAjaxResponse(Request $request)
    {
        if($request->ajax())
        {
            $qry = SubCategory::query();
            if($request->search)
            {
                $qry->where('name','like','%'.$request->search.'%');
            }
            $data['datas'] = $qry->latest()->paginate(50);
            $html = view('backend.product-attribute.sub-category.ajax.list_ajax_response',$data)->render();
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
        $data['datas'] = Category::latest()->get();
        return view('backend.product-attribute.sub-category.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validators = $this->subCategoryValidationWhenStoreSubCategory($request->all());
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }

        $saveData =  auth()->user()->subCategoryUsers()->create($request->all());

        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Sub-category added successfully",
            'create_from'   => $request->create_from, // regular, another page name
            'data_id'       => $saveData->id,
            'data_name'     => $saveData->name,
            'data_created_class_name' => $request->created_from_class_name ?? "",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\ProductAttribute\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\ProductAttribute\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCategory $subCategory,Request $request)
    {
        $data['subCategory'] = SubCategory::findOrFail($request->id);
        $data['datas'] = Category::latest()->get();
        return view('backend.product-attribute.sub-category.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\ProductAttribute\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCategory $subCategory)
    {
        $validators = $this->subCategoryValidationWhenUpdateSubCategory($request->all(),$request->id);
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }
        $updateData = SubCategory::findOrFail($request->id);
        $updateData->update($request->all());
        //$updateData->created_by = Auth::user()->id;
        $updateData->save();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Sub-category updated successfully"
        ]);
    }

    
    public function delete(Category $unit, Request $request)
    {
        SubCategory::findOrFail($request->id)->delete();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Category Deleted successfully"
        ]);
    } 
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\ProductAttribute\SubCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCategory $subCategory)
    {
        //
    }



    
    //sub category by category id
    public function subCategoryBycategoryId(Request $request)
    {
        $subCates = SubCategory::where('category_id',$request->cat_id)->get();
        $html = "";
        if(count($subCates) > 0)
        {
            $html .= '<option value="" >'."Select Sub-category" . '</option>';
            foreach($subCates as $cat)
            {
                $html .= '<option value="'.$cat->id.'" >'.$cat->name . '</option>';
            }
        }else{
            $html .= '<option value="" >'."No Category Found" . '</option>';
        }
        return response()->json([
            'status' => true,
            'html'  => $html
        ]);
    }


    
}
