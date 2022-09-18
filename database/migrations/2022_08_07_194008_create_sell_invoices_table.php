<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('sell_invoices')){
            Schema::create('sell_invoices', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->tinyInteger('sell_type')->nullable()->comment('1=final sell, 2=quatation , 3=draft, 4=others');
                $table->string('invoice_no',50)->nullable();
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
                $table->decimal('reference_amount',20,2)->nullable();
                $table->decimal('total_purchase_amount',20,2)->nullable();
                $table->decimal('total_invoice_profit',20,2)->nullable()->comment('from products price only');

                $table->string('payment_status',50)->nullable();
                $table->string('payment_type',20)->nullable();
                
                $table->integer('customer_id')->nullable();
                $table->integer('customer_type_id')->nullable()->comment('1=Permanent, 2=Temporary');
                $table->integer('shipping_id')->nullable();
                $table->text('shipping_note')->nullable();
                $table->text('receiver_details')->nullable();
                $table->integer('reference_id')->nullable();
                $table->text('sell_note')->nullable();
                $table->string('sell_date',25)->nullable();
                //$table->tinyInteger('product_stock_type')->nullable()->comment('1=single, 2=multiple');
            
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
        Schema::dropIfExists('sell_invoices');
    }
}
