<?php

namespace App\Http\Controllers\dashboard\advertisement;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\SelectData\AdvertisementStatus;
use Illuminate\Http\Request;

class AdvertisementQueryController extends Controller
{
    public function index(Request $request)
    {
        $advertisements = Advertisement::query()->from('advertisements as a')->select('a.id', 'su.name as creator', 'c.name as car', 'cm.name as model', 'a.price', 'a.status', 'a.created_at')->join('site_users as su', 'su.id', 'a.created_by')->join('cars as c', 'c.id', 'a.car_id')->join('car_models as cm', 'cm.id', 'a.model_id');
        // ->paginate(10);
        // ->with('creator')
        // ->with('car')
        // ->with('carmodel')
        $advertisements = $advertisements->where('su.name', 'like', "%$request->creator%"); //creator
        $advertisements = $advertisements->where('c.name', 'like', "%$request->car%"); //cae
        $advertisements = $advertisements->where('cm.name', 'like', "%$request->model%"); //model

        $advertisements = $advertisements->orderByDesc('a.id')->paginate(8);

        foreach ($advertisements as $advertisement) {
            $advertisement->advertisementLabel = AdvertisementStatus::getStatus($advertisement->status);

            $status_color = '';

            if ($advertisement->status == 1) {
                $status_color = 'text-warning';
            } elseif ($advertisement->status == 2) {
                $status_color = 'text-success';
            } elseif ($advertisement->status == 3) {
                $status_color = 'text-danger';
            }

            $advertisement->status_color = $status_color;
        }
        // return $advertisements;
        // dd($advertisement);
        return view('dashboard.advertisement.index', compact('advertisements'));
    }

    public function show(Request $request, $id)
    {
        $advertisement = Advertisement::query()
            ->from('advertisements as a')
            ->select(
                'a.id',
                'a.body',
                'su.name as creator',
                'c.name as car',
                'cm.name as model',
                'a.price',
                'cr.name as currency',
                'a.created_at',
                'ai.year',
                'cl.name as color',
                'ai.distance',
                'ai.vin_code',
                'cs.name as city'

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
            ->with('photos', 'suppliers');


        $advertisement = $advertisement->first();
        // return $advertisements;

        return view('dashboard.advertisement.show', compact('advertisement'));
    }
}
