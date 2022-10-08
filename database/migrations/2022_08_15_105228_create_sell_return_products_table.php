<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellReturnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('sell_return_products')){
            Schema::create('sell_return_products', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->integer('sell_return_product_invoice_id')->nullable();
                $table->integer('sell_invoice_id')->nullable();
                $table->integer('sell_product_id')->nullable()->comment('sell product wise');
                $table->integer('sell_product_stock_id')->nullable()->comment('sell product stock wise');

                $table->integer('product_id')->nullable();
                $table->integer('stock_id')->nullable();
                $table->integer('product_stock_id')->nullable()->comment('product stock id');
                $table->decimal('quantity',20,3)->default(0);
                $table->decimal('sell_price',20,2)->nullable()->comment('sell price is now purchase price');
                $table->decimal('total_sell_price',20,2)->nullable()->comment('total sell price is now total purchase price');
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
        if(!Schema::hasTable('sell_return_products')){
        Schema::dropIfExists('sell_return_products');
        }
    }
}
