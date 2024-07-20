<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarQueryController extends Controller
{
    public function create()
    {
        return view("dashboard.car.create");
    }

    public function index(Request $request)
    {
        $cars = Car::query()
            ->from("cars as c")
            ->select(
                "c.*",
                "u.name as creator"
            )
            ->join("users as u", "u.id", "c.created_by")
            ->whereNull("deleted_at") #soft delete
            ->orderBy("c.name");

        //  if sertide vere bilerik
        $cars = $cars->where("c.name", "like", "%$request->name%");

        $cars = $cars->where("u.name", "like", "%$request->creator%");

        $cars = $cars
            ->paginate(5);

        return view("dashboard.car.index", compact("cars"));
    }

    public function edit($id)
    {

        $car = Car::query()
            ->where('id', $id)
            ->first();

        if (!$car) {
            abort(404);
        }
        // return $car;
        return view("dashboard.car.edit", compact("car"));
    }


    public function deleted(Request $request)
    {
        $deleted = Car::query()
            ->from("cars as c")
            ->select(
                "c.*",
                "u.name as creator"
            )
            ->join("users as u", "u.id", "c.created_by")
            ->whereNotNull("deleted_at") #soft delete
            ->orderBy("c.name");

        //  if sertide vere bilerik
        $deleted = $deleted->where("c.name", "like", "%$request->name%");

        $deleted = $deleted->where("u.name", "like", "%$request->creator%");


        $deleted = $deleted
            ->paginate(5);

        return view("dashboard.car.deleted", compact("deleted"));
    }

    public function imageView()
    {
        return view("dashboard.testimage");
    }
}
