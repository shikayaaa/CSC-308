<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This table records the enrollment of a student in a subject
     * for a specific school year and semester (one row per subject per term).
     */
    public function up(): void
    {
        Schema::create('subject_enrolled', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')
                  ->references('id')
                  ->on('students')
                  ->cascadeOnDelete();

            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')
                  ->references('id')
                  ->on('subjects')
                  ->cascadeOnDelete();

            // Term information (matches what's on a load slip)
            $table->string('school_year', 9);                   // e.g. "2024-2025"
            $table->enum('semester', ['1st', '2nd', 'summer']);

            // Grade tracking
            $table->decimal('midterm_grade', 5, 2)->nullable();
            $table->decimal('final_grade', 5, 2)->nullable();
            $table->string('remarks', 20)->nullable();          // e.g. "Passed", "Failed", "INC", "DRP"

            // Enrollment meta
            $table->enum('enrollment_status', ['enrolled', 'dropped', 'withdrawn', 'completed'])
                  ->default('enrolled');
            $table->date('date_enrolled');

            // The user (registrar/staff) who encoded this enrollment
            // $table->unsignedBigInteger('encoded_by')->nullable();
            // $table->foreign('encoded_by')
            //       ->references('id')
            //       ->on('users')
            //       ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();

            // A student can only enroll in the same subject once per term
            $table->unique(['student_id', 'subject_id', 'school_year', 'semester'], 'unique_enrollment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_enrolled');
    }
};