<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('units')){
            Schema::create('units', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->string('full_name',170)->nullable();
                $table->string('short_name',30)->nullable();
                $table->integer('parent_id')->default(0);
                $table->decimal('parent_cal_result',20,3)->nullable();
                $table->decimal('calculation_value',20,3)->nullable();
                $table->decimal('calculation_result',20,3)->nullable();
                $table->integer('base_unit_id')->nullable();
                $table->text('description')->nullable();
                
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
        Schema::dropIfExists('units');
    }
}
