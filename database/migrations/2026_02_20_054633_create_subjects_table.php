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

    $table->foreignId('student_id')->nullable()->constrained()->nullOnDelete();

    $table->string('employee_id')->unique();
    $table->string('first_name');
    $table->string('last_name');
    $table->string('email')->unique();
    $table->string('contact_number')->nullable();

    $table->string('department')->nullable();
    $table->string('specialization')->nullable();

    $table->enum('employment_type', ['full-time', 'part-time', 'contractual'])->default('full-time');
    $table->enum('status', ['active', 'inactive', 'on-leave', 'resigned'])->default('active');

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
