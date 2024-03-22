<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    protected $fillable = [
        'id',
        'status',
        'user_id',
        'store_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function serviceReservations()
    {
        return $this->hasMany(ServicesReservation::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }


}
