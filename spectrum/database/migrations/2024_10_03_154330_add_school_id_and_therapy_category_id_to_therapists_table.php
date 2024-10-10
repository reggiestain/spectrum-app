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
        Schema::table('therapists', function (Blueprint $table) {
            $table->unsignedBigInteger('school_id')->nullable()->after('id');
            $table->unsignedBigInteger('therapy_category_id')->nullable()->after('school_id');
            // Add foreign key constraints if applicable
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('set null');
            $table->foreign('therapy_category_id')->references('id')->on('therapy_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('therapists', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropForeign(['therapy_category_id']);
            $table->dropColumn(['school_id', 'therapy_category_id']);
        });
    }
};
