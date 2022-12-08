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
                $table->integer('tt_invoice_id')->nullable()->comment('tt=transaction type');
                $table->string('tt_invoice_no',30)->nullable()->comment('tt=transaction type');
                
                $table->integer('ledger_page_no')->nullable()->comment('ledger_page_no = manual ledger page no');
                $table->string('next_payment_date',30)->nullable();
                $table->string('created_date',30)->nullable();

                $table->integer('module_id')->nullable()->comment('customer transaction statement (cts) Module id (tt=transaction type)');
                $table->string('module_invoice_no',30)->nullable()->comment('customer transaction statement (cts) Module id (tt=transaction type)');
                $table->integer('module_invoice_id')->nullable()->comment('customer transaction statement (cts) Module id (tt=transaction type)');
                

                $table->tinyInteger('cdf_type_id')->nullable()->comment('c=credit,d=debit,f=fund');
                $table->decimal('amount',20,2)->default(0);
                $table->decimal('cdc_amount',20,2)->default(0)->comment('after credit/debit calculation amount');
                
               $table->decimal('sell_amount',20,2)->default(00.00)->comment('only sell related data');
               $table->decimal('sell_paid',20,2)->default(00.00)->comment('only sell related data');
               $table->decimal('sell_due',20,2)->default(00.00)->comment('only sell related data');
                
             

                $table->integer('user_id')->nullable()->comment('user like: customer, supplier,office staff and others user');
                $table->integer('received_by')->nullable();
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
