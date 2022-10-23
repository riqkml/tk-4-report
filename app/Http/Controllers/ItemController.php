<?php

namespace App\Http\Controllers;

use App\Http\UserType;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index()
    {
        if (Auth::user()->type == UserType::BUYER) {
            return redirect()->route('home');
        }
        $items = Item::query()->simplePaginate(10);
        return view("item.index", [
            'items' => $items
        ]);
    }

    public function store(Request $request)
    {
        Item::query()->create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'stock' => $request->stock,
            'sell_price' => $request->sell_price,
            'buy_price' => $request->buy_price,
            'item_photo' => $request->item_photo
        ]);
        return redirect()->route('items.index')
            ->with([
                'success' => 'add success'
            ]);
    }

    public function edit($id)
    {
        $item = Item::query()->where('id', $id)->first();

        return view('item.edit', [
            'item' => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        $input = array_filter($request->only([
            'name',
            'description',
            'type',
            'stock',
            'sell_price',
            'buy_price',
            'item_photo',
        ]));
        Item::query()->where('id', $id)->update($input);

        return redirect()->route('items.index')
            ->with([
                'success' => 'update success'
            ]);
    }

    public function destroy($id)
    {
        Item::query()->where('id', $id)->delete();
        return redirect()->route('items.index')
            ->with([
                'success' => 'delete success'
            ]);
    }
}
