<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellReturnProductInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('sell_return_product_invoices')){
            Schema::create('sell_return_product_invoices', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->string('invoice_no',50)->nullable();
                $table->string('sell_invoice_no',50)->nullable();
                $table->integer('sell_invoice_id')->nullable();
                $table->integer('customer_id')->nullable();
                
                $table->decimal('quantity',20,3)->default(0);

                $table->decimal('subtotal_before_discount',20,2)->nullable();
                
                $table->decimal('discount_amount',20,2)->nullable();
                $table->string('discount_type',12)->nullable()->comment('percentage, fixed');
                $table->decimal('total_discount',20,2)->nullable();

                $table->decimal('total_amount_after_discount',20,2)->nullable();

                $table->decimal('round_amount',20,2)->nullable();
                $table->string('round_type',2)->nullable()->comment('plus(+), minus(-)');
                $table->decimal('total_payable_amount',20,2)->nullable();
                $table->decimal('paid_amount',20,2)->nullable();
                $table->decimal('due_amount',20,2)->nullable();
               
               
                $table->tinyInteger('return_status')->nullable();

                $table->string('payment_status',50)->nullable();

                $table->string('return_note',250)->nullable();
                $table->string('receive_note',250)->nullable();
                $table->string('return_date',30)->nullable();

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
        if(!Schema::hasTable('sell_return_product_invoices')){
        Schema::dropIfExists('sell_return_product_invoices');
        }
    }
}
