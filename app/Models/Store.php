<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'name',
        'location', 
        'city', 
        'working_hours'
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
