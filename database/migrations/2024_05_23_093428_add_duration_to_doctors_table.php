<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDurationToDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->integer('appointment_duration')->default(30); // Assuming appointment duration is in minutes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn('appointment_duration');
        });
    }
}