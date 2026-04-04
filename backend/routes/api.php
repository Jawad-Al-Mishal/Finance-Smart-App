<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;

// পাবলিক রাউট (লগইন ছাড়াই অ্যাক্সেস করা যাবে)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// প্রটেক্টেড রাউট (শুধুমাত্র লগইন করা ইউজারদের জন্য)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index']); // সব লেনদেন দেখার জন্য
    Route::post('/transactions', [TransactionController::class, 'store']); // নতুন লেনদেন যোগ করার জন্য
});
use App\Http\Controllers\Api\ProductController;

// সব প্রোডাক্ট দেখার জন্য (পাবলিক)
Route::get('/products', [ProductController::class, 'index']);

// শুধুমাত্র লগইন করা এডমিনের জন্য (এই রাউটগুলো আমরা পরে মিডলওয়্যার দিয়ে সুরক্ষিত করব)
Route::post('/products', [ProductController::class, 'store']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);

// use App\Http\Controllers\Api\ProductController;

// প্রোডাক্টের রাউটগুলো
Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);