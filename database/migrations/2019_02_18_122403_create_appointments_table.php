<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('employee_id');
//            $table->integer('service_id');
            $table->integer('patient_id');
            $table->string('start');
            $table->string('end');
            $table->integer('price');
            $table->enum('status', ['pending', 'success', 'client_miss']);
            $table->text('xray_data')->nullable();
            $table->text('patient_problems')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('anamnesis_vitae')->nullable();
            $table->text('anamnesis_morbi')->nullable();
            $table->text('visual_inspection')->nullable();
            $table->text('bite')->nullable();
            $table->text('work_done')->nullable();
            $table->text('recommendations')->nullable();
            $table->text('treatment_plan')->nullable();
            $table->text('objective_data')->nullable();
            $table->boolean('active');
            $table->string('color')->default("#1ABC9C");
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
        Schema::dropIfExists('appointments');
    }
}
