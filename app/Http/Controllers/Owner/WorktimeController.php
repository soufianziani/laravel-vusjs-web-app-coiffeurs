<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;
use App\Models\WorkTime;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class WorkTimeController extends Controller
{
    public function index()
    {
        $owner=Auth::guard('owner')->user();
        $store_id=Store::where('owner_id',$owner->id)->pluck('id');
        $worktime = WorkTime::where('store_id' , $store_id)->get();

        foreach ($worktime as $time) {
            $time->start_time = date('h:i A', strtotime($time->start_time));
            $time->end_time = date('h:i A', strtotime($time->end_time));
        }

        return Inertia::render(
            'Owner/WorkTime',
            [
                'store_id' => $store_id->first(),
                'worktime' => $worktime
            ]
        );
    }

    public function store(Request $request)
    {
        WorkTime::truncate();

        $validatedData = $request->validate([
            'day' => 'required|array',
            'start_time' => 'array',
            'end_time' => 'array',
            'status' => 'array',
            'store_id' => 'required|exists:stores,id',
        ]);

        if (empty($validatedData['day'])) {
            return response()->json(['error' => 'No days selected'], 422);
        }

        foreach ($validatedData['day'] as $index => $day) {
            WorkTime::create([
                'day' => $day,
                'start_time' => $validatedData['start_time'][$index] ?? null,
                'end_time' => $validatedData['end_time'][$index] ?? null,
                'store_id' => $validatedData['store_id'],
                'status' => $validatedData['status'][$index] ?? 'open', 
            ]);
        }

    }

}
