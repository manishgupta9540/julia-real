<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;

class AdminController extends Controller
{
    public function adminLogin()
    {
        return view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->passes())
        {
            $user_role = DB::table('users')->where('email',$request->email)->first();
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                if($user_role->user_type == 0){
                    return redirect()->route('admin.dashboard');
                }
                if($user_role->user_type == 1){
                    return redirect()->route('admin.dashboard');
                }
            }
            else
            {
                return redirect()->route("admin/login")->with('error','Error Email/Password or wrong');
            }
        }else{
            return redirect()->route('admin/login')->withErrors($validator)->withInput($request->only('email'));
        }
    }

   
}
