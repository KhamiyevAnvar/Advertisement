<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\SiteUser;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportQueryController extends Controller
{
    public function montly()
    {

        $data = SiteUser::query()
            ->select(
                DB::raw("MONTH(created_at) as month"),
                DB::raw("COUNT(id) as count"),

            )
            ->groupBy(
                DB::raw("MONTH(created_at)")
            )
            ->get();

        $count = [];
        $month = [];


        // March

        foreach ($data as $dat) {

            array_unshift($count, $dat->count);

            $dateObj   = DateTime::createFromFormat('!m', $dat->month);
            $monthName = $dateObj->format('F');

            array_unshift($month,  $monthName);
        }
        // return $month;
        return view('dashboard.report.montly', compact('count', 'month'));
    }
}
