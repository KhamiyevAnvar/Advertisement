<?php

namespace App\Http\Controllers\dashboard\advertisement;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdvertisementCommandController extends Controller
{
    public function approve($id)
    {
        $advertisement = Advertisement::query()
            ->from('advertisements as a')
            ->select(
                'a.id',
                'su.email'
            )
            ->where('a.status', 1)
            ->join('site_users as su', 'su.id', 'a.created_by')
            ->first();

        // return $advertisement;

        if (!$advertisement) {
            abort(404);
        }


        Advertisement::query()
            ->where('id', $id)
            ->update([
                'status' => 2
            ]);

        $body = 'Elan derc olundu';
        Mail::send('mail.standart', compact('body'), function ($mail) use ($advertisement) {
            $mail->to($advertisement->email)->subject('Elaniniz tesdiqlendi');
        });

        return redirect()->back();
    }

    public function reject($id)
    {
        $advertisement = Advertisement::query()
            ->from('advertisements as a')
            ->select(
                'a.id',
                'su.email'
            )
            ->where('a.status', 1)
            ->join('site_users as su', 'su.id', 'a.created_by')
            ->first();

        if ($advertisement) {
            abort(404);
        }


        Advertisement::query()
            ->where('id', $id)
            ->update([
                'status' => 3
            ]);

        $body = 'Elan derc olunmadi';
        Mail::send('mail.standart', compact('body'), function ($mail) use ($advertisement) {
            $mail->to($advertisement->email)->subject('Elaniniz tesdiqlendi');
        });

        return redirect()->back();
    }
}
