<?php

namespace App\Http\Controllers\Backend\Reference;

use App\Http\Controllers\Controller;
use App\Models\Backend\Reference\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Support\Facades\Validator;

use App\Http\Requests\Backend\Reference\ReferenceValidationTrait;
use App\Models\Backend\Reference\ReferenceType;
use App\Traits\Backend\ProductAttribute\Unit\UnitTrait;
use App\Traits\Permission\Permission;
class ReferenceController extends Controller
{
    use ReferenceValidationTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['datas'] = Reference::latest()->paginate(50);
        return view('backend.reference.reference.index',$data);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function referenceListByAjaxResponse(Request $request)
    {
        if($request->ajax())
        {   
            $qry = Reference::query();
            if($request->search)
            {
                $qry->where('name','like','%'.$request->search.'%')
                    ->orWhere('phone','like','%'.$request->search.'%')
                    ->orWhere('email','like','%'.$request->search.'%')
                    ->orWhere('custom_id','like','%'.$request->search.'%');
            }
            $data['datas'] = $qry->latest()->paginate(50);
            $html = view('backend.reference.reference.ajax.list_ajax_response',$data)->render();
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
        return view('backend.reference.reference.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validators = $this->referenceValidationWhenStoreReference($request->all());
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }

        $saveData =  auth()->user()->referenceUsers()->create($request->all());

        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Reference added successfully",
            'create_from'   => $request->create_from, // regular, another page name
            'data_id'       => $saveData->id,
            'data_name'     => $saveData->name,
            'data_created_class_name' => $request->created_from_class_name ?? "",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Reference\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function show(Reference $reference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Reference\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function edit(Reference $reference, Request $request)
    {
        $data['reference'] = Reference::findOrFail($request->id);
        return view('backend.reference.reference.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Reference\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reference $reference)
    {
        $validators = $this->referenceValidationWhenUpdateReference($request->all(),$request->id);
        if($validators['status'] == true)
        {
            return response()->json([
                'status' => 'errors',
                'error'=> $validators['errors']->getMessageBag()->toArray()
            ]);
        }
        $updateData = Reference::findOrFail($request->id);
        $updateData->update($request->all());//auth()->user()->unitUsers()->
        $updateData->created_by = Auth::user()->id;
        $updateData->save();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Reference updated successfully"
        ]);
    }



      
    public function delete(Reference $reference, Request $request)
    {
        Reference::findOrFail($request->id)->delete();
        return response()->json([
            'status' => true,
            'type' => 'success',
            'message' => "Reference Deleted successfully"
        ]);
    } 


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Reference\Reference  $reference
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reference $reference)
    {
        //
    }
}
