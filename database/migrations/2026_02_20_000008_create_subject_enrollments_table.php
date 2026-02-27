<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subject_enrollments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->restrictOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->restrictOnDelete();
            $table->foreignId('subject_schedule_id')->constrained('subject_schedules')->restrictOnDelete();
            $table->string('school_year', 9);
            $table->enum('semester', ['1st', '2nd', 'summer']);
            $table->decimal('midterm_grade', 5, 2)->nullable();
            $table->decimal('final_grade', 5, 2)->nullable();
            $table->string('remarks', 255)->nullable();
            $table->enum('enrollment_status', ['enrolled', 'dropped', 'withdrawn', 'completed'])->default('enrolled');
            $table->date('date_enrolled');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['student_id', 'subject_schedule_id'], 'uq_student_schedule');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subject_enrollments');
    }
};