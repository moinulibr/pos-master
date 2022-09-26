<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        if(!Schema::hasTable('purchase_invoices')){
            Schema::create('purchase_invoices', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->tinyInteger('purchase_type')->nullable()->comment('1=final purchase, 2=quatation , 3=draft, 4=others');
                $table->string('invoice_no',50)->nullable();
                $table->string('chalan_no',50)->nullable();
                $table->string('reference_no',50)->nullable();
                $table->string('attach_file',50)->nullable();
                $table->decimal('total_item',20,2)->nullable();
                $table->decimal('total_quantity',20,2)->nullable();
                $table->decimal('subtotal',20,2)->nullable();
                $table->decimal('discount_amount',20,2)->nullable();
                $table->string('discount_type',12)->nullable()->comment('percentage, fixed');
                $table->decimal('total_discount',20,2)->nullable();
                $table->decimal('vat_amount',20,2)->nullable();
                $table->decimal('total_vat',20,2)->nullable();
                $table->decimal('shipping_cost',20,2)->nullable();
                $table->decimal('others_cost',20,2)->nullable();
                $table->decimal('round_amount',20,2)->nullable();
                $table->string('round_type',2)->nullable()->comment('plus(+), minus(-)');
                $table->decimal('total_payable_amount',20,2)->nullable();
                $table->decimal('paid_amount',20,2)->nullable();
                $table->decimal('due_amount',20,2)->nullable();
                $table->string('adjustment_type',2)->nullable()->comment('plus(+), minus(-)');
                $table->decimal('adjustment_amount',20,2)->nullable();
                $table->decimal('refundable_amount',20,2)->nullable();
                $table->decimal('refunded_amount',20,2)->nullable();
                $table->decimal('refund_charge',20,2)->nullable()->comment('take from customer(comp profit)');
                $table->decimal('total_paid_amount',20,2)->nullable();
           
                $table->decimal('total_invoice_cost',20,2)->nullable()->comment('total invoice cost');
                $table->decimal('total_purchase_amount',20,2)->nullable()->comment('total invoice product purchase price');

                $table->string('payment_status',50)->nullable();
                $table->string('payment_type',20)->nullable();
                
                $table->integer('supplier_id')->nullable();
                $table->integer('supplier_type_id')->nullable()->comment('1=main supplier, 2=reseller');
                
                $table->text('shipping_note')->nullable();
                $table->text('receiver_details')->nullable();
                
                $table->text('purchase_note')->nullable();
                $table->string('purchase_date',25)->nullable();
              
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
        if(!Schema::hasTable('purchase_invoices')){
            Schema::dropIfExists('purchase_invoices');
        }
    }
}
