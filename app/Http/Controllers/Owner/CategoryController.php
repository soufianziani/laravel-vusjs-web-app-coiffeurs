<?php 
namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller
{
    public function index($id)
    {
        $store = Store::findOrFail($id); 
        $categories = $store->categorie; 

        return Inertia::render('Owner/CreateCatigorie', [
            'store_id' => $id,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description'=>'nullable',
            'store_id' => 'required|exists:stores,id',
        ]);

        $store_id = $request->get('store_id');

        Category::create($validatedData);

        return redirect()->route('catigorie', ['id' => $store_id]);
    }
    public function destroy(Request $request , $id)
    {   
        $category = Category::findOrFail($id);
        $category->delete();

    }
}
