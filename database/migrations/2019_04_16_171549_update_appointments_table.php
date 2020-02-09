<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('appointments', function($table) {
//            $table->dropColumn('service_id');
//            $table->integer('price');
//            $table->enum('status', ['pending', 'success', 'client_miss']);
//            $table->text('xray_data')->nullable();
//            $table->text('patient_problems')->nullable();
//            $table->text('diagnosis')->nullable();
//            $table->text('anamnesis_vitae')->nullable();
//            $table->text('anamnesis_morbi')->nullable();
//            $table->text('visual_inspection')->nullable();
//            $table->text('bite')->nullable();
//            $table->text('work_done')->nullable();
//            $table->text('recommendations')->nullable();
//            $table->boolean('active');
//            $table->string('color')->default("#1ABC9C");
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('appointments', function($table) {
//            $table->dropColumn('price');
//            $table->dropColumn('status');
//        });
    }
}
