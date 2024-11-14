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
        Schema::create('student_therapists', function (Blueprint $table) {
            $table->id();
             // Foreign key to the students table
             $table->foreignId('student_id')->constrained()->onDelete('cascade');
             // Foreign key to the therapists table
             $table->foreignId('therapist_id')->constrained()->onDelete('cascade');
             // Optional fields, e.g., a field to track when therapy sessions started
             $table->date('started_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_therapists');
    }
};
