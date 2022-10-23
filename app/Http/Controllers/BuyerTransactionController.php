<?php
namespace App\Http\Controllers;

use App\Http\TransactionType;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\TransactionItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BuyerTransactionController extends Controller
{
    public function index() {
        $transactions = Transaction::query()
            ->where('buyers_id', Auth::id())
            ->where('status', '!=', TransactionType::CREATION)
            ->with([
                'items:id,transaction_id,item_id,qty,price',
                'items.item:id,name'
            ])
            ->orderByDesc('created_at')
            ->paginate(15);
        return view('transaction.buyer-index', [
            'transactions' => $transactions
        ]);
    }

    public function create() {
        $items = Item::query()
            ->where('stock', '>', 0)
            ->get();

        $carts = Transaction::query()->with([
            'items:id,transaction_id,item_id,qty,price',
            'items.item:id,name'
        ])->firstOrCreate([
            'status' => TransactionType::CREATION,
            'buyers_id' => Auth::id()
        ]);
        return view('transaction.buyer-cart', [
            'items' => $items,
            'carts' => $carts
        ]);
    }

    public function addCart(Request $request, $itemId) {

        $item = Item::query()->where('id', $itemId)->first();
        $qty = $request->qty;
        $cart = Transaction::query()->firstOrCreate([
            'status' => TransactionType::CREATION,
            'buyers_id' => Auth::id()
        ]);
        $cartItem = TransactionItems::query()->where([
                'transaction_id' => $cart->id,
                'item_id' => $item->id,
        ])->first();
        if (optional($cartItem)->qty + $qty >= $item->stock) {
            return redirect()->route('buyer.transaction.cart')
                ->withErrors([
                    'error' => 'qty limit exceed'
                ]);
        }

        TransactionItems::query()->create([
            'transaction_id' => $cart->id,
            'item_id' => $item->id,
            'qty' => $qty,
            'price' => $item->sell_price
        ]);
        return redirect()->route('buyer.transaction.cart')
            ->with([
                'success' => 'success add to cart'
            ]);
    }

    public function submitCart(Request $request) {
        $trx = Transaction::query()->where([
            'status' => TransactionType::CREATION,
            'buyers_id' => Auth::id()
        ])->with('items:id,price,qty,transaction_id')->first();
        $totalPrice = collect($trx->items)->map(function ($data) {
            return $data->qty * $data->price;
        })->sum();
        $trx->update([
            'total_price' => $totalPrice,
            'status' => TransactionType::IN_PROGRESS
        ]);
        return redirect()->route('buyer.transaction.index')
            ->with([
                'success' => 'success checkout transaction'
            ]);
    }
}
