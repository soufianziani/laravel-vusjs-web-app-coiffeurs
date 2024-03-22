<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AppointmentController extends Controller
{
    public function index($store_id , $service_id){

        $isAuth = Auth::guard('web')->check();
        
        
        $store = Store::with(['city', 'owner' ,  'services','categorie', 'categorie.services'])->findOrFail($store_id);
        $service = Service::findOrFail($service_id);
        $services = Service::whereNull('category_id')->get();



        return Inertia::render('SendReservation' , [
            'store' => $store ,
            'service' => $service,
            'services' => $services,
            'isAuth' => $isAuth
        ]);
    }

    public function store(){

    }
}
