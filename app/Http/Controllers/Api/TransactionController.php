<?php
namespace App\Http\Controllers\Api;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index() {
        $transactions = Transaction::all();
        return response()->json($transactions);
    }

    public function store(Request $request) {
        $transaction = new Transaction;
        $transaction->name = $request->name;
        $transaction->amount = $request->amount;
        $transaction->save();
        return response()->json($transaction);
    }

    public function show($id) {
        $transaction = Transaction::find($id);
        return response()->json($transaction);
    }

    public function update(Request $request, $id) {
        $transaction = Transaction::find($id);
        $transaction->name = $request->name;
        $transaction->amount = $request->amount;
        $transaction->save();
        return response()->json($transaction);
    }

    public function destroy($id) {
        $transaction = Transaction::find($id);
        $transaction->delete();
        return response()->json([
            'message' => 'Transaction deleted successfully'
        ]);
    }
}