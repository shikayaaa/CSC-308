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

            // Subject identification
            $table->string('subject_code', 20)->unique();       // e.g. "CS101"
            $table->string('descriptive_title', 150);           // e.g. "Introduction to Computing"
            $table->text('description')->nullable();

            // Units
            $table->unsignedTinyInteger('lecture_units');
            $table->unsignedTinyInteger('laboratory_units');

            // Classification
            $table->enum('subject_type', ['major', 'minor', 'elective', 'ge', 'nstp', 'pe'])
                  ->default('major');
            $table->string('department', 100)->nullable();
            $table->string('program', 100)->nullable();
            $table->unsignedTinyInteger('year_level')->nullable();
            $table->enum('semester_offered', ['1st', '2nd', 'summer', 'both'])
                  ->default('both');

            // Prerequisite (self-referencing)
            $table->unsignedBigInteger('prerequisite_id')->nullable();
            $table->foreign('prerequisite_id')
                  ->references('id')
                  ->on('subjects')
                  ->nullOnDelete();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};