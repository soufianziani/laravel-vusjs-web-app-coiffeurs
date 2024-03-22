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
        $owner = Auth::guard('owner')->user();

        if ($owner->store()->exists()) {
            return redirect()->route('store.worktime', ['id' => $owner->store->id]);
        }
        return Inertia::render('Owner/CreateStore', [
            'type_id' => $id,
            'cities' => City::get(),
            'owner_id' => $owner->id,
        ]);
    }

    public function store(Request $request)
    {
        $owner = Auth::guard('owner')->user();

        if ($owner->store()->exists()) {
            return redirect()->route('store.worktime', ['id' => $owner->store->id]);
        }

        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'location' => 'required',
            'city_id' => 'required',
            'type_id' => 'required|exists:types,id',
            'owner_id' => 'required|exists:owners,id',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $store = Store::create($validatedData);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $images) {
                $path = $images->store('images', 'public');
                $store->images()->create(['filename' => $path]);
            }
        }

        return redirect()->route('store.worktime', ['id' => $store->id]);
    }

    public function edit()
    {
        $store = Auth::guard('owner')->user()->store;
        $images = $store->images();

        return Inertia::render('Owner/UpdateStore', [
            'store'=>$store,
            'images'=>$images
        ]);
    }

    public function update(Request $request, $storeId)
    {
       

    }
}
