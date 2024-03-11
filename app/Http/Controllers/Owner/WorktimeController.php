<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WorkTime;
use Inertia\Inertia;

class WorkTimeController extends Controller
{
    public function index($id)
    {
        return Inertia::render(
            'Owner/WorkTime',
            [
                'store_id' => $id
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

        $store_id = $request->get('store_id');


        if (empty($validatedData['day'])) {
            return response()->json(['error' => 'No days selected'], 422);
        }

        foreach ($validatedData['day'] as $index => $day) {
            WorkTime::create([
                'day' => $day,
                'start_time' => $validatedData['start_time'][$index] ?? null,
                'end_time' => $validatedData['end_time'][$index] ?? null,
                'store_id' => $validatedData['store_id'],
                'status' => $validatedData['status'][$index] ?? 'open', // Set status based on the provided value
            ]);
        }

        return redirect()->route('catigorie', ['id' => $store_id]);
    }
}
