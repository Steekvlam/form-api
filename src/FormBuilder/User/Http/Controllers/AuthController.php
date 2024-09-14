<?php

namespace FormBuilder\User\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function login()
    {
        return Inertia::render('Users/Login', []);
    }

    public function loginStore(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|min:5|max:30',
        ]);

        if (auth()->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended('/dashboard');
        } else {
            return redirect()->route('homepage')->with('error', 'Onjuiste inloggegevens');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
