@extends('layouts')

@section('title')
    Buyer Transaction
@stop

@section('content')
    <a href="{{ route('home') }}"
       class="mb-5 group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        Back
    </a>

    <a href="{{ route('buyer.transaction.cart') }}"
       class="group relative flex w-full justify-center rounded-md border border-transparent bg-green-600 py-2 px-4 text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
        Create Transaction
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

    <div>
        <table class="table-auto">
            <thead>
            <tr>
                <th>Created At</th>
                <th>Status</th>
                <th colspan="3">Items</th>
                <th>Total Price</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{date('d-M-Y H:i', strtotime($transaction->created_at))}}</td>
                    <td>{{$transaction->status}}</td>
                    <td>-</td>
                    <td>qty</td>
                    <td>price</td>
                    <td colspan="2">{{$transaction->total_price}}</td>
                </tr>
                @foreach($transaction->items as $transactionItems)
                    <tr>
                        <td colspan="2"></td>
                        <td>{{$transactionItems->item->name}}</td>
                        <td>{{$transactionItems->qty}}</td>
                        <td>{{$transactionItems->price}}</td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>


    {{ $transactions->links() }}
@stop
