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
        Schema::create('student_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // Foreign key to students table
            $table->unsignedBigInteger('therapist_id')->nullable(); // Foreign key to therapists table
            $table->string('report_title'); // Optional title for the report
            $table->string('file_path'); // Path to the uploaded report file
            $table->string('file_type')->nullable(); // Optional: File type (e.g., pdf, docx)
            $table->unsignedBigInteger('file_size')->nullable(); // Optional: File size in bytes
            $table->date('report_date')->nullable(); // Date the report was submitted
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('therapist_id')->references('id')->on('therapists')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_reports');
    }
};
