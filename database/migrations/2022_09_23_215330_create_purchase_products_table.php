<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('purchase_products')){
            Schema::create('purchase_products', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->integer('purchase_invoice_id')->nullable();
                $table->integer('product_id')->nullable();
                $table->integer('unit_id')->nullable();
                $table->integer('supplier_id')->nullable()->comment('main supplier id (product owner supplier)');
                
                $table->tinyInteger('product_stock_type')->nullable()->comment('1=single, 2=multiple');
                
                $table->string('custom_code',50)->nullable()->comment('product custom_code');
                $table->decimal('quantity',20,3)->nullable();

                $table->decimal('discount_amount',20,2)->nullable();
                $table->string('discount_type',12)->nullable()->comment('percentage, fixed');
                $table->decimal('total_discount',20,2)->nullable();

                $table->decimal('total_purchase_price',20,2)->nullable();

                $table->text('carts')->nullable()->comment('json:p.name,custom_code,unit_name,purchase_price,whole_sell_price,regular_price,others');
                
                $table->text('stock_id_carts')->nullable()->comment('json: all stocks id here');
                $table->text('price_id_carts')->nullable()->comment('json: all prices id here');
                $table->text('product_purchase_prices_carts')->nullable()->comment('json:all product price (when purchase and change prices or not) here of a single products.format:- {"1":{"4":"120","4=price_id":"120=Price"},{"1=stock_id":{"price"}}}');

                $table->tinyInteger('status')->nullable();
                $table->tinyInteger('delivery_status')->nullable();

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
        if(!Schema::hasTable('purchase_products')){
            Schema::dropIfExists('purchase_products');
        }
    }
}
