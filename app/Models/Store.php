<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'location',
        'description', 
        'city_id', 
        'owner_id',
        'type_id',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }
    public function worktime(){
        return $this->hasOne(WorkTime::class);
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
