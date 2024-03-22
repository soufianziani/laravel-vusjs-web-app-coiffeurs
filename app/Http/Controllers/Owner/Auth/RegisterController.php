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
        $owner = Auth::guard('owner')->user();

        if(Auth::guard('web')->check()){
            return redirect()->route('dashboard');
        }
        elseif (Auth::guard('owner')->check()) {
            if($owner->store){
                return redirect()->route('store.worktime' , ['id' , $owner->store->owner_id]);
            }
            return redirect()->route('type');
        }
        return Inertia::render('Owner/Auth/Register');
    }

    public function register(LoginRequest $request)
    {
        // Check if the email is already registered
        $existingOwner = Owner::where('email', $request->input('email'))->first();
        if ($existingOwner) {
            return redirect()->route('owner.register')->withErrors([
                'message' => 'This email is already registered.'
            ]);
        }

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
