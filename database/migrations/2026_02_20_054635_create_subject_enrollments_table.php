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
        Schema::create('subject_enrollments', function (Blueprint $table) {
         $table->id();

    $table->foreignId('student_id')->constrained()->cascadeOnDelete();
    $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
    $table->foreignId('subject_schedule_id')->nullable()->constrained()->nullOnDelete();

    $table->string('school_year');
    $table->enum('semester', ['1st', '2nd', 'summer']);

    $table->decimal('midterm_grade', 5, 2)->nullable();
    $table->decimal('final_grade', 5, 2)->nullable();
    $table->string('remarks')->nullable();

    $table->enum('enrollment_status', ['enrolled', 'dropped', 'withdrawn', 'completed'])
          ->default('enrolled');

    $table->date('date_enrolled');

    $table->timestamps();
    $table->softDeletes();

    // fix soft delete uniqueness issue
    $table->unique([
        'student_id',
        'subject_id',
        'school_year',
        'semester',
        'deleted_at'
    ], 'unique_enrollment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_enrollments');
    }
};
