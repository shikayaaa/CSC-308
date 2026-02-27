<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subject_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained('subjects')->restrictOnDelete();
            $table->foreignId('teacher_id')->constrained('teachers')->restrictOnDelete();
            $table->foreignId('room_id')->constrained('rooms')->restrictOnDelete();
            $table->string('school_year', 9);
            $table->enum('semester', ['1st', '2nd', 'summer']);
            $table->string('section_code', 20);
            $table->enum('class_type', ['lecture', 'laboratory']);
            $table->string('days', 255);
            $table->time('time_start');
            $table->time('time_end');
            $table->unsignedSmallInteger('max_slots');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['room_id', 'school_year', 'semester', 'days', 'time_start'], 'uq_room_schedule');
            $table->unique(['teacher_id', 'school_year', 'semester', 'days', 'time_start'], 'uq_teacher_schedule');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subject_schedules');
    }
};