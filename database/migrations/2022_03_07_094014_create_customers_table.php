<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('customers')){
            Schema::create('customers', function (Blueprint $table) {
                $table->id();
                $table->integer('branch_id')->nullable();
                $table->integer('customer_type_id')->nullable();
                $table->string('custom_id',30)->nullable();
                $table->string('name',150)->nullable();
                $table->string('email')->nullable();
                $table->timestamp('email_verified_at')->nullable();
                //$table->enum('user_type', ['official', 'client','supplier'])->nullable();
                $table->string('password')->nullable();

                $table->string('gender',10)->nullable();
                $table->string('phone',15)->unique()->nullable();
                $table->string('phone_2',15)->unique()->nullable();

                $table->string('blood_group',20)->nullable();
                $table->string('religion',20)->nullable();
                $table->string('unique_id_no',30)->nullable();//->unique()
                $table->string('company_name',100)->nullable();
                $table->text('address')->nullable();

                $table->decimal('ct_sell_invoice_amount', 20, 2)->default(00.00)->comment('creating time.just keep it, not change - before started this app');
                $table->decimal('previous_sell_invoice_amount', 20, 2)->default(00.00)->comment('before started this app');
                $table->decimal('current_sell_invoice_amount', 20, 2)->default(00.00)->comment('during using this app');
                $table->decimal('total_sell_invoice_amount', 20, 2)->default(00.00)->comment('previous + current sell invoice total amount');
 

                $table->decimal('ct_previous_due', 20, 2)->default(00.00)->comment('creating time.just keep it, not change - before started this app');
                $table->decimal('previous_due', 20, 2)->default(00.00)->comment('before started this app');
                $table->decimal('current_due', 20, 2)->default(00.00)->comment('during using this app');
                $table->decimal('total_due', 20, 2)->default(00.00)->comment('previous + current due');
 
                $table->decimal('previous_paid', 20, 2)->default(00.00)->comment('before started this app');
                $table->decimal('current_paid', 20, 2)->default(00.00)->comment('during using this app');
                $table->decimal('total_paid', 20, 2)->default(00.00)->comment('previous + current paid');
                
                $table->decimal('previous_loan', 20, 2)->default(00.00)->comment('before started this app');
                $table->decimal('current_loan', 20, 2)->default(00.00)->comment('during using this app');
                $table->decimal('total_loan', 20, 2)->default(00.00)->comment('previous + current loan');
            
                $table->decimal('previous_advance', 20, 2)->default(00.00)->comment('before started this app');
                $table->decimal('current_advance', 20, 2)->default(00.00)->comment('during using this app');
                $table->decimal('total_advance', 20, 2)->default(00.00)->comment('previous + current advance');

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
        Schema::dropIfExists('customers');
    }
}
