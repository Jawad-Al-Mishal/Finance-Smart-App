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
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        // ইউজার আইডি (কোন ইউজারের লেনদেন তা বোঝার জন্য)
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        $table->string('title'); // লেনদেনের নাম (যেমন: বাজার খরচ)
        $table->decimal('amount', 15, 2); // টাকার পরিমাণ
        $table->enum('type', ['income', 'expense']); // আয় নাকি ব্যয়
        $table->string('category')->nullable(); // ক্যাটাগরি (ঐচ্ছিক)
        $table->date('date'); // লেনদেনের তারিখ
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
