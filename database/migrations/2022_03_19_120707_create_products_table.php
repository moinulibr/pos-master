<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('products')){
            Schema::create('products', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->string('custom_code',30)->nullable();
                $table->string('company_code',30)->nullable();
                $table->text('slug')->nullable();
                $table->string('sku',30)->nullable();
                $table->string('bacode',30)->nullable();
                $table->text('name')->nullable();
                $table->text('variants')->nullable();
                $table->string('photo',5)->nullable();
                $table->integer('supplier_id')->nullable();
                $table->integer('category_id')->nullable();
                $table->integer('sub_category_id')->nullable();
                $table->integer('brand_id')->nullable();
                $table->integer('product_grade_id')->nullable();
                $table->integer('unit_id')->nullable();
                $table->integer('supplier_group_id')->nullable();
                $table->integer('color_id')->nullable();

                $table->integer('warehouse_id')->nullable();
                $table->integer('warehouse_rack_id')->nullable();

                /* $table->decimal('purchase_price',20,2)->nullable();
                $table->decimal('mrp_price',20,2)->nullable();
                $table->decimal('whole_sell_price',20,2)->nullable();
                $table->decimal('sell_price',20,2)->nullable();
                $table->decimal('offer_price',20,2)->nullable(); */

                $table->decimal('initial_stock',20,3)->nullable();

                $table->decimal('alert_stock',20,3)->nullable();
                
                $table->decimal('available_stock',20,3)->nullable()->comment('multiple with calculation_result');
                $table->decimal('available_base_stock',20,3)->nullable()->comment('no change, same to product purchase unit');

                $table->text('description')->nullable();
                $table->tinyInteger('discount_status')->default(0);
                $table->tinyInteger('commission_status')->default(0);
            
                $table->tinyInteger('liability_after_sell')->default(0);

                $table->text('note')->nullable();
                $table->tinyInteger('status')->nullable();
                $table->string('verified',25)->nullable();
                $table->integer('verified_by')->nullable();
                $table->integer('created_by')->nullable();
                $table->softDeletes();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
