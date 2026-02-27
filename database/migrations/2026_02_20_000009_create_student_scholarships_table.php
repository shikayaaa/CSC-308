<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_scholarships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('scholarship_name');
            $table->string('school_year', 9);
            $table->enum('semester', ['1st', '2nd', 'summer']);
            $table->enum('discount_type', ['percentage', 'fixed'])->default('percentage');
            $table->decimal('discount_value', 10, 2);
            $table->enum('status', ['active', 'revoked', 'expired'])->default('active');
            $table->string('granted_by')->nullable();
            $table->date('granted_at');
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->cascadeOnDelete();

            $table->unique(['student_id', 'scholarship_name', 'school_year', 'semester'], 'uq_student_scholarship_term');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_scholarships');
    }
};