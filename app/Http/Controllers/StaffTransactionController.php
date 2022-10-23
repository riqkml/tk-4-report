<?php
namespace App\Http\Controllers;

use App\Http\TransactionType;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StaffTransactionController extends Controller
{
    public function index() {
        $transactions = Transaction::query()
            ->with([
                'items:id,transaction_id,item_id,qty,price',
                'items.item:id,name',
                'buyer'
            ])
            ->where('status', '!=', TransactionType::CREATION)
            ->orderByDesc('created_at')
            ->paginate(15);
        return view('transaction.staff-index', [
            'transactions' => $transactions
        ]);
    }

    public function approve($transactionId) {
        $transaction = Transaction::query()
            ->with([
                'items:id,transaction_id,item_id,qty',
                'items.item:id,stock'
            ])
            ->where('id', $transactionId)->first();
        DB::transaction(function () use ($transaction) {
            $transaction->update(['status' => TransactionType::SUCCESS]);
            $transaction->items()->each(function ($transactionItem) {
                $transactionItem->item->decrement('stock', $transactionItem->qty);
            });
        });

        return redirect()->route('staff.transaction.index')
            ->with([
                'success' => 'success approve transaction'
            ]);
    }

    public function reject(Transaction $transaction) {
        $transaction->update(['status' => TransactionType::REJECTED]);
        return redirect()->route('staff.transaction.index')
            ->with([
                'success' => 'success reject transaction'
            ]);
    }
}
