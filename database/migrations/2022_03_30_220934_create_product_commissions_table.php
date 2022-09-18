<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('product_commissions')){
            Schema::create('product_commissions', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->integer('commission_type_id')->nullable();
                $table->integer('product_id')->nullable();
                $table->integer('price_id')->nullable();
                
                $table->decimal('minimum_amount',20,2)->nullable();
                $table->decimal('maximum_amount',20,2)->nullable();
                
                $table->tinyInteger('conditional_status')->default(0)->comment(
                    '0. regular process(min,max limit. and at last purchase price),   1. break regular process
                    (commission any amount. its for special)'
                );

                $table->string('verified',25)->nullable();
                $table->integer('verified_by')->nullable();
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
        Schema::dropIfExists('product_commissions');
    }
}
