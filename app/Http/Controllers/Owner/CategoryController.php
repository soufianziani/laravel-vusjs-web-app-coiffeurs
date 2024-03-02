<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index($id){

        return Inertia::render('Owner/create_catigorie' , [
            'store_id' => $id
        ]);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'name'=> 'required',
            'store_id'=>'required|exists:stores,id',
        ]);

        $store_id = $request->get('store_id'); 
        Category::create($validatedData);

        return redirect()->route('services', ['id' => $store_id]);
        
    }
}
