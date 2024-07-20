<?php

namespace App\Http\Controllers\Site\Home;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Car;
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

        if ($request->fuel_id != null) {
            $advertisements = $advertisements->where('ai.fuel_type_id', $request->fuel_id);
        }


        $advertisements = $advertisements
            ->orderByDesc('a.updated_at')
            ->paginate(3)
            ->appends($request->all());


        // return  $advertisements;
        return view("siteUser.home", compact('advertisements', 'cars', 'fuels'));
    }

    public static function show($id)
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
                'g.name as gearName'

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
        // return $advertisement;

        return view('siteUser.advertisement.detail', compact('advertisement'));
    }
}
