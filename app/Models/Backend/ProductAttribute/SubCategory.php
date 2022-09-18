<?php

namespace App\Models\Backend\ProductAttribute;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SubCategory extends Model
{
    use SoftDeletes;
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    protected $table = 'sub_categories';
    //protected $primaryKey = 'GROUP_ROLE_ID';
    protected $fillable = [
        'category_id','branch_id','name','description','note','verified','deleted_at','verified_by','created_by'
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
}
