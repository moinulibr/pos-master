<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('payment_options')){
            Schema::create('payment_options', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                
                $table->string('name',50)->nullable();
                $table->text('description')->nullable();
               
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
        if(!Schema::hasTable('payment_options')){
        Schema::dropIfExists('payment_options');
        }
    }
}
