<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseProductReceiveInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('purchase_product_receive_invoices')){
            Schema::create('purchase_product_receive_invoices', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();

                $table->string('invoice_no',50)->nullable();
                $table->string('purchase_invoice_no',50)->nullable();
                $table->integer('purchase_invoice_id',50)->nullable();

                $table->decimal('quantity',20,3)->default(0);

                $table->string('purchase_chalan_no',50)->nullable();
                $table->string('purchase_reference_no',50)->nullable();
                $table->integer('supplier_id')->nullable();
                $table->string('received_from',150)->nullable();
                $table->string('received_invo_cln_ref_no',150)->nullable();
                $table->text('receive_note')->nullable();
                
                $table->tinyInteger('delivery_status')->nullable()->comment('receive status');
                $table->string('received_at',30)->nullable();
                
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
        if(!Schema::hasTable('purchase_product_receive_invoices')){
        Schema::dropIfExists('purchase_product_receive_invoices');
        }
    }
}
