<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeServiceTable extends Migration
{
    public function up()
    {
        Schema::create('employee_service', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('employee_id')->index();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

            $table->unsignedInteger('service_id')->index();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
//        Schema::table('employee_service', function (Blueprint $table) {
//           $table->dropForeign(['employee_id', 'service_id']);
//        });
        Schema::dropIfExists('employee_service');
    }
}
