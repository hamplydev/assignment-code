<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            // $table->id();
            $table->increments('id');
            $table->string('code');
            $table->string('first_name',255);
            $table->string('last_name',255)->nullable();
            $table->boolean('gender')->default('0')->comment('0 for female & 1 for male');;
            $table->date('date_of_birth')->nullable();
            $table->string('ID_card_no')->nullable();
            $table->string('phone',50)->nullable();
            $table->string('email',255)->unique();
            $table->string('address')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedInteger('department_id')->nullable();
            $table->unsignedInteger('position_id')->nullable();
            $table->date('joined_date')->nullable();
            $table->date('resigned_date')->nullable();
            $table->string('resigned_type')->nullable();
            $table->char('working_start_time',25)->nullable();
            $table->char('working_end_time',25)->nullable();
            $table->decimal('basic_salary', 10, 0)->unsigned();
            // $table->enum('status', ['0', '1'])->default(1)->comment('0 for active & 1 for delete');
            $table->boolean('status')->default('1')->comment('0 for delete & 1 for active');
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
