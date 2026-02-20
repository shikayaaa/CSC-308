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
        Schema::create('subject_schedules', function (Blueprint $table) {
             $table->id();

    $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
    $table->foreignId('teacher_id')->nullable()->constrained()->nullOnDelete();

    $table->string('school_year');
    $table->enum('semester', ['1st', '2nd', 'summer']);

    $table->string('section_code');
    $table->enum('class_type', ['lecture', 'laboratory'])->default('lecture');

    $table->string('days');
    $table->time('time_start');
    $table->time('time_end');

    $table->string('room')->nullable();

    $table->unsignedSmallInteger('max_slots')->default(40);

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
        Schema::dropIfExists('subject_schedules');
    }
};
