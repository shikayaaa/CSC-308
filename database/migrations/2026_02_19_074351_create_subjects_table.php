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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();

            // Subject identification
            $table->string('subject_code', 20)->unique();       // e.g. "CS101", "MATH201"
            $table->string('descriptive_title', 150);           // e.g. "Introduction to Computing"
            $table->text('description')->nullable();            // longer course description

            // Academic units
            $table->unsignedTinyInteger('lecture_units');       // units for lecture hours
            $table->unsignedTinyInteger('laboratory_units');    // units for lab hours (0 if none)
            $table->unsignedTinyInteger('total_units')          // computed but stored for quick reference
                  ->storedAs('lecture_units + laboratory_units');

            // Classification
            $table->enum('subject_type', ['major', 'minor', 'elective', 'ge', 'nstp', 'pe'])
                  ->default('major');
            $table->string('department', 100)->nullable();      // owning department
            $table->string('program', 100)->nullable();         // e.g. "BSCS", "BSIT"
            $table->unsignedTinyInteger('year_level')           // recommended year level 1-5
                  ->nullable();
            $table->enum('semester_offered', ['1st', '2nd', 'summer', 'both'])
                  ->default('both');

            // Prerequisite (self-referencing)
            $table->unsignedBigInteger('prerequisite_id')->nullable();
            $table->foreign('prerequisite_id')
                  ->references('id')
                  ->on('subjects')
                  ->nullOnDelete();

            // Status
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
        Schema::dropIfExists('subjects');
    }
};