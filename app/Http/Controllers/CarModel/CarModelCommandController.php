<?php

namespace App\Http\Controllers\CarModel;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarModelCommandController extends Controller
{
    // create new car model
    public function store(Request $request)
    {
        $request->validate([
            'car' => 'required',
            'model' => 'required|max:50',
        ]);

        $check = CarModel::query()
            ->where("name", $request->model)
            ->where("car_id", $request->car)
            ->exists();

        if ($check) {
            return to_route("dashboard.car-model.create")->with("failed", "This  already exists");
        }

        CarModel::query()
            ->create([
                "name" => $request->model,
                "car_id" => $request->car,
                "created_by" => auth()->user()->id
            ]);

        return to_route("dashboard.car-model.index")->with("success", "Car model created successfully");
    }


    public function delete($id)
    {
        CarModel::query()
            ->where('id', $id)
            // ->where('id', $id)
            ->update([
                "deleted_at" => now()
            ]);

        return to_route("dashboard.car-model.index")->with("success", "Deleted succesfully");
    }


    public function update(Request $request, $id)
    {

        $check = CarModel::query()
            ->where('name', $request->model)
            ->where('car_id', $request->car)
            ->where('id', "!=", $id)
            ->exists();

        if ($check) {
            return to_route("dashboard.car-model.edit", $id)->with("failed", "This model exists");
        }

        CarModel::query()
            ->where('id', $id)
            ->update([
                "name" => $request->model
            ]);

        return to_route("dashboard.car-model.index");
    }

    public function deletedBack($id)
    {
        $car = CarModel::query()
            ->where('id', $id)
            ->update([
                "deleted_at" => null
            ]);

        if (!$car) {
            abort(404);
        }

        return to_route("dashboard.car-model.index");
    }

    // // reset filter

    // public function resetFilter(Request $request)
    // {
    //     // $request->name = ' ';
    //     // $request->creator = ' ';

    //     return to_route("dashboard.car.index");
    // }


    // public function imageUploads(Request $request)
    // {
    //     if ($request->hasFile("testImg")) {
    //         $filename = 'image' . time() . "." .  $request->testImg->extension();

    //         // $filenameUpload = "storage/uploads/testimage/" . $filename;

    //         $request->testImg->storeAs('public/uploads/testimage/', $filename);

    //         // $request->image =  $filenameUpload;
    //     }

    //     return redirect()->back()->with("data",  $filename);
    // }
}
