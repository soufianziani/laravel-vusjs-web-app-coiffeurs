<?php

namespace App\Http\Controllers;

use DateTime;
use Inertia\Inertia;
use App\Models\Reservation;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\servicesReservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\IcalendarGenerator\Components\Event;
use Spatie\IcalendarGenerator\Components\Calendar;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user_id = Auth::guard('web')->user()->id;
        $reservations = Reservation::with('store:id,name')->where('user_id', $user_id)->get();

        return Inertia::render('Dashboard', [
            'reservations' => $reservations,
        ]);
    }

    public function show($id)
    {
        $reservation = Reservation::with( 'store:id,name')->findOrFail($id);
        $servicesReservation = servicesReservation::where('reservation_id', $id)->get();
        $serviceIds = $servicesReservation->pluck('service_id')->toArray();
        $services = Service::whereIn('id', $serviceIds)->with('category')->get();
        $totalPrice = $services->sum('price');
        $totalDuration = $services->sum('duration');
        return Inertia::render('UserShowRservation', [
            'reservation' => $reservation,
            'services' => $services,
            'totalPrice' => $totalPrice,
            'totalDuration' => $totalDuration,
        ] );
    }

    public function download()
    {
        $contents = Calendar::create('Votre Réservation on a les crocs')
            ->event(Event::create()
                ->address('marrakech')
                ->addressName('')
                ->name('Votre Réservation Coiffly dans le  ')
                ->description('')
                ->uniqueIdentifier('skhsjndns')
                ->createdAt(new DateTime())
                ->startsAt(new DateTime())
                ->endsAt(new DateTime()))
            ->get();

        $fileName =  'reservation.ics';
        $path = 'links/' . $fileName;

        if (Storage::put($path, $contents, 'public')) {
            $file = Storage::disk('local')->get($path);

            $contentType = 'text/calendar'; // Correct content type for .ics files

            return response($file, 200)
                ->header('Cache-Control', 'public')
                ->header('Content-Description', 'File Transfer')
                ->header('Content-disposition', "attachment; filename=$fileName")
                ->header('Content-Type', $contentType)
                ->header('Content-Transfer-Encoding', 'binary');
        }
    }
}
