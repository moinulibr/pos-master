<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('stocks')){
            Schema::create('stocks', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->string('name',100)->nullable()->comment('
                    use lowercase and underline between tow word,like:regular_stock');
                $table->string('label',100)->nullable()->comment('
                    use as name ,like: Regular Stock');
                $table->text('description')->nullable();
                $table->string('verified',25)->nullable();
                $table->integer('verified_by')->nullable();
                $table->tinyInteger('status')->nullable();
                $table->tinyInteger('use_in')->nullable()->comment('use in pos,and others. show this row if 1=use');
                $table->tinyInteger('custom_serial')->nullable();
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
        Schema::dropIfExists('stocks');
    }
}
