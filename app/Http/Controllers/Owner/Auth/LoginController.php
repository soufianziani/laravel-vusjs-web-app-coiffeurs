<?php

namespace App\Http\Controllers\Owner\Auth;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Owner\LoginRequest;

class LoginController extends Controller
{   

    public function login()
    {
        return Inertia::render('Owner/Auth/Login');
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
    
        $remember = $request->boolean('remember');
    
        if (Auth::guard('owner')->attempt($credentials, $remember)) {
            return redirect()->route('create');
        }
        
        return redirect()->route('owner.login')->withErrors([
            'message' => __('auth.failed')
        ]);
    }
    public function logout(Request $request)
    {
        
        Auth::guard('owner')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('owner.login');
        
      
    }
}
