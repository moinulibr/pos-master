<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('banks')){
            Schema::create('banks', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                
                $table->string('name',100)->nullable();
                $table->string('short_name',50)->nullable();
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
        if(!Schema::hasTable('banks')){
        Schema::dropIfExists('banks');
        }
    }
}
