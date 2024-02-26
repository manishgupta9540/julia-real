<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class ContactController extends Controller
{
    public function getInTouch(Request $request)
    {
        $rules = [
            'name' => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:255',
            'email' => 'required|email|unique:contacts',
            'phone_number' => 'required|regex:/^((?!(0))[0-9\s\-\+\(\)]{10,11})$/',
            'description' => 'required',
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

            $phone_number = preg_replace('/\D/', '', $request->input('phone_number'));

            if(strlen($phone_number)!=10)
            {
                // return back()->withInput()->withErrors(['phone'=>['Phone Number Must be 10-digit Number !!']]);
                return response()->json([
                    'success' => false,
                    'custom'=>'yes',
                    'errors' => ['phone'=>'Phone Number must be 10-digit Number !!']
                  ]);
            }

            $data = [
                'name'        => $request->input('name'),
                'email'       => $request->input('email'),
                'phone_number' => $request->input('phone_number'),
                'description'  => $request->input('description'),
                'status'       => '1',
                'created_at'  => date('Y-m-d H:i:s')
            ];
            DB::table('contacts')->insert($data);

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
}
