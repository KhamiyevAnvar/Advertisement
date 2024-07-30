<?php

namespace App\Http\Controllers\Car;

use App\Http\Controllers\Controller;
use App\Imports\CarImport;
use App\Models\car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CarCommandController extends Controller
{
    // create new car
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
        ]);

        $check = Car::query()
            ->where(DB::raw('UPPER(name)'), strtoupper(trim($request->name)))
            ->exists();

        if ($check) {
            return to_route("dashboard.car.create")->with("failed", "This name already exists");
        }

        Car::query()
            ->create([
                "name" => $request->name,
                "created_by" => auth()->user()->id
            ]);

        // 
        Cache::forget('car_select');

        return to_route("dashboard.car.index")->with("success", "Car created successfully");
    }


    public function delete($id)
    {
        Car::query()
            ->where('id', $id)
            ->update([
                "deleted_at" => now()
            ]);

        return to_route("dashboard.car.index")->with("success", "Deleted succesfully");
    }


    public function update(Request $request, $id)
    {

        $check = Car::query()
            ->where('name', $request->name)
            ->where('id', "!=", $id)
            ->exists();

        if ($check) {
            return to_route("dashboard.car.edit", $id)->with("failed", "This name exists");
        }

        Car::query()
            ->where('id', $id)
            ->update([
                "name" => $request->name
            ]);

        return to_route("dashboard.car.index");
    }

    public function deletedBack($id)
    {
        $car = Car::query()
            ->where('id', $id)
            // ->where('name', "!=" . $request->name)
            ->update([
                "deleted_at" => null
            ]);

        if (!$car) {
            abort(404);
        }

        return to_route("dashboard.car.index");
    }

    // reset filter

    public function resetFilter(Request $request)
    {
        // $request->name = ' ';
        // $request->creator = ' ';

        return to_route("dashboard.car.index");
    }


    public function imageUploads(Request $request)
    {
        if ($request->hasFile("testImg")) {
            $filename = 'image' . time() . "." .  $request->testImg->extension();

            // $filenameUpload = "storage/uploads/testimage/" . $filename;

            $request->testImg->storeAs('public/uploads/testimage/', $filename);

            // $request->image =  $filenameUpload;
        }

        return redirect()->back()->with("data",  $filename);
    }

    public function import(Request $request)
    {

        Excel::import(new CarImport(auth()->user()->id), $request->cars);

        return back();
    }
}
