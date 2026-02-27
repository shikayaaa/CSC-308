<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('code', 20)->unique();                   // e.g. CCS, CBA, COE
            $table->string('name');                                  // e.g. College of Computer Studies
            $table->string('dean_name')->nullable();
            $table->string('contact_number', 20)->nullable();
            $table->string('email')->nullable();
            $table->string('building')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};