<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkins', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->uuid('booking_id');
            $table->dateTimeTz('check_in')->nullable();
            $table->dateTimeTz('check_out')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate(null)->onDelete(null);
            $table->foreign('booking_id')->references('id')->on('bookings')->onUpdate(null)->onDelete(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkins');
    }
}
