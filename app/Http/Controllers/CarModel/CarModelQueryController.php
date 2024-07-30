<?php

namespace App\Http\Controllers\CarModel;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Http\Request;

class CarModelQueryController extends Controller
{
    public function create()
    {
        $cars = Car::query()
            ->whereNull("deleted_at")
            ->get();

        return view("dashboard.car-model.create", compact("cars"));
    }

    public function index(Request $request)
    {
        $carModel = CarModel::query()
            ->from("car_models as cm")
            ->select(
                "cm.id as model_id",
                "cm.name as model",
                "u.name as creator",
                "c.name as car",
                "cm.created_at as modelCreated"
            )
            ->join("cars as c", "cm.car_id", "c.id")
            ->join("users as u", "cm.created_by", "u.id")
            ->whereNull("cm.deleted_at") #soft delete
            ->orderBy("cm.name");

        //  if sertide vere bilerik
        $carModel = $carModel->where("c.name", "like", "%$request->car%");

        $carModel = $carModel->where("cm.name", "like", "%$request->model%");

        $carModel = $carModel->where("u.name", "like", "%$request->creator%");

        $carModel = $carModel
            ->paginate(5);

        return view("dashboard.car-model.index", compact("carModel"));
    }

    public function edit($id)
    {
        $cars = Car::query()
            ->whereNull("deleted_at")
            ->get();

        $carModel = CarModel::query()
            ->where('id', $id)
            ->first();

        if (!$carModel) {
            abort(404);
        }
        // return $car;
        return view("dashboard.car-model.edit", compact("carModel", "cars"));
    }


    public function deleted(Request $request)
    {
        $deletedModel = CarModel::query()
            ->from("car_models as cm")
            ->select(
                "cm.id as model_id",
                "cm.name as model",
                "u.name as creator",
                "c.name as car",
                "cm.created_at as modelCreated"
            )
            ->join("cars as c", "cm.car_id", "c.id")
            ->join("users as u", "cm.created_by", "u.id")
            ->whereNotNull("cm.deleted_at") #soft delete
            ->orderBy("cm.name");

        //  if sertide vere bilerik
        $deletedModel = $deletedModel->where("c.name", "like", "%$request->car%");

        $deletedModel = $deletedModel->where("cm.name", "like", "%$request->model%");

        $deletedModel = $deletedModel->where("u.name", "like", "%$request->creator%");

        $deletedModel = $deletedModel
            ->paginate(5);

        return view("dashboard.car-model.deleted", compact("deletedModel"));
    }
}