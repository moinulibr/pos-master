<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('accounts')){
            Schema::create('accounts', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();

                $table->integer('payment_method_id')->nullable()->comment('same to payment_option_id');
                $table->integer('banking_option_id')->nullable();
                $table->integer('bank_id')->nullable();
                
                $table->string('account_name',200)->nullable();
                $table->string('account_no',100)->nullable();
                $table->decimal('opening_amount',20,2)->default(0);
               
                $table->string('contact_person_name',250)->nullable();
                $table->string('contact_person_phone',20)->nullable();
                $table->text('description')->nullable();
                $table->text('address')->nullable();
               
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
        if(!Schema::hasTable('accounts')){
        Schema::dropIfExists('accounts');
        }
    }
}
