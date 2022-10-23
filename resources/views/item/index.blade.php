@extends('layouts')

@section('title')
    Buyer
@stop

@section('content')
    <a href="{{ route('home') }}"
       class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Back
    </a>
    <div>
        <form class="mt-8 space-y-6" action="{{ route('items.store') }}" method="POST">
            @csrf
            <div class="-space-y-px rounded-md shadow-sm">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input id="name" name="name" type="text" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                           leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="Name">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <textarea name="description" id="description" class="block appearance-none w-full bg-gray-200 border border-gray-200
                        text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                              placeholder="Description"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                        Type
                    </label>
                    <select name="type" class="block appearance-none w-full bg-gray-200 border border-gray-200
                        text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="type">
                        <option selected>Drinks</option>
                        <option>Food</option>
                        <option>Others</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="stock">
                        Stock
                    </label>
                    <input id="stock" name="stock" type="number" required min="1"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                           leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="Stock">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="sell_price">
                        Sell Price
                    </label>
                    <input id="sell_price" name="sell_price" type="number" required min="1"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                           leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="Sell Price">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="buy_price">
                        Buy Price
                    </label>
                    <input id="buy_price" name="buy_price" type="number" required min="1"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                           leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="Buy Price">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="item_photo">
                        Photo
                    </label>
                    <input id="item_photo" name="item_photo" type="file"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                           leading-tight focus:outline-none focus:shadow-outline"
                           accept="image/*">
                </div>
            </div>
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

            <div>
                <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                  <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                  </span>
                    Add
                </button>
            </div>
        </form>
    </div>


    <div>
        <table class="table-auto">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th>Stock</th>
                    <th>Buy Price</th>
                    <th>Sell Price</th>
                    <th>Item Photo</th>
                    <th>-</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->description}}</td>
                        <td>{{$item->type}}</td>
                        <td>{{$item->stock}}</td>
                        <td>{{$item->buy_price}}</td>
                        <td>{{$item->sell_price}}</td>
                        <td>{{$item->item_photo}}</td>
                        <td>
                            <a href="{{ route('items.edit', $item->id) }}"
                               class="mb-4 group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                Edit
                            </a>
                            <form action="{{ route('items.destroy', $item->id) }}" method="POST">
                                @method('delete')
                                @csrf
                                <div>
                                    <button type="submit" class="group relative flex w-full justify-center rounded-md
                                        border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white
                                        hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                        Delete
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    {{ $items->links() }}
@stop
