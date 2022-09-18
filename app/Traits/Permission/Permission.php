<?php

namespace App\Traits\Permission;

use Illuminate\Support\Facades\Auth;

trait Permission
{

    protected $id;

    


    /**for private property only */
        private $extension;
    /**for private property only */

    
    /*
    |---------------------------------------------------------------------------------------------
    |   Store Image
    | return image extension/imageName after inserting image by some property 
        $this->destination  = ;  //its mandatory 
        $this->imageWidth   = ;  //its mandatory
        $this->imageHeight  = ;  //its nullable
        $this->file         = ;  //its mandatory
        $this->storeImage();
    | by call this  method....
    |---------------------------------------------------------------------------------------------
    */
        public function callTraitForTest() 
        {
            return Auth::id();
            $permissions =  json_decode(json_encode(config('permissions')), FALSE);
            dd($permissions[0]->allowed);
            dd($permissions[0]->name);
            return ;
            return config('permissions');
        }
    /*
    |---------------------------------------------------------------------------------------------
    | End image insert
    |---------------------------------------------------------------------------------------------
    */
       

    

}
