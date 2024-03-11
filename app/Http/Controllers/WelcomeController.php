<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Store;
use App\Models\Type;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Welcome', [
            'types' => Type::get(),
            'cities'=> City::get()
        ]);
    }
}
