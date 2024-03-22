<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class OwnerController extends Controller
{
    public function index(){
        $owner = 'is owner';

        return Inertia::render('DashboardLayout', [
            'owner' => $owner,
        ]);
    }
}
