<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('program_id')->constrained('programs')->restrictOnDelete();
            $table->string('student_number', 20)->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->unsignedTinyInteger('year_level');
            $table->enum('status', ['active', 'inactive', 'graduated', 'dropped'])->default('active');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};