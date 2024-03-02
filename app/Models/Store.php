<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'name',
        'location',
        'description', 
        'city', 
        'owner_id',
        'type_id',
    ];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
    public function categorie()
    {
        return $this->hasMany(Category::class);
    }
    public function images()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
