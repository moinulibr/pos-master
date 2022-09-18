<?php

namespace App;

use App\Models\Backend\Customer\Customer;
use App\Models\Backend\Customer\CustomerType;
use App\Models\Backend\Product\Product;
use App\Models\Backend\ProductAttribute\Brand;
use App\Models\Backend\ProductAttribute\Category;
use App\Models\Backend\ProductAttribute\Color;
use App\Models\Backend\ProductAttribute\ProductGrade;
use App\Models\Backend\ProductAttribute\SubCategory;
use App\Models\Backend\ProductAttribute\Unit;
use App\Models\Backend\Reference\Reference;
use App\Models\Backend\Supplier\Supplier;
use App\Models\Backend\Supplier\SupplierGroup;
use App\Models\Backend\Warehouse\Warehouse;
use App\Models\Backend\Warehouse\WarehouseRack;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    /*
    |------------------------------------------------------------
    | Units
    |----------------------------------------------------
    */
        public function unitUsers()
        {
            return $this->hasMany(Unit::class,'created_by','id');
        }
    /*
    |------------------------------------------------
    | Units
    |----------------------------------------------------------------
    */

    /*
    |------------------------------------------------------------
    | Brand
    |----------------------------------------------------
    */
        public function brandUsers()
        {
            return $this->hasMany(Brand::class,'created_by','id');
        }
    /*
    |-------------------------------------------------
    | Brand
    |---------------------------------------------------------------
    */

    /*
    |------------------------------------------------------------
    | Category
    |----------------------------------------------------
    */
        public function categoryUsers()
        {
            return $this->hasMany(Category::class,'created_by','id');
        }
    /*
    |------------------------------------------------
    | Category
    |----------------------------------------------------------------
    */


    /*
    |------------------------------------------------------------
    | SubCategory
    |----------------------------------------------------
    */
        public function subCategoryUsers()
        {
            return $this->hasMany(SubCategory::class,'created_by','id');
        }
    /*
    |------------------------------------------------
    | SubCategory
    |----------------------------------------------------------------
    */


    /*
    |------------------------------------------------------------
    | Customer
    |----------------------------------------------------
    */
        public function customerUsers()
        {
            return $this->hasMany(Customer::class,'created_by','id');
        }
    /*
    |------------------------------------------------
    | Customer
    |----------------------------------------------------------------
    */

    /*
    |------------------------------------------------------------
    | CustomerType
    |----------------------------------------------------
    */
        public function customerTypeUsers()
        {
            return $this->hasMany(CustomerType::class,'created_by','id');
        }
    /*
    |------------------------------------------------
    | CustomerType
    |----------------------------------------------------------------
    */


    /*
    |------------------------------------------------------------
    | Supplier
    |----------------------------------------------------
    */
        public function supplierUsers()
        {
            return $this->hasMany(Supplier::class,'created_by','id');
        }
    /*
    |------------------------------------------------
    | Supplier
    |----------------------------------------------------------------
    */


    /*
    |------------------------------------------------------------
    | SupplierGroup
    |----------------------------------------------------
    */
        public function supplierGroupUsers()
        {
            return $this->hasMany(SupplierGroup::class,'created_by','id');
        }
    /*
    |------------------------------------------------
    | SupplierGroup
    |----------------------------------------------------------------
    */



    /*
    |------------------------------------------------------------
    | Color
    |----------------------------------------------------
    */
        public function colorUsers()
        {
            return $this->hasMany(Color::class,'created_by','id');
        }
    /*
    |------------------------------------------------
    | Color
    |----------------------------------------------------------------
    */

    /*
    |------------------------------------------------------------
    | Product 
    |----------------------------------------------------
    */
        public function productGradeUsers()
        {
            return $this->hasMany(ProductGrade::class,'created_by','id');
        }
    /*
    |------------------------------------------------
    | Product Grade
    |----------------------------------------------------------------
    */


    /*
    |------------------------------------------------------------
    | Product
    |----------------------------------------------------
    */
        public function productUsers()
        {
            return $this->hasMany(Product::class,'created_by','id');
        }
    /*
    |------------------------------------------------
    | Product
    |----------------------------------------------------------------
    */


    /*
    |------------------------------------------------------------
    | Warehouse
    |----------------------------------------------------
    */
        public function warehouseUsers()
        {
            return $this->hasMany(Warehouse::class,'created_by','id');
        }
    /*
    |------------------------------------------------
    | Warehouse
    |----------------------------------------------------------------
    */


    /*
    |------------------------------------------------------------
    | Warehouse rack
    |----------------------------------------------------
    */
        public function warehouseRackUsers()
        {
            return $this->hasMany(WarehouseRack::class,'created_by','id');
        }
    /*
    |------------------------------------------------
    | Warehouse rack
    |----------------------------------------------------------------
    */


    /*
    |------------------------------------------------------------
    | Reference
    |----------------------------------------------------
    */
        public function referenceUsers()
        {
            return $this->hasMany(Reference::class,'created_by','id');
        }
    /*
    |------------------------------------------------
    | Reference
    |----------------------------------------------------------------
    */





        //return Auth::user()->rolePermission('module','action');
        public function rolePermission($module,$action)
        {
            return "moinul";
        }//perfect working


}
