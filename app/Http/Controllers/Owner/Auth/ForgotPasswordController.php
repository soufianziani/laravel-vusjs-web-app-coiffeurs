<?php

namespace App\Http\Controllers\Owner;

use Inertia\Inertia;
use App\Models\Owner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function reset(Request $request)
    {
        return Inertia::render('Owner/Auth/ResetPassword', [
            'email' => $request->get('email'),
            'token' => $request->get('token'),
        ]);
    }

    public function send(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:admins,email'],
        ]);

        $owner = Owner::firstWhere('email', $request->input('email'));

        $owner->sendResetPassword();

        return back();
    }

        public function update(Request $request)
    {
       
        $request->validate([
            'email' => ['required', 'email', 'exists:admins,email'],
            'token' => ['required'],
            'password' => ['required', 'confirmed', 'min:8'], 
        ]);

        
        $owner = Owner::firstWhere('email', $request->input('email'));
       
        // Check if the reset token matches
        if (!Password::getRepository()->exists($owner,$request->input('token')))
        {
            return back()->withErrors([
                'token' => __('Invalid token'),
            ]);
        }

        // Update the owner's password
        $owner->update([
            'password' => Hash::make($request->input('password')),
            'reset_password_token' => null, 
        ]);

        
        return redirect()->route('owner.login')->with('message', 'Password has been successfully changed !');
    }
    
}
