<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'created_by',
        'car_id',
        'model_id',
        'price',
        'currency_id',
        'status',
        'view'
    ];

    public function photos()
    {
        return $this->hasMany(Advertisement_photo::class,  'advertisement_id', 'id');
    }

    public function photo()
    {
        return $this->hasOne(Advertisement_photo::class,  'advertisement_id', 'id')
            ->select(
                'advertisement_id',
                'photo'
            )
            ->orderByDesc('id');
    }


    public function suppliers()
    {
        return $this->hasMany(AdvertisementSupplier::class,  'advertisement_id', 'id')
            ->select(
                'advertisement_suppliers.*',
                'cs.name'
            )
            ->join('car_suppliers as cs', 'cs.id', 'advertisement_suppliers.supplier_id');
    }


    public function creator()
    {
        return $this->hasOne(SiteUser::class,  'id', 'created_by');
    }

    public function car()
    {
        return $this->hasOne(Car::class,  'id', 'car_id');
    }

    public function carmodel()
    {
        return $this->hasOne(CarModel::class,  'id', 'model_id');
    }
}
