

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // ১. লগইন করা ইউজারের সব লেনদেন নিয়ে আসা
    public function index()
    {
        $transactions = Auth::user()->transactions()->orderBy('date', 'desc')->get();
        return response()->json($transactions);
    }

    // ২. নতুন লেনদেন সেভ করা
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'category' => 'nullable|string',
            'date' => 'required|date',
        ]);

        $transaction = Auth::user()->transactions()->create($data);

        return response()->json([
            'message' => 'Transaction added successfully!',
            'transaction' => $transaction
        ], 201);
    }
}