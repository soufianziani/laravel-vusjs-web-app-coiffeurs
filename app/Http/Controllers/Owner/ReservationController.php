<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\servicesReservation;
use App\Notifications\UpdateStatusReservation;
use Illuminate\Support\Facades\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;

class ReservationController extends Controller
{
    public function index()
    {
        $owner = Auth::guard('owner')->user();
        $store_id = $owner->store->id;
        $reservation = Reservation::with('user:id,name', 'store:id,name')
            ->where('store_id', $store_id)
            ->orderByDesc('created_at')
            ->get();

        return Inertia::render('Owner/Reservations', [
            'reservation' => $reservation,
        ]);
    }
    public function updateStatus(Request $request, $id)
    {

        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'status' => $request->status,
        ]);

        $user = Reservation::with('user:id,name,email', 'store:id,name')->findOrFail($id);
        $userName = $user->user->name;
        $userEmail = $user->user->email;
        $storeName = $user->store->name;
        $status = $user->status;
        if ($status !== 'pending') {
            Queue::push(function ($job) use ($userName, $userEmail, $storeName, $status) {
                Notification::route('mail', $userEmail)
                    ->notify(new UpdateStatusReservation($userName, $userEmail, $storeName, $status));

                $job->delete();
            });
        }
        return redirect()->route('store.reservation');
    }
    public function show($id)
    {
        $reservation = Reservation::with('user:id,name', 'store:id,name')->findOrFail($id);
        $servicesReservation = servicesReservation::where('reservation_id', $id)->get();
        $serviceIds = $servicesReservation->pluck('service_id')->toArray();
        $services = Service::whereIn('id', $serviceIds)->with('category')->get();
        $totalPrice = $services->sum('price');
        $totalDuration = $services->sum('duration');

        return Inertia::render('Owner/ShowReservation', [
            'reservation' => $reservation,
            'services' => $services,
            'totalPrice' => $totalPrice,
            'totalDuration' => $totalDuration,
        ]);
    }
}
