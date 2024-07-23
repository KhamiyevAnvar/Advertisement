<?php

namespace App\Http\Controllers\Site\Home;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\AdvertisementView;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\City;
use App\Models\FuelType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

class FrontHomeController extends Controller
{
    public static function index(Request $request)
    {

        $cars = Cache::remember('car_select', 3600, function () {
            return Car::query()
                ->select('id', 'name')
                ->whereNull('deleted_at')
                ->get();
        });

        $models = CarModel::query()
            ->select('id', 'name')
            ->where('id', request()->model_id)
            ->whereNull('deleted_at')
            ->get();

        $cities = Cache::remember('city_select', 3600, function () {
            return City::query()
                ->select('id', 'name')
                ->get();
        });

        $fuels = Cache::remember('fuel_select', 3600, function () {
            return FuelType::query()
                ->select('id', 'name')
                ->get();
        });



        $advertisements = Advertisement::query()
            ->from('advertisements as a')
            ->select(
                'a.id',
                DB::raw("CONCAT(a.price , ' ' ,cr.name) as price"),
                DB::raw("CONCAT(c.name , ' ' ,cm.name) as car"),
                'ai.year',
                'ai.distance',
                'ai.updated_at',
                'ct.name as city',
                'ft.name as fuelName'

            )
            ->join('currencies as cr', 'cr.id', 'a.currency_id')
            ->join('cars as c', 'c.id', 'a.car_id')
            ->join('car_models as cm', 'cm.id', 'a.model_id')
            ->join('advertisement_infos as ai', 'ai.advertisement_id', 'a.id')
            ->join('cities as ct', 'ct.id', 'ai.city_id')
            ->join('fuel_types as ft', 'ft.id', 'ai.fuel_type_id')
            ->where('status', 2)
            ->where(DB::raw("ADDDate(a.updated_at,30)"), '>', Carbon::now()->format('Y-m-d'))
            ->with('photo');

        if ($request->car_id != null) {
            $advertisements = $advertisements->where('a.car_id', $request->car_id);
        }

        if ($request->model_id != null) {
            $advertisements = $advertisements->where('a.model_id', $request->model_id);
        }

        if ($request->city_id != null) {
            $advertisements = $advertisements->where('ai.city_id', $request->city_id);
        }

        if ($request->fuel_id != null) {
            $advertisements = $advertisements->where('ai.fuel_type_id', $request->fuel_id);
        }


        if ($request->price_max != null) {
            $advertisements = $advertisements
                ->where('a.price', '>', $request->price_min ?? 0)
                ->where('a.price', '<', $request->price_max ?? 7777777);
        }


        $advertisements = $advertisements
            ->orderByDesc('a.updated_at')
            ->paginate(3)
            ->appends($request->all());

        // return  $advertisements;
        return view("siteUser.home", compact('advertisements', 'cars', 'fuels', 'models', 'cities'));
    }

    public static function show(Request $request, $id)
    {

        $advertisement = Advertisement::query()
            ->from('advertisements as a')
            ->select(
                'a.id',
                'a.body',
                'su.name as creator',
                'su.phone as creator_phone',
                'c.name as car',
                'cm.name as model',
                'a.price',
                'cr.name as currency',
                'a.created_at',
                'ai.year',
                'cl.name as color',
                'ai.distance',
                'ai.vin_code',
                'cs.name as city',
                'b.name as banName',
                'ft.name as fuelName',
                'g.name as gearName',
                'a.view'

            )->join('site_users as su', 'su.id', 'a.created_by')
            ->join('cars as c', 'c.id', 'a.car_id')
            ->join('currencies as cr', 'cr.id', 'a.currency_id')
            ->join('car_models as cm', 'cm.id', 'a.model_id')
            ->join('advertisement_infos as ai', 'ai.advertisement_id', 'a.id')
            ->join('fuel_types as ft', 'ft.id', 'ai.fuel_type_id')
            ->join('gears as g', 'g.id', 'ai.gear_id')
            ->join('bans as b', 'b.id', 'ai.ban_id')
            ->join('colors as cl', 'cl.id', 'ai.color_id')
            ->join('cities as cs', 'cs.id', 'ai.city_id')
            ->where('a.id', $id)
            ->where(DB::raw("ADDDate(a.updated_at,30)"), '>', Carbon::now()->format('Y-m-d'))
            ->with('photos', 'suppliers')
            ->firstOrFail();

        $checkView = AdvertisementView::query()
            ->where('advertisement_id', $id)
            ->where('ip', $request->ip())
            ->where('user_agent', $request->userAgent())
            ->exists();

        if (!$checkView) {
            AdvertisementView::query()
                ->create([
                    "advertisement_id" => $id,
                    "ip" => $request->ip(),
                    "user_agent" => $request->userAgent(),

                ]);
        }

        $advertisement->view =  AdvertisementView::query()
            ->select(DB::raw('COUNT(id) as view'))
            ->where("advertisement_id", $id)
            ->first()->view ?? 0;

        // return $advertisement;

        return view('siteUser.advertisement.detail', compact('advertisement'));
    }
}
