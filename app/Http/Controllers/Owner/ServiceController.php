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
        $categorie = Store::findOrFail($store_id)->categorie()->get();
        
        return Inertia::render('Owner/create_services' , [
            'store_id' => $store_id,
            'category'=>$categorie 
        ]);
    }

    public function store(Request $request ){

        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'store_id' => 'required|exists:stores,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        Service::create($validatedData);

        return 'the service is created successfully';
    }

}
