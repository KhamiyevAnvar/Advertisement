<?php

namespace App\Http\Controllers\Site\Car;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function getCarModelByCarId($car_id)

    {
        $model = CarModel::query()
            ->select(['id', 'name'])
            ->where('car_id', $car_id)->get();

        return response($model);
    }
}
