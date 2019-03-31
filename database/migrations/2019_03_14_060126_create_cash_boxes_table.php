<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashBoxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_boxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('initial_balance');
            $table->integer('current_balance')->default(0);
            $table->integer('income')->default(0);
            $table->integer('expanse')->default(0);
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
        Schema::dropIfExists('cash_boxes');
    }
}
