<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use App\Models\Store;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function index($id){
        
        $store_id = $id;
        $categories = Store::findOrFail($store_id)->categorie()->get();
        
        return Inertia::render('Owner/CreateServices' , [
            'store_id' => $store_id,
            'categories'=>$categories 
        ]);
    }

    public function store(Request $request ){

        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|numeric|min:0',
            'store_id' => 'required|exists:stores,id',
            'category_id' => 'nullable',
        ]);

        Service::create($validatedData);

    }

}
