<?php
namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;

class LoginController {

    public function viewHome() {
        return view("home");
    }

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

        $hashEmail = md5($request->get('email'));


        $cookieEmail = Cookie::get($hashEmail);
        if ($cookieEmail != null) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'error' => 'to much try password, please wait'
                ])
                ->cookie($cookieEmail);
        }


        if (Staff::where('email', $request->email)->exists()) {
            session()->increment($hashEmail);
            if (session()->get($hashEmail) == 3) {
                $cookie = cookie($hashEmail, 'value', 0.2);
                session()->forget($hashEmail);
                return redirect()
                    ->route('login')
                    ->withErrors([
                        'error' => 'email / password wrong'
                    ])
                    ->cookie($cookie);
            }
        }

        return redirect()
            ->route('login')
            ->withErrors([
                'error' => 'email / password wrong'
            ]);
    }
}
