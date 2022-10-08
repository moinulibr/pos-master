<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellProductDeliveryInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('sell_product_delivery_invoices')){
            Schema::create('sell_product_delivery_invoices', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->string('invoice_no',50)->nullable();
                $table->string('sell_invoice_no',50)->nullable();
                $table->integer('sell_invoice_id')->nullable();

                $table->string('delivery_note',250)->nullable();

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
        if(!Schema::hasTable('sell_product_delivery_invoices')){
        Schema::dropIfExists('sell_product_delivery_invoices');
        }
    }
}
