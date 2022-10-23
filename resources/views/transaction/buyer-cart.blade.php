@extends('layouts')

@section('title')
    Buyer Cart
@stop

@section('content')
    <a href="{{ route('buyer.transaction.index') }}"
       class="mb-5 group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Back
    </a>

    @if($errors->any())
        <div class="flex items-center justify-between">
            <h5 class="text-red-700">
                {{ implode('', $errors->all()) }}
            </h5>
        </div>
    @endif
    @if ($message = Session::get('success'))
        <div class="flex items-center justify-between">
            <h5 class="text-green-600">
                {{ $message }}
            </h5>
        </div>
    @endif

    <h2>Item List</h2>
    <table class="table-auto">
        <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Type</th>
            <th>Stock</th>
            <th>Price</th>
            <th width="100">

            </th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->description}}</td>
                <td>{{$item->type}}</td>
                <td>{{$item->stock}}</td>
                <td>{{$item->sell_price}}</td>
                <td>
                    <form action="{{ route('buyer.transaction.addCart', $item->id) }}" method="POST">
                        @csrf
                        <label for="qty"></label>
                        <input id="qty" name="qty" type="number"
                               required min="1" max="{{$item->stock - 1}}"
                               class="flex w-full shadow appearance-none border rounded py-2 px-3 text-gray-700
                                   leading-tight focus:outline-none focus:shadow-outline border-black"
                               value="1"
                        >
                        <button type="submit" class="group relative justify-center rounded-md
                                        border border-transparent bg-green-600 py-2 px-4 text-sm font-medium text-white
                                        hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            +
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h2>Cart List</h2>
    <table class="table-auto">
        <thead>
        <tr>
            <th>Qty</th>
            <th>Name</th>
            <th colspan="2">Price</th>
        </tr>
        </thead>
        <tbody>
            @foreach($carts->items as $cart)
            <tr>
                <td>{{$cart->qty}}</td>
                <td>{{$cart->item->name}}</td>
                <td colspan="2">{{$cart->price * $cart->qty}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3">Total Price</td>
                <td>{{collect($carts->items)->map(function ($data) {
                    return $data->qty * $data->price;
                })->sum()}}</td>
            </tr>
        </tbody>
    </table>

    <form action="{{ route('buyer.transaction.submitCart') }}" method="POST">
        @csrf
        <button type="submit" class="group relative justify-center rounded-md
                                            border border-transparent bg-green-600 py-2 px-4 text-sm font-medium text-white
                                            hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
            Checkout
        </button>
    </form>
@stop
