<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreOptionsToLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->tinyInteger('allowed_minutes_for_pre_check_in')->unsigned()->default(0);
            $table->boolean('is_pre_check_in_displayed')->default(false);
            $table->tinyInteger('seconds_until_check_in_refresh')->unsigned()->default(5);
            $table->tinyInteger('seconds_until_check_out_refresh')->unsigned()->default(5);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('allowed_minutes_for_pre_check_in');
            $table->dropColumn('is_pre_check_in_displayed');
            $table->dropColumn('seconds_until_check_in_refresh');
            $table->dropColumn('seconds_until_check_out_refresh');
        });
    }
}
