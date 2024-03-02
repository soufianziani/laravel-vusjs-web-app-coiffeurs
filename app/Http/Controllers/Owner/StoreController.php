<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class StoreController extends Controller
{
    public function index()
    {
        return Inertia::render('Owner/create_store', [
            'types' => Type::get(),
            'owner_id' => Auth::guard('owner')->user()->id,
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
            'image.*' => 'nullable|file|mimes:jpg,jpeg,png',
        ]);

        // $owner = Auth::guard('owner')->user();
        // if ($owner->store()->exists()) {
        //     return redirect()->back()->with(['message' => 'You already have a store']);
        // }

        $store = Store::create($validatedData);
    
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $path = $image->store('images', 'public');
                $store->images()->create(['filename' => $path]);
            }
        }
        
        return redirect()->route('catigorie', ['id' => $store->id]);
    }
}
