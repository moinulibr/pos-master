<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseProductReceivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('purchase_product_receives')){
            Schema::create('purchase_product_receives', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();

                $table->string('invoice_no',50)->nullable();
                
                $table->integer('purchase_invoice_id')->nullable();
                $table->integer('purchase_product_id')->nullable()->comment('sell product wise');
                $table->integer('purchase_product_stock_id')->nullable()->comment('sell product stock wise');

                $table->integer('product_id')->nullable();
                $table->integer('stock_id')->nullable();
                $table->integer('product_stock_id')->nullable()->comment('product stock id');
                $table->decimal('quantity',20,3)->default(0);
                $table->tinyInteger('delivery_status')->nullable()->comment('receive status');
                
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
        if(!Schema::hasTable('purchase_product_receives')){
            Schema::dropIfExists('purchase_product_receives');
        }
    }
}
