<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Store;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class StoreController extends Controller
{
    public function index($id)
    {
        return Inertia::render('Owner/CreateStore', [
            'type_id' => $id,
            'cities'=> City::get(),
            'owner_id' => Auth::guard('owner')->user()->id,
        ]);
    }
    
    public function store(Request $request)
    {   
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'location' => 'required',
            'city_id' => 'required',
            'type_id' => 'required|exists:types,id',
            'owner_id' => 'required|exists:owners,id',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        // $owner = Auth::guard('owner')->user();
        // if ($owner->store()->exists()) {
        //     return redirect()->back()->with(['message' => 'You already have a store']);
        // }

        $store = Store::create($validatedData);
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $images) {
                $path = $images->store('images', 'public');
                $store->images()->create(['filename' => $path]);
            }
        }
        
        return redirect()->route('worktime', ['id' => $store->id]);
    }
}
