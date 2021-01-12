<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->nullable();
            $table->float('standarthours', 5, 2)->nullable();
            $table->float('overtimehours', 5, 2)->nullable();
            $table->float('internalhours', 5, 2)->nullable();
            $table->integer('user_id');
            $table->integer('tour');
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
        Schema::dropIfExists('hours');
    }
}
