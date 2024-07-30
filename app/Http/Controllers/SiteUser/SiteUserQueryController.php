<?php

namespace App\Http\Controllers\SiteUser;

use App\Http\Controllers\Controller;
use App\Models\SiteUser;
use Illuminate\Http\Request;

class SiteUserQueryController extends Controller
{
    public function index(Request $request)
    {

        $users = SiteUser::query()
            ->whereNotNull("email_verified_at");

        $users = $users->where('name', 'like', "%$request->name%");

        $users = $users->where('email', 'like', "%$request->email%");

        $users = $users->paginate(5);

        return view("dashboard.users.index", compact("users"));
    }
}
