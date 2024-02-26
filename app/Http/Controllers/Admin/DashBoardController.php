<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Auth;
use URL;

class DashBoardController extends Controller
{
    public function index()
    {
        $Activeusers = User::where('status',1)->count();
        $Inactiveusers = User::where('status',0)->count();
        $contacts    = DB::table('contacts')->count();
        $activeProperty = DB::table('properties')->where('status',1)->count();
        $InactiveProperty = DB::table('properties')->where('status',0)->count();
        $customers = User::where('user_type',2)->count();
        return view('admin.index',compact('Activeusers','Inactiveusers','contacts','activeProperty','InactiveProperty','customers'));
        
    }

   

    public function logout()
    {
        Auth::guard('admin')->logout();
        $url = URL::current();

        if($url == 'admin/logout'){
            return redirect()->route('admin/login');
        }
        return redirect()->route('admin/login')->with('status', 'Your session has expired. Please log in again.');;
    }
}
