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
        Schema::create('neuro_classes', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Name of the neuro class
            $table->text('description')->nullable();  // Optional description of the class
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('neuro_classes');
    }
};
