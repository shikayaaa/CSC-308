<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained('programs')->restrictOnDelete();
            $table->foreignId('department_id')->constrained('departments')->restrictOnDelete(); // ✅ FK to departments
            $table->unsignedBigInteger('prerequisite_id')->nullable();                          // self-ref added below
            $table->string('subject_code', 20)->unique();
            $table->string('descriptive_title', 150);
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('lecture_units')->default(0);
            $table->unsignedTinyInteger('laboratory_units')->default(0);
            $table->enum('subject_type', ['major', 'minor', 'elective', 'ge', 'nstp', 'pe']);
            $table->unsignedTinyInteger('year_level');
            $table->enum('semester_offered', ['1st', '2nd', 'summer', 'both']);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        // Add self-referencing FK after table exists
        Schema::table('subjects', function (Blueprint $table) {
            $table->foreign('prerequisite_id', 'fk_subject_prerequisite')
                  ->references('id')->on('subjects')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropForeign('fk_subject_prerequisite');
        });
        Schema::dropIfExists('subjects');
    }
};