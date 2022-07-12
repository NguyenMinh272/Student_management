<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $role = Role::findById(1);
        $permission = Permission::findById(2);
        $role->givePermissionTo($permission);

        dd($role);
        return view('home');

    }

    public function setLocale(Request $request, $locale)
    {
            App::setLocale($locale);
            Session::put('locale', $locale);

        return redirect()->back();
    }
}
