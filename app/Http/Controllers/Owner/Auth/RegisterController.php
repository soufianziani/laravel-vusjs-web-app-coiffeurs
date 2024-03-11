<?php
namespace App\Http\Controllers\Owner\Auth;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Owner; 

class RegisterController extends Controller
{
    public function index()
    {
        return Inertia::render('Owner/Auth/Register');
    }

    public function register(LoginRequest $request)
    {
        // Create a new owner
        $owner = Owner::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        // Automatically log in the new owner
        Auth::guard('owner')->login($owner);

        return redirect()->route('type');
    }
}

?>