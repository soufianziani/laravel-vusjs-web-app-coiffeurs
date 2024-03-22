<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Can;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index()
    {
        $owner=Auth::guard('owner')->user();
        $store_id=Store::where('owner_id',$owner->id)->pluck('id');
        $categories = Category::where('store_id', $store_id)->get();


        return Inertia::render('Owner/Category', [
            'categories' => $categories,
            'storeId' => $store_id->first()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'store_id' => 'required|exists:stores,id',
        ]);
        Category::create($validatedData);

    }
    public function destroy(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
    }
   
}
