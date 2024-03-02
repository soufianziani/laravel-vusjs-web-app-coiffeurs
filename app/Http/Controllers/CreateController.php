<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Models\Store;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function index(){

        return Inertia::render('Owner/create_store' , [
            'types'=>Type::get(),
            'owner_id'=>Auth::guard('owner')->user()->id,
        ]);
    }
    

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'location' => 'required',
            'city' => 'required',
            'type_id' => 'required|exists:types,id',
            'owner_id' => 'required|exists:owners,id',
            'image'=>'nullable|file|mimes:jpg,jpeg,png',
        ]);
        
        $store = Store::create($validatedData);

        if($request->hasFile('image')){
            $path = $request->file('image')->store('images','public');
            $store->images()->create(['filename' => $path]);
        }

        
        return redirect()->route('catigorie', ['id' => $store->id]);
    }
}