<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('sell_quotations')){
            Schema::create('sell_quotations', function (Blueprint $table) {
                $table->id();
                $table->integer('sell_invoice_id')->nullable();
                $table->string('invoice_no',50)->nullable();

                $table->string('customer_name',150)->nullable();
                $table->string('phone',20)->nullable();
                $table->string('quotation_no',100)->nullable();
                $table->string('validate_date',30)->nullable();
                $table->text('quotation_note')->nullable();
                $table->string('sell_date',25)->nullable();
            
                $table->integer('created_by')->nullable();
                $table->string('verified',25)->nullable();
                $table->string('deleted_at',25)->nullable();
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
        Schema::dropIfExists('sell_quotations');
    }
}
