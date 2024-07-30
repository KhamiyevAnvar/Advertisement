<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DashboardAuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view("dashboard.auth.login");
    }

    public function login(DashboardAuthRequest $request)
    {
        $check = Auth::attempt(["email" => $request->email, "password" => $request->password]);
        if (!$check) {
            return to_route("dashboard.loginPage")->with("failed", "email or password not entered");
        }

        return to_route("dashboard.home")->with("success", "Ugurlu giris etdiniz.");
    }

    public function logout()
    {
        auth()->logout();

        return to_route("dashboard.loginPage");
    }
}