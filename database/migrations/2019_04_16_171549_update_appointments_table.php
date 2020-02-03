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
        Schema::table('appointments', function($table) {
            $table->dropColumn('service_id');
            $table->integer('price');
            $table->enum('status', ['pending', 'success', 'client_miss']);
            $table->text('status_comment')->nullable();
            $table->text('patient_problems')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('anamnesis_vitae')->nullable();
            $table->text('anamnesis_morbi')->nullable();
            $table->text('objective_evaluation')->nullable();
            $table->text('work_done')->nullable();
            $table->boolean('active');
            $table->string('color')->default("#1ABC9C");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointments', function($table) {
            $table->integer('service_id');
            $table->dropColumn('price');
            $table->dropColumn('status');
            $table->dropColumn('status_comment');
        });
    }
}
