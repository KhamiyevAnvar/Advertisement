<?php

namespace App\Http\Controllers\SiteAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password as RulesPassword;

class SiteAdminQueryController extends Controller
{
    public function index()
    {
        $admins = User::query()
            ->paginate(5);

        return view("dashboard.admin.index", compact('admins'));
    }


    public function createPage()
    {
        return view('dashboard.admin.create');
    }

    public function create(Request $request)
    {

        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required',
            'password' => ["required", RulesPassword::min(8)],
        ]);

        $check =  User::query()
            ->where("email", $request->email)
            ->first();

        if ($check) {
            return  to_route("dashboard.site-admin.createPage")->with('failed', "This email exists");
        }


        User::query()
            ->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);


        return to_route('dashboard.site-admin.index')->with('success', "Create successfully");
    }

    public function edit(Request $request, $id)
    {
        $admin =  User::query()
            ->where("id", $id)
            ->first();

        if (!$admin) {
            return abort(404);
        }

        return view('dashboard.admin.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|unique:users,email,' . $id,
            'password' => ['required', RulesPassword::min(8)],
        ]);

        $check =  User::query()
            ->where("email", $request->email)
            ->where("id", '!=', $id)
            ->exists();

        if ($check) {
            return  to_route("dashboard.site-admin.edit", $id)->with('failed', "This email exists");
        }

        // $admin  =  User::query()
        //     ->where("id", $id)
        //     ->first();


        User::query()
            ->where("id", $id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' =>  bcrypt($request->password)
            ]);


        return to_route('dashboard.site-admin.index')->with('success', "Update successfully");
    }

    public function delete($id)
    {
        User::query()
            ->where('id', $id)
            ->delete();

        return to_route("dashboard.site-admin.index")->with("success", "Deleted succesfully");
    }
}