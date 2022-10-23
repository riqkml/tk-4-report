<?php

namespace App\Http\Controllers;

use App\Http\UserType;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BuyerController extends Controller
{
    public function index()
    {
        if (Auth::user()->type == UserType::BUYER) {
            return redirect()->route('home');
        }
        $buyers = Users::query()->where('type', UserType::BUYER)->simplePaginate(10);
        return view("buyer.index", [
            'buyers' => $buyers
        ]);
    }

    public function store(Request $request)
    {
        $exists = Users::query()
            ->where('email', $request->email)
            ->exists();
        if ($exists) {
            return redirect()
                ->route('buyers.index')
                ->withErrors([
                    'error' => 'email already exists'
                ]);
        }

        Users::query()->create([
            'name' => $request->name,
            'ttl' => $request->ttl,
            'gender' => $request->gender,
            'address' => $request->address,
            'ktp_photo' => $request->ktp_photo,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => UserType::BUYER
        ]);

        return redirect()->route('buyers.index')
            ->with([
                'success' => 'register success'
            ]);
    }
}
