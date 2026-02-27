<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();
            $table->string('name');
            $table->string('building')->nullable();
            $table->string('floor')->nullable();
            $table->unsignedSmallInteger('capacity');
            $table->enum('type', ['lecture', 'laboratory', 'seminar', 'gymnasium', 'auditorium'])->default('lecture');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};