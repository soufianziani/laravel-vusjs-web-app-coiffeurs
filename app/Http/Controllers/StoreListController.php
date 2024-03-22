<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use App\Models\Store;
use App\Models\Type;
use App\Models\WorkTime;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StoreListController extends Controller
{
    public function index($type, $city){
        $stores = Store::with(['city', 'type' , 'images'])
            ->whereHas('city', function ($query) use ($city) {
                $query->where('name', $city);
            })
            ->whereHas('type', function ($query) use ($type) {
                $query->where('name', $type);
            })
            ->get();

        $types = Type::where('name', $type)->first();

            // dd($types);
        return Inertia::render('Stores' , [
            'stores'=>$stores, 
            'types'=>$types, 
            'city'=>$city
        ]);
    }

    public function show($type, $city, $id)
    {
        $store = Store::with(['city', 'owner' ,  'type',  'services', 'categorie.services' ,  'images'])
        ->findOrFail($id);
        $worktime = WorkTime::where('store_id' , $id)->get();

        $services = Service::whereNull('category_id')->get();
        foreach ($worktime as $time) {
            $time->start_time = date('h:i A', strtotime($time->start_time));
            $time->end_time = date('h:i A', strtotime($time->end_time));
        }
        
        // dd($services);

        return Inertia::render('ShowStore', [
            'store' => $store , 
            'worktime' =>$worktime,
            'services' =>$services
        ]);
    }
}