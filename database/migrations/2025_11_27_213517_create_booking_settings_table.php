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
        Schema::create('booking_settings', function (Blueprint $table) {
            $table->id();
            $table->json('working_days')->nullable();
            $table->time('start_time')->default('09:00:00');
            $table->time('end_time')->default('17:00:00');
            $table->integer('slot_duration')->default(30); // minutes
            $table->integer('buffer_time')->default(0); // minutes between appointments
            $table->integer('max_appointments_per_slot')->default(1);
            $table->integer('max_appointments_per_day')->nullable();
            $table->integer('advance_booking_days')->default(30); // how far in advance users can book
            $table->integer('minimum_notice_hours')->default(24); // minimum hours before appointment
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_settings');
    }
};
