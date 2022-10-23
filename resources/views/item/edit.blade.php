@extends('layouts')

@section('title')
    Buyer
@stop

@section('content')
    <a href="{{ route('items.index') }}"
       class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Back
    </a>
    <div>
        <form class="mt-8 space-y-6" action="{{ route('items.update', $item->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="-space-y-px rounded-md shadow-sm">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input id="name" name="name" type="text" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                           leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="Name" value="{{$item->name}}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <textarea name="description" id="description" class="block appearance-none w-full bg-gray-200 border border-gray-200
                        text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                              placeholder="Description">{{$item->description}}</textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="type">
                        Type
                    </label>
                    <select name="type" class="block appearance-none w-full bg-gray-200 border border-gray-200
                        text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="type">
                        <option selected>{{$item->type}}</option>
                        <option>Drinks</option>
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
                           placeholder="Stock" value="{{$item->stock}}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="sell_price">
                        Sell Price
                    </label>
                    <input id="sell_price" name="sell_price" type="number" required min="1"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                           leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="Sell Price" value="{{$item->sell_price}}">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="buy_price">
                        Buy Price
                    </label>
                    <input id="buy_price" name="buy_price" type="number" required min="1"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                           leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="Buy Price" value="{{$item->buy_price}}">
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
                    Update
                </button>
            </div>
        </form>
    </div>
@stop
