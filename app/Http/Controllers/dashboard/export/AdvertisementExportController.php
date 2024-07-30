<?php

namespace App\Http\Controllers\dashboard\export;

use App\Exports\AdvertisementExport;
use App\Http\Controllers\Controller;
// use App\Models\Advertisement;
// use App\SelectData\AdvertisementStatus;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdvertisementExportController extends Controller
{
    public function advertisement(Request $request)
    {
        return Excel::download(new AdvertisementExport(), 'advertisements.xlsx');
    }
}
