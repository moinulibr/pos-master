<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('account_payments')){
            Schema::create('account_payments', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->string('payment_invoice_no',30)->nullable();
                $table->string('payment_reference_no',50)->nullable();
                $table->integer('module_id')->nullable()->comment('Module id like: Sell -> module no 1, Purchase -> module no 2');
                $table->string('module_invoice_no',30)->nullable();
                $table->integer('module_invoice_id')->nullable();
                $table->integer('account_id')->nullable();
                $table->integer('payment_method_id')->nullable();
                $table->text('payment_method_details')->nullable()->comment('payment method,payment option, bank option etc details , array json format');
                $table->tinyInteger('cdf_type_id')->nullable()->comment('c=credit,d=debit,f=fund');
                $table->tinyInteger('payment_type_id')->nullable()->comment('1=full payment, 2=partial payment');
                
                $table->decimal('payment_amount',20,2)->default(0);
                $table->decimal('cdc_amount',20,2)->default(0)->comment('after credit/debit calculation amount');
                
                $table->integer('user_id')->nullable()->comment('user like: customer, supplier,office staff and others user');

                $table->integer('received_by')->nullable();
                $table->string('payment_date',30)->nullable();
                $table->string('next_payment_date',30)->nullable();

                $table->text('description')->nullable();
                $table->text('payment_note')->nullable();
                $table->string('attached_file',5)->nullable();
            
                $table->string('sms_send',3)->nullable()->comment('sms send, yes, no');
                $table->string('email_send',3)->nullable()->comment('email send, yes, no');
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
        if(!Schema::hasTable('account_payments')){
        Schema::dropIfExists('account_payments');
        }
    }
}
