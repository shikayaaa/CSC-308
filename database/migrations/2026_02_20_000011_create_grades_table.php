<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('teacher_id');
            $table->string('school_year', 9);
            $table->enum('semester', ['1st', '2nd', 'summer']);
            $table->decimal('midterm_grade', 5, 2)->nullable();
            $table->decimal('finals_grade', 5, 2)->nullable();
            $table->decimal('final_grade', 5, 2)->nullable();
            $table->enum('remarks', ['passed', 'failed', 'incomplete', 'dropped', 'withdrawn'])->nullable();
            $table->boolean('is_released')->default(false);
            $table->timestamp('released_at')->nullable();
            $table->timestamps();

            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->restrictOnDelete();

            $table->foreign('subject_id')
                  ->references('id')->on('subjects')
                  ->restrictOnDelete();

            $table->foreign('teacher_id')
                  ->references('id')->on('teachers')
                  ->restrictOnDelete();

            $table->unique(['student_id', 'subject_id', 'school_year', 'semester'], 'uq_student_subject_term');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};