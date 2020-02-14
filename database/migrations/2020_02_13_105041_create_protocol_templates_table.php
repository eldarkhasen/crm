<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocolTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocol_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->text('patient_problems')->nullable();
            $table->text('anamnesis_vitae')->nullable();
            $table->text('anamnesis_morbi')->nullable();
            $table->text('objective_data')->nullable();
            $table->text('xray_data')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('visual_inspection')->nullable();
            $table->text('bite')->nullable();
            $table->text('work_done')->nullable();
            $table->text('treatment_plan')->nullable();
            $table->text('recommendations')->nullable();
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
        Schema::dropIfExists('protocol_templates');
    }
}
