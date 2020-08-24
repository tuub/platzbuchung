<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('uid')->unique();
            $table->string('name');
            $table->text('address')->nullable();
            $table->text('email')->nullable();
            $table->string('logo_uri')->nullable();
            $table->string('image_uri')->nullable();
            $table->string('latitude')->nullable();
            $table->decimal('longitude')->nullable();
            $table->integer('display_days_in_advance')->default(10);
            $table->integer('user_booking_quota')->default(5);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
