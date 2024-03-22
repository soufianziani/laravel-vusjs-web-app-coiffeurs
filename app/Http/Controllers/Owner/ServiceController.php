<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ServiceController extends Controller
{
    public function index(){
        
        $owner=Auth::guard('owner')->user();
        $store_id=Store::where('owner_id',$owner->id)->pluck('id');
        $categories = Category::where('store_id', $store_id)->get();
        $services = Service::with('category:id,name')->where('store_id', $store_id)->get();

        return Inertia::render('Owner/Services' , [
            'store_id' => $store_id->first(),
            'categories'=>$categories ,
            'services' => $services
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
    public function destroy($id){
        $service = Service::findOrFail($id);
        $service->delete();
    }

}
