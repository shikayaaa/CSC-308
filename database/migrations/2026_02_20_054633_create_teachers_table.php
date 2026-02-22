<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();

            // Personal info
            $table->string('employee_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('contact_number', 20)->nullable();

            // Academic info
            $table->string('department', 100)->nullable();
            $table->string('specialization', 150)->nullable();
            $table->enum('employment_type', ['full-time', 'part-time', 'contractual'])
                  ->default('full-time');
            $table->enum('status', ['active', 'inactive', 'on-leave', 'resigned'])
                  ->default('active');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};