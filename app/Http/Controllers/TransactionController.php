<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Book;
use App\Models\Payment;

class TransactionController extends Controller
{
    public function index() {
        $transactions = Transaction::all();
        return response()->json($transactions);
    }

    public function purchaseBook($id) {
        if (Auth::id()) {
            $current_user = User::find(Auth::id());
            $purchased_book = Book::find($id);
            $all_payments_type = Payment::all();
            return response()->json([
                'current_user' => $current_user,
                'purchased_book' => $purchased_book,
                'all_payments_type' => $all_payments_type,
            ]);
        } else {
            return response()->json([
                'message' => 'You have to log in or register to be able to purchase books'
            ], 401);
        }
    }
    public function makeTransaction(Request $request){

        $data = new Transaction();
        $data->seller_id = $request->seller_id;
        $data->book_id = $request->book_id;
        $data->buyer_id = $request->buyer_id;
        $data->payment_id = 1;
        $data->save();

        return redirect('/showPurchasedBooks')->with('message','you transaction has ben made successfuly');
    }

}
