<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This table stores the schedule (section) for a subject offering per term.
     * A subject can have multiple sections; students in subject_enrolled are
     * linked here to know which section/schedule they belong to.
     */
    public function up(): void
    {
        Schema::create('subject_schedule', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')
                  ->references('id')
                  ->on('subjects')
                  ->cascadeOnDelete();

            // Instructor / faculty (references users table)
            // $table->unsignedBigInteger('instructor_id')->nullable();
            // $table->foreign('instructor_id')
            //       ->references('id')
            //       ->on('users')
            //       ->nullOnDelete();

            // Term
            $table->string('school_year', 9);                  // e.g. "2024-2025"
            $table->enum('semester', ['1st', '2nd', 'summer']);

            // Section info
            $table->string('section_code', 20);                // e.g. "BSCS3A", "IT201-B"
            $table->enum('class_type', ['lecture', 'laboratory'])->default('lecture');

            // Schedule
            $table->string('days', 50);                        // e.g. "Mon,Wed,Fri"
            $table->time('time_start');
            $table->time('time_end');

            // Room/location
            $table->string('room', 50)->nullable();            // e.g. "Room 301", "AVR-2"

            // Capacity
            $table->unsignedSmallInteger('max_slots')->default(40);
            $table->unsignedSmallInteger('current_slots')->default(0);

            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_schedule');
    }
};