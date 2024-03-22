<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TypeController extends Controller
{
    public function index(){
        $owner = Auth::guard('owner')->user();
        if($owner->store){
            return redirect()->route('owner.dashboard' , ['id' , $owner->store->owner_id]);
        }
        return Inertia::render('Owner/SelectType' , [
            'types'=>Type::get()
        ]);
    }
}
