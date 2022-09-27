<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('purchase_product_stocks')){
            Schema::create('purchase_product_stocks', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->integer('purchase_invoice_id')->nullable();
                $table->integer('purchase_product_id')->nullable();
                $table->integer('product_id')->nullable();

                $table->integer('stock_id')->nullable();
                $table->integer('product_stock_id')->nullable()->comment('product stock id');
                $table->decimal('total_quantity',20,3)->default(0);
                $table->decimal('mrp_price',20,2)->default(0);
                $table->decimal('regular_sell_price',20,2)->default(0);
                $table->decimal('purchase_price',20,2)->default(0);
                $table->decimal('total_purchase_price',20,2)->default(0);

                $table->decimal('ict_total_delivered_qty',20,3)->default(0)->comment('invoice creating time: deliverd mean: company delivered and we receive product');
                $table->decimal('ict_remaining_delivery_qty',20,3)->default(0)->comment('invoice creating time : deliverd mean: company delivered and we receive product : reamingin');
                
                $table->decimal('total_delivered_qty',20,3)->default(0)->comment('deliverd mean: company delivered and we receive product');
                $table->decimal('remaining_delivery_qty',20,3)->default(0)->comment('deliverd mean: company delivered and we receive product : reamingin');

                $table->tinyInteger('status')->nullable();
                $table->tinyInteger('delivery_status')->nullable();
                $table->integer('created_by')->nullable();

                $table->text('purchase_price_carts')->nullable()->comment('json: purchase prices all field only');

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
        if(!Schema::hasTable('purchase_product_stocks')){
            Schema::dropIfExists('purchase_product_stocks');
        }
    }
}
