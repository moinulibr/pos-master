<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountPaymentInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('account_payment_invoices')){
            Schema::create('account_payment_invoices', function (Blueprint $table) {
                $table->id();
                    $table->integer('branch_id')->nullable();
                    $table->string('payment_invoice_no',30)->nullable();
                    $table->string('payment_reference_no',50)->nullable();
                    $table->integer('main_module_id')->nullable()->comment('Module id like: Sell -> module no 2, Purchase -> module no 1, not sell return, not purchase return');
                    $table->string('main_module_invoice_no',30)->nullable()->comment('like: Sell invoice no, Purchase invoice no, not sell return, not purchase return');
                    $table->integer('main_module_invoice_id')->nullable()->comment('like: Sellinvoice->id, Purchaseinvoice->id, not sell return, not purchase return');;
                    $table->integer('module_id')->nullable()->comment('Current Module id like: Sell -> module no 2, Purchase -> module no 1, also sell return, purchase return');
                    $table->string('module_invoice_no',30)->nullable()->comment('Current Module id like: Sell -> module no 2, Purchase -> module no 1, and also, sell return moudle no 4, purchase return module no 3');
                    $table->integer('module_invoice_id')->nullable()->comment('Current all invoice id like: Sell ->invoice id, Purchase -> invoice id, and also, sell return invoice id, purchase return invoice id');

                    $table->text('payment_method_details')->nullable()->comment('payment method,payment option, bank option etc details , array json format');
                    $table->tinyInteger('cdf_type_id')->nullable()->comment('c=credit,d=debit,f=fund');
                    
                    $table->decimal('payment_amount',20,2)->default(0);
                    
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
        if(!Schema::hasTable('account_payment_invoices')){
        Schema::dropIfExists('account_payment_invoices');
        }
    }
}
