<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Service;
use App\Models\ServicesReservation;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ReservationNotification;
use Illuminate\Support\Facades\Queue;
use Inertia\Inertia;

class AppointmentController extends Controller
{
    public function index($store_id, $service_id)
    {
        $isAuth = Auth::guard('web')->check();
        
        $store = Store::with(['city', 'owner', 'services', 'categorie', 'categorie.services'])->findOrFail($store_id);
        $service = Service::findOrFail($service_id);
        $services = Service::whereNull('category_id')->get();

        return Inertia::render('SendReservation', [
            'store' => $store,
            'service' => $service,
            'services' => $services,
            'isAuth' => $isAuth
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_id' => 'required|exists:stores,id',
            'selectedServices_id' => 'required|array',
            'selectedServices_id.*' => 'exists:services,id',
        ]);

        $reservation = Reservation::create([
            'user_id' => Auth::guard('web')->user()->id,
            'store_id' => $request->input('store_id'),
        ]);

        $selectedServices_id = $request->input('selectedServices_id');
        foreach ($selectedServices_id as $service_id) {
            ServicesReservation::create([
                'reservation_id' => $reservation->id,
                'service_id' => $service_id
            ]);
        }

        // 
        $store = Store::findOrFail($request->input('store_id'));
        $ownerEmail = $store->owner->email;
        $storeOwnerName = $store->owner->name;
        $userName = Auth::guard('web')->user()->name;

        Queue::push(function ($job) use ($reservation, $ownerEmail, $storeOwnerName , $userName) {
            Notification::route('mail', $ownerEmail)
                ->notify(new ReservationNotification($reservation, $storeOwnerName , $userName));
            
            $job->delete();
        });

        return redirect()->route('dashboard');
    }
}
