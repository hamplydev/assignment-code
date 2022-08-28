<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            // $table->id();
            $table->increments('id');
            $table->unsignedInteger('employee_id');
            $table->date('date');
            $table->char('check_time')->nullable();
            $table->char('time_in')->nullable();
            $table->char('time_out')->nullable();
            $table->char('check_type')->nullable();
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
        Schema::dropIfExists('attendances');
    }
}
