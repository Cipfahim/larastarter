<?php

namespace App\Http\Controllers\Backend;

use App\Models\Menu;
use App\Models\Page;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        $data['usersCount'] = User::count();
        $data['rolesCount'] = Role::count();
        $data['pagesCount'] = Page::count();
        $data['menusCount'] = Menu::count();
        $data['users'] = User::orderBy('last_login_at','desc')->take(10)->get();
        return view('backend.dashboard', $data);
    }
}
