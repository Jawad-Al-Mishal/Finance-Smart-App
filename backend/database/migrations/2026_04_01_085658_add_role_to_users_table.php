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
        Schema::table('users', function (Blueprint $table) {
            // ইমেইল কলামের পরে 'role' কলাম যোগ করা হচ্ছে
            $table->string('role')->default('customer')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // রোলব্যাক করলে কলামটি মুছে যাবে
            $table->dropColumn('role');
        });
    }
};