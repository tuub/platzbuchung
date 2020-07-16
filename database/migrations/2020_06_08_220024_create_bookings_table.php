<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('bookings');
        Schema::create('bookings', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->date('date');
            $table->dateTimeTz('start');
            $table->dateTimeTz('end');
            $table->unsignedBigInteger('resource_id');
            $table->unsignedBigInteger('time_slot_id');
            $table->timestamps();
            $table->foreign('resource_id')->references('id')->on('resources')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('time_slot_id')->references('id')->on('time_slots')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
