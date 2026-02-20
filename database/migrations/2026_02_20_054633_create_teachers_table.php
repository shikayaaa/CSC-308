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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();

    $table->string('subject_code', 20)->unique();
    $table->string('descriptive_title');
    $table->text('description')->nullable();

    $table->unsignedTinyInteger('lecture_units');
    $table->unsignedTinyInteger('laboratory_units');

    // REMOVE storedAs (causes issues)
    // compute in model instead

    $table->string('subject_type')->default('major');
    $table->string('department')->nullable();
    $table->string('program')->nullable();
    $table->unsignedTinyInteger('year_level')->nullable();

    $table->enum('semester_offered', ['1st', '2nd', 'summer', 'both'])->default('both');

    $table->foreignId('prerequisite_id')
          ->nullable()
          ->constrained('subjects')
          ->nullOnDelete();

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
        Schema::dropIfExists('teachers');
    }
};
