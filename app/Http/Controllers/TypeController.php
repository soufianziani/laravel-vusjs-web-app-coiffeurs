<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TypeController extends Controller
{
    public function index(){
        return Inertia::render('Owner/SelectType' , [
            'types'=>Type::get()
        ]);
    }
}
