<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->enum('document_type', [
                'birth_certificate',
                'form_138',
                'good_moral',
                'transcript_of_records',
                'diploma',
                'id_photo',
                'medical_certificate',
                'other',
            ]);
            $table->string('file_path');
            $table->string('original_filename');
            $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->string('verified_by')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('student_id')
                  ->references('id')->on('students')
                  ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_documents');
    }
};