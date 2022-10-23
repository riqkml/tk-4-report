<?php
namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function viewHome() {
        $user = Auth::user();
        return view("home", [
            'user' => $user
        ]);
    }
}
