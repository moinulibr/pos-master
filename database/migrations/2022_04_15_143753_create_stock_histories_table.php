<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('stock_histories')){
            Schema::create('stock_histories', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->integer('stock_id')->nullable()->comment('main character');
                $table->integer('product_stock_id')->nullable()->comment('main character');
                $table->integer('product_id')->nullable()->comment('main character');
                $table->integer('stock_changing_type_id')->nullable();
                $table->string('stock_changing_sign',5)->nullable()->comment('it alway + or -');
                $table->text('stock_changing_history')->nullable()->comment('json data store here from stock id to stock id');

                $table->decimal('stock',20,3)->nullable()->comment('real product (as product purchase unit) stock');
              
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
        Schema::dropIfExists('stock_histories');
    }
}
