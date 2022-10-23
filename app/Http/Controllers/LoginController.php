<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController {

    public function viewLogin() {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view("login");
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

    public function login(Request $request) {
        if (
            Auth::attempt(['email' => $request->email, 'password' => $request->password])
        ) {
            return redirect()->route('home');
        }

        return redirect()
            ->route('login')
            ->withErrors([
                'error' => 'email / password wrong'
            ]);
    }
}
