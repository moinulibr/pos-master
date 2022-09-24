<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseProductPricesesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('purchase_product_priceses')){
            Schema::create('purchase_product_priceses', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->integer('purchase_invoice_id')->nullable();
                $table->integer('purchase_product_id')->nullable();
                $table->integer('product_id')->nullable();
                $table->integer('price_id')->nullable();
                $table->integer('stock_id')->nullable();
                $table->integer('product_stock_id')->nullable()->comment('product stock id');
                $table->decimal('price',20,2)->default(0);
                $table->decimal('price_name',20,2)->default(0);
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
        if(!Schema::hasTable('purchase_product_priceses')){
            Schema::dropIfExists('purchase_product_priceses');
        }
    }
}
