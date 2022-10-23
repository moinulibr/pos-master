<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountPaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('account_payment_details')){
            Schema::create('account_payment_details', function (Blueprint $table) {
                $table->integer('branch_id')->nullable();
                $table->integer('account_payment_id')->nullable();
                $table->string('payment_invoice_no',30)->nullable();
                $table->string('payment_reference_no',50)->nullable();
                $table->integer('module_id')->nullable()->comment('Module id like: Sell -> module no 1, Purchase -> module no 2');
                $table->string('module_invoice_no',30)->nullable();
                $table->integer('account_id')->nullable();
                $table->integer('payment_method_id')->nullable();
                $table->string('transaction_no',250)->nullable()->comment('all transaction no/id');
                $table->string('payment_date',30)->nullable();
                
                $table->text('payment_options')->nullable()->comment('payment method,payment option, bank option, mobile banking, card ,bank transfer etc details , array json format');
                
                $table->tinyInteger('cdf_type_id')->nullable()->comment('c=credit,d=debit,f=fund');
               
                $table->decimal('payment_amount',20,2)->default(0);
                
                $table->tinyInteger('status')->nullable()->comment('status');
                
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
        if(!Schema::hasTable('account_payment_details')){
        Schema::dropIfExists('account_payment_details');
        }
    }
}
