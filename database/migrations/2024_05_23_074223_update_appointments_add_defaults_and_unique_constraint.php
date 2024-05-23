<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::table('appointments', function (Blueprint $table) {
            // Add default values
            $table->date('date')->default('2024-01-01')->change();
            $table->time('time')->default('09:00:00')->change();
            $table->string('doctor')->default('Unknown')->change();

            // Add unique constraint
            $table->unique(['date', 'time', 'doctor'], 'unique_appointment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Drop unique constraint
            $table->dropUnique('unique_appointment');

            // Remove default values
            $table->date('date')->default(null)->change();
            $table->time('time')->default(null)->change();
            $table->string('doctor')->default(null)->change();
        });
    }
};
