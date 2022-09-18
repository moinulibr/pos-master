<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('references')){
            Schema::create('references', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->string('custom_id',30)->nullable();
                $table->string('name',150)->nullable();
                $table->string('email')->nullable();
                $table->timestamp('email_verified_at')->nullable();
                //$table->enum('user_type', ['official', 'client','supplier'])->nullable();
                $table->string('password')->nullable();

                $table->string('gender',10)->nullable();
                $table->string('phone',15)->unique()->nullable();
                $table->string('profession',50)->nullable();

                $table->string('phone_2',15)->unique()->nullable();

                $table->string('blood_group',20)->nullable();
                $table->string('religion',20)->nullable();
                $table->string('unique_id_no',30)->nullable(); //unique()
                $table->text('address')->nullable();
                $table->decimal('previous_due', 20, 2)->default(00.00);
                $table->string('previous_due_date',25)->nullable();
                $table->string('next_payment_date',25)->nullable();
                $table->text('note')->nullable();
                $table->tinyInteger('status')->nullable();
                $table->string('verified',25)->nullable();
                $table->integer('verified_by')->nullable();
                $table->integer('created_by')->nullable();
                $table->softDeletes();
                $table->rememberToken();

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
        Schema::dropIfExists('references');
    }
}
