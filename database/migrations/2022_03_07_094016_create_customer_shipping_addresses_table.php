<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerShippingAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('customer_shipping_addresses')){
            Schema::create('customer_shipping_addresses', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->integer('customer_id')->nullable();
                
                $table->integer('country_id')->nullable();
                $table->integer('district_id')->nullable();
                $table->integer('thana_id')->nullable();
                
                $table->string('post',100)->nullable();
                $table->string('postal_code',50)->nullable();

                $table->string('email')->nullable();
                $table->string('phone',15)->nullable();
                $table->string('phone_2',15)->nullable();
                $table->text('address')->nullable();
                $table->text('note')->nullable();

                $table->tinyInteger('status')->nullable();
                $table->string('verified',25)->nullable();
                $table->integer('verified_by')->nullable();
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
        Schema::dropIfExists('customer_shipping_addresses');
    }
}
