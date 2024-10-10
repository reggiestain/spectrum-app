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
        Schema::create('therapists', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');  // Therapist's first name
            $table->string('last_name');  // Therapist's last name
            $table->string('email')->unique();  // Therapist's email (unique)
            $table->string('phone')->nullable();  // Therapist's phone number (optional)
            $table->string('specialization');  // Therapist's specialization
            $table->text('bio')->nullable();  // Therapist's biography (optional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('therapists');
    }
};
