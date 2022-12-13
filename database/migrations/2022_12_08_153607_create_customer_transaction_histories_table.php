<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTransactionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('customer_transaction_histories')){
            Schema::create('customer_transaction_histories', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->integer('ledger_page_no')->nullable()->comment('ledger_page_no = manual ledger page no');
                $table->string('next_payment_date',30)->nullable();
                $table->string('created_date',30)->nullable();
                //customer transaction statement (cts)
                $table->integer('tt_module_id')->nullable()->comment('Module id (tt=transaction type)');
                $table->string('tt_module_invoice_no',30)->nullable()->comment('Module id (tt=transaction type)');
                $table->integer('tt_module_invoice_id')->nullable()->comment('Module id (tt=transaction type)');
                $table->text('sell_invoice_ids')->nullable()->comment('optional: sell invoice ids, array formated..when multiple sell invoice wise payment');
                
                $table->tinyInteger('cdf_type_id')->nullable()->comment('c=credit,d=debit,f=fund');
                $table->decimal('amount',20,2)->default(0);
                $table->decimal('cdc_amount',20,2)->default(0)->comment('after credit/debit calculation amount');
                
               $table->decimal('sell_amount',20,2)->default(00.00)->comment('only sell related data');
               $table->decimal('sell_paid',20,2)->default(00.00)->comment('only sell related data');
               $table->decimal('sell_due',20,2)->default(00.00)->comment('only sell related data');
                
                $table->integer('user_id')->nullable()->comment('user like: customer');
                $table->integer('received_by')->nullable();
                $table->string('short_note',255)->nullable();
                $table->tinyInteger('status')->nullable();
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
        if(!Schema::hasTable('customer_transaction_histories')){
        Schema::dropIfExists('customer_transaction_histories');
        }
    }
}
