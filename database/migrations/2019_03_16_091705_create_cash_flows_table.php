<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_flows', function (Blueprint $table) {
            $table->increments('id');
            $table->date('cash_flow_date');
            $table->unsignedInteger('payment_item_id')->index();
            $table->foreign('payment_item_id')->references('id')->on('payment_items')->onDelete('cascade');
            $table->unsignedInteger('cash_box_id')->index();
            $table->foreign('cash_box_id')->references('id')->on('cash_boxes')->onDelete('cascade');
            $table->unsignedInteger('employee_id')->index()->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->unsignedInteger('patient_id')->index()->nullable();
            $table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->unsignedInteger('user_created_id')->index()->nullable();
            $table->foreign('user_created_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('appointment_id')->index()->nullable();
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->integer('amount');
            $table->string('comments')->nullable();
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
        Schema::dropIfExists('cash_flows');
    }
}
