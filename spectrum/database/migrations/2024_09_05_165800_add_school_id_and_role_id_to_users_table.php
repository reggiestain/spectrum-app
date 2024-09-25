<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('school_id')->nullable()->after('email'); // Assuming schools may not exist for all users
            $table->unsignedBigInteger('role_id')->default(2)->after('school_id'); // Default to a basic role

            // You can also add foreign key constraints if required
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('set null'); // assuming there is a schools table
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade'); // assuming there is a roles table
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['school_id']);
            $table->dropForeign(['role_id']);
            $table->dropColumn('school_id');
            $table->dropColumn('role_id');
        });
    }
};
