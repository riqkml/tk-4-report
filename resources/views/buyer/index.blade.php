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
        <form class="mt-8 space-y-6" action="{{ route('buyers.store') }}" method="POST">
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
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="ttl">
                        TTL
                    </label>
                    <input id="ttl" name="ttl" type="date"
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                           leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="TTL">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="gender">
                        Gender
                    </label>
                    <select name="gender" class="block appearance-none w-full bg-gray-200 border border-gray-200
                        text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="gender">
                        <option selected>L</option>
                        <option>P</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="address">
                        Address
                    </label>
                    <textarea name="address" id="address" class="block appearance-none w-full bg-gray-200 border border-gray-200
                        text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                              placeholder="Address"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="ktp_photo">
                        Photo KTP
                    </label>
                    <input id="ktp_photo" name="ktp_photo" type="file"
                           class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3
                           px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                           accept="image/*"
                    >
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input id="email" name="email" type="email" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                           leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="Email">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input id="password" name="password" type="password" required
                           class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700
                           leading-tight focus:outline-none focus:shadow-outline"
                           placeholder="Password">
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
                    <th>Gender</th>
                    <th>TTL</th>
                    <th>Address</th>
                    <th>Ktp</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($buyers as $buyer)
                    <tr>
                        <td>{{$buyer->name}}</td>
                        <td>{{$buyer->gender}}</td>
                        <td>{{$buyer->ttl}}</td>
                        <td>{{$buyer->address}}</td>
                        <td>{{$buyer->ktp_photo}}</td>
                        <td>{{$buyer->email}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    {{ $buyers->links() }}
@stop
