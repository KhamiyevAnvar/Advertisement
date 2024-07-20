<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\SiteUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function registrationPage()
    {
        return view("siteUser.auth.registrationPage");
    }

    public function registration(Request $request)
    {

        $userCheck = SiteUser::query()
            ->where("email", $request->email)
            ->whereNotNull("email_verified_at")
            ->exists();

        if ($userCheck) {
            return to_route("registrationPage")->with("failed", "Duplicate email");
        }

        $code = rand(10000, 99999);
        $expired = time() + (60 * 10);

        $user_id = SiteUser::query()
            ->create([
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
                "email_code" => $code,
                "email_code_expired" => $expired
            ]);

        $subject = "Qeydiyyat kecmek ucun OTP code";
        $body = " Salam $request->name. Qeydiyyatdan kecdiyiniz ucun tesekkurler. <br/>
                Hesabi tesdiqlemek ucun kod $code. <br/>
                Kod  10 deq muddetinde etibarlidir.";


        Mail::send("mail.standart", compact('body'), function ($mail) use ($request, $subject) {
            $mail->to($request->email)->subject($subject);
        });

        return to_route("registrationConfirmPage", $user_id->id);
    }

    public function registrationConfirmPage(Request $request, $id)
    {
        $check = SiteUser::query()
            ->where('id', $id)
            ->whereNull("email_verified_at")
            ->whereNotNull("email_code")
            ->whereNotNull("email_code_expired")
            ->exists();

        if (!$check) {
            return to_route("registrationPage")->with("failed", "Uygunluq tapilmadi");
        }

        return view("siteUser.auth.registration", compact('id'));
    }

    public function registrationConfirm(Request $request, $id)
    {

        $check = SiteUser::query()
            ->where("id", $id)
            ->where("email_code", $request->code)
            ->first();

        if (!$check) {
            return redirect()->back()->with("failed", "register code wrong");
        }

        if ($check->email_code_expired < time()) {
            return redirect()->back()->with("failed", "email code time ended");
        }

        SiteUser::query()
            ->where("id", $id)
            ->update([
                "email_verified_at" => 1,
                "email_code" => null,
                "email_code_expired" => null
            ]);

        return to_route("index");
    }
}
