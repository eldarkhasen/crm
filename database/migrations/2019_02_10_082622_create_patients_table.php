<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('surname');
            $table->string('patronymic');
            $table->string('phone')->unique();
            $table->string("birth_date");
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('id_card')->nullable();
            $table->string('id_number')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->integer('discount')->nullable();
            $table->string('photoname')->nullable();
            $table->string('mime')->nullable();
            $table->string('original_photoname')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
