<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use URL;


class LoginController extends Controller
{
    public function userRegister(Request $request)
    {
        $rules= [
            'first_name'    => 'required|regex:/^[a-zA-Z]+$/u|min:1|max:255',
            'last_name'     => 'required|regex:/^[a-zA-Z]+$/u|min:1|max:255',
            'phone_number'    => 'required',
            'address'         => 'required',
            'user_email'         => 'required',
            'user_password'      => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'required'
        ];

        $users = DB::table('users')->where('email',$request->user_email)->first();

        if($users)
        {
            return response()->json([
                'success' => false,
                'custom'  =>'yes',
                'errors'  =>[]
            ]);
        }
       
        $validator = Validator::make($request->all(), $rules);
          
        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        DB::beginTransaction();
        try{
            
            $user_data = 
                [
                    'name'          => $request->first_name,
                    'last_name'     => $request->last_name,
                    'email'         => $request->user_email,
                    'phone_number'  => $request->phone_number,
                    'address'       => $request->address,
                    'user_type'     => 2, 
                    'password'      => Hash::make($request->input('user_password')),
                    'created_at'    => date('Y-m-d H:i:s')
                    
                ];
                    // dd($user_data);
            $user = DB::table('users')->insertGetId($user_data);

            //mail send user registered
            $name = $request->first_name;
            $email = $request->user_email;

            $data  = array('name'=>$name,'email'=>$email);

            \Mail::send('mails.users_registered', ['email' => $email,'name' => $name], function ($messages) use ($email, $name) {
                $messages->to($email, $name)
                ->from($email.env('MAIL_USERNAME'), 'Julia-Real-State');
                $messages->subject("Registration Successful!");
            });

            DB::commit();

            return response()->json([
                'success' =>true,
                'custom'  =>'yes',
                'errors'  =>[]
              ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }    
    }

    public function userLogin(Request $request)
    {
        
        $rules= [
            'email'         => 'required',
            'password'      => 'required',
          
        ];

        $validator = Validator::make($request->all(), $rules);
          
        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'error_type' =>'validation',
                'errors' => $validator->errors()
            ]);
        }
        $user_role = DB::table('users')->where('email',$request->email)->first();
        if(isset($user_role))
        {
            $credentials = $request->only('email','password');

            if($user_role->user_type == 2)
            {
                if (Auth::attempt($credentials)) 
                {
                    return response()->json([
                        'success' =>true,
                        'custom'  =>'yes',
                        'errors'  =>[]
                    ]);
                
                } 
                else 
                {
                    return response()->json([
                        'success'    =>false,
                        'error_type' =>'wrong_email_or_password',
                        'custom'  =>'yes',
                        'errors'  =>[]
                    ]);
                }
            }
            else
            {
                return response()->json([
                    'success'    =>false,
                    'error_type' =>'wrong_email_or_password',
                    'custom'  =>'yes',
                    'errors'  =>[]
                ]);
            }
        }
        else
        {
            return response()->json([
                'success'    =>false,
                'error_type' =>'wrong_email_or_password',
                'custom'  =>'yes',
                'errors'  =>[]
            ]);
        }
    }

    public function foregtPassword(Request $request)
    {
        $rules = [
            'useremail' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);
        }

        DB::beginTransaction();
        try{
           
            $token=mt_rand(100000000000000,9999999999999999);

            $email = $request->useremail;

            $userEmail = DB::table('users')->where('email',$email)->first();

                DB::table('users')->where('email',$email)->update(
                [
                    'email_verification_token' => $token
                ]);

            if($userEmail)
            {
                $email = $userEmail->email;
                $name  = $userEmail->name;
                $id    = base64_encode($userEmail->id);
                $enc_token = base64_encode($token);

                $url = url('/').'/forget/password/'.$id.'/'.$token;
                
                $data  = array('name'=>$name,'email'=>$email,'id'=>$id,'token_no' => $enc_token,'url'=>$url);

                \Mail::send('mails.forget-password-email', $data, function ($messages) use ($email, $name) {
                    $messages->to($email, $name)
                    ->from($email.env('MAIL_USERNAME'), 'Julia-Real-State');
                    $messages->subject("Reset Password Link!");
                });

            }
            else{
                return response()->json([
                    'success1' =>false,
                    'custom'  =>'yes',
                   // 'errors'  =>['email'=>'Please enter your correct email']
                ]);
            }
            DB::commit();
            return response()->json([
                'success' => true
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
    }

    public function foregtPasswordCreate(Request $request)
    {
        $id = $request->id;
        $token_no = $request->token_no;
    
        $user=User::find(base64_decode($id));

        if($user->email_verification_token!=NULL)
        {
            return view('front.forget-password',compact('id','token_no'));
        }
    }

    public function foregtPasswordUpdate(Request $request)
    {
        
        $id = base64_decode($request->id);
        
        $user_id = DB::table('users')->where('id',$id)->first();
        $token_no = base64_decode($request->token_no);
        // dd($id);
        $rules = [
            'new_password' => 'required|min:6|same:confirm_password',
            'confirm_password' => 'required|min:6|same:new_password'
            ];
    
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'error_type' => 'validation',
                'errors' => $validator->errors()
            ]);
        }   
        
       $raw_pass =$request->input('new_password');
       
       $password = Hash::make($request->input('new_password'));

       DB::beginTransaction();
       try{
            DB::table('users')->where('id', $id)->update([
                'password'=>$password,
                'email_verification_token' => NULL
            ]);

            DB::commit();
            return response()->json([
                'success' => true
            ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }

    }

    public function logout()
    {
        Auth::logout();
        $url = URL::current();
        if($url == 'admin/logout'){
            return redirect()->route('home');
        }
        return redirect()->route('home');
    }



}
