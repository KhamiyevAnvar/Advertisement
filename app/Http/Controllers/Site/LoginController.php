<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\SiteUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function loginPage()
    {
        return view("siteUser.auth.login");
    }

    public function login(Request $request)
    {

        $userCheck = SiteUser::query()
            ->where("email", $request->email)
            ->whereNotNull("email_verified_at")
            ->first();

        if (!$userCheck) {
            return to_route("registrationPage")->with("failed", "Duplicate email");
        }

        $code = rand(10000, 99999);
        $expired = time() + (60 * 10);

        $user_id = SiteUser::query()
            ->update([
                "email_code" => $code,
                "email_code_expired" => $expired
            ]);

        $subject = "Turbo email tesdiqleme";
        $body = "Turbo saytina giris ucun kod $code. <br/>
                Kod  10 deq muddetinde etibarlidir.";


        Mail::send("mail.standart", compact('body'), function ($mail) use ($request, $subject) {
            $mail->to($request->email)->subject($subject);
        });

        return to_route("loginConfirmPage", $userCheck->id);
    }

    public function loginConfirmPage(Request $request, $id)
    {
        $check = SiteUser::query()
            ->where('id', $id)
            ->whereNotNull("email_code")
            ->whereNotNull("email_code_expired")
            ->exists();

        if (!$check) {
            return to_route("loginPage")->with("failed", "Uygunluq tapilmadi");
        }

        return view("siteUser.auth.loginConfirm", compact('id'));
    }

    public function loginConfirm(Request $request, $id)
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
                "email_code" => null,
                "email_code_expired" => null
            ]);

        Auth::guard("site")->loginUsingId($id);

        return to_route("homeIndex");
    }

    public function logout()
    {
        Auth::guard('site')->logout();
        return to_route("homeIndex");
    }
}
