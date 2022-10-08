<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellProductDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('sell_product_deliveries')){
            Schema::create('sell_product_deliveries', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->integer('sell_product_delivery_invoice_id')->nullable();
                $table->integer('sell_invoice_id')->nullable();
                $table->integer('sell_product_id')->nullable()->comment('sell product wise');
                $table->integer('sell_product_stock_id')->nullable()->comment('sell product stock wise');

                $table->integer('product_id')->nullable();
                $table->integer('stock_id')->nullable();
                $table->integer('product_stock_id')->nullable()->comment('product stock id');
                $table->decimal('quantity',20,3)->default(0);
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
        if(!Schema::hasTable('sell_product_deliveries')){
            Schema::dropIfExists('sell_product_deliveries');
        }
    }
}
