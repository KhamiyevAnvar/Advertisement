<?php

namespace App\Http\Controllers\Site\Advertisement;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Advertisement_info;
use App\Models\Advertisement_photo;
use App\Models\AdvertisementSupplier;
use App\Models\Ban;
use App\Models\Car;
use App\Models\CarSupplier;
use App\Models\City;
use App\Models\Color;
use App\Models\Currency;
use App\Models\FuelType;
use App\Models\Gear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdvertisementCreateController extends Controller
{
    public function index()
    {
        // $cars = Car::query()
        //     ->whereNull('deleted_at')
        //     ->get();

        $cars = Cache::remember('car_select', 3600, function () {
            return Car::query()->select('id', 'name')->whereNull('deleted_at')->get();
        });

        $fuels = Cache::remember('fuel_select', 3600, function () {
            return FuelType::query()->select('id', 'name')->get();
        });

        $gears = Cache::remember('gear_select', 3600, function () {
            return Gear::query()->select('id', 'name')->get();
        });

        $bans = Cache::remember('ban_select', 3600, function () {
            return Ban::query()->select('id', 'name')->get();
        });

        $currencies = Cache::remember('currency_select', 3600, function () {
            return Currency::query()->select('id', 'name')->get();
        });

        $colors = Cache::remember('color_select', 3600, function () {
            return Color::query()->select('id', 'name', 'hex_code')->get();
        });

        $cities = Cache::remember('cities_select', 3600, function () {
            return City::query()->select('id', 'name')->get();
        });

        $suppliers = Cache::remember('suppliers_select', 3600, function () {
            return CarSupplier::query()->select('id', 'name')->get();
        });

        return view('siteUser.advertisement.advertisementPage', compact('cars', 'fuels', 'gears', 'bans', 'currencies', 'colors', 'cities', 'suppliers'));
    }

    public function store(Request $request)
    {
        // return $request;
        // $this->validate($request, [
        //     'car_id' => 'required|integer|exists:cars,id',
        //     'year' => 'required|min:1904|max:' . date('Y'),
        //     'supplier_ids' => 'nullable|array',
        //     'supplier_ids.*' => 'nullable|integer|exists:car_suppliers,id',
        //     'photos' => 'required|array',
        //     'photos.*' => 'required|image|max:10000|mimes:png,jpg,jpeg',
        // ]);

        $advertisement = Advertisement::query()->create([
            'body' => $request->body,
            'created_by' => 1, //auth()->guard('site')->user()->id,
            'car_id' => $request->car_id,
            'model_id' => $request->model_id,
            'price' => $request->price,
            'currency_id' => $request->currency_id,
        ]);

        Advertisement_info::query()->create([
            'advertisement_id' => $advertisement->id,
            'fuel_type_id' => $request->fuel_type_id,
            'gear_id' => $request->gear_id,
            'ban_id' => $request->ban_id,
            'year' => $request->year,
            'color_id' => $request->color_id,
            'distance' => $request->distance,
            'vin_code' => $request->vin_code,
            'city_id' => $request->city_id,
        ]);

        $insertSuppliers = [];

        foreach ($request->supplier_ids as $supplier) {
            $insertSuppliers[] = [
                'advertisement_id' => $advertisement->id,
                'supplier_id' => $supplier,
            ];
        }

        AdvertisementSupplier::query()->insert($insertSuppliers);

        $this->savePhotos($request, $advertisement->id);

        return redirect()->back()->with('success', 'Elaniniza baxis kecirilecek');
    }

    private function savePhotos(Request $request, $advertisementId): void
    {
        $year = date("Y");
        $month = date("m");
        $day = date("d");

        $insertPhoto = [];

        foreach ($request->photos as $photo) {

            $filename = uniqid() . "." . $photo->extension();

            $filenameWithUpload = "/storage/cars/$year/$month/$day/$filename";

            $photo->storeAs("/public/cars/$year/$month/$day", $filename);

            $insertPhoto[] = $filenameWithUpload;
            Advertisement_photo::query()
                ->create([
                    'advertisement_id' => $advertisementId,
                    'photo' => $filenameWithUpload
                ]);
        }

        // Advertisement_photo::query()
        //     ->insert($insertPhoto);
    }
}
