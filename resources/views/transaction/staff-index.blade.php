@extends('layouts')

@section('title')
    Buyer Transaction
@stop

@section('content')
    <a href="{{ route('home') }}"
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

    <div>
        <table class="table-auto">
            <thead>
            <tr>
                <th>Buyer</th>
                <th>Address</th>
                <th>Created At</th>
                <th>Status</th>
                <th colspan="3">Items</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{$transaction->buyer->name}}</td>
                    <td>{{$transaction->buyer->address}}</td>
                    <td>{{date('d-M-Y H:i', strtotime($transaction->created_at))}}</td>
                    <td
                        @if($transaction->status == \App\Http\TransactionType::SUCCESS)
                            class="bg-green-600 text-white"
                        @elseif($transaction->status == \App\Http\TransactionType::REJECTED)
                            class="bg-red-600 text-white"
                        @endif
                    >
                        {{$transaction->status}}
                    </td>
                    <td>Item</td>
                    <td>Qty</td>
                    <td>price</td>
                    <td>{{$transaction->total_price}}</td>
                    <th>
                        <form action="{{ route('staff.transaction.approve', $transaction->id) }}"
                              method="POST"
                              class="mb-3"
                        >
                            @csrf
                            <button type="submit" class="group relative justify-center rounded-md
                                        border border-transparent bg-green-600 py-2 px-4 text-sm font-medium text-white
                                        hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                                Approve
                            </button>
                        </form>

                        <form action="{{ route('staff.transaction.reject', $transaction->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="group relative justify-center rounded-md
                                        border border-transparent bg-red-600 py-2 px-4 text-sm font-medium text-white
                                        hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                Reject
                            </button>
                        </form>
                    </th>
                </tr>
                @foreach($transaction->items as $transactionItems)
                    <tr>
                        <td colspan="4"></td>
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
