<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Input; 
use Illuminate\Support\Carbon;
use DB;
use Session;
use Stripe\Stripe;
//use Charge;
use Auth;

class StripePaymentController extends Controller
{

    public function basicPackageBy(Request $request)
    {
        $id = $request->id;
        $package_Name = $request->packageName;
        $package_price = $request->packageprice;

        DB::beginTransaction();
        try{
            $purchage_date = DB::table('payments')->where('user_id',Auth::user()->id)->latest()->first();
            $purchage_count = DB::table('payments')->where('user_id',Auth::user()->id)->count();
            
            if($purchage_count == 0)
            {

                $start_date = Carbon::now()->format('Y-m-d');                  
                $end_date = date('Y-m-d', strtotime($start_date . ' +30 days'));

                $data = [
                    'user_id'      => Auth::user()->id,
                    'package_id'   => $id,
                    'package_name' => $package_Name,
                    'price'        => $package_price,
                    'start_date'   => Carbon::now()->format('Y-m-d'),
                    'end_date'     => $end_date,
                    'status'       => 1,
                    'created_at'   => date('Y-m-d H:i:s')
                ];
                DB::table('payments')->insert($data);
            }
            else
            {
                $nextenddate = $purchage_date->end_date;
                $new_date_end = date('Y-m-d', strtotime($nextenddate . ' +1 days'));
               
                $next_end_date = date('Y-m-d', strtotime($new_date_end . ' +30 days'));
          
                $data = [
                    'user_id'      => Auth::user()->id,
                    'package_id'   => $id,
                    'package_name' => $package_Name,
                    'price'        => $package_price,
                    'start_date'   => $new_date_end,
                    'end_date'     => $next_end_date,
                    'status'       => 1,
                    'created_at'   => date('Y-m-d H:i:s')
                ];
                DB::table('payments')->insert($data);
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


    public function stripe(Request $request)
    {
        $ids = base64_decode($request->id);
        $packageprice = DB::table('packages')->where('id',$ids)->first();
      
        $id = $packageprice->id;
        $package_Name = $packageprice->package_name;
        $package_price = $packageprice->price;
        

        DB::beginTransaction();
        try{

            $id = $packageprice->id;
            $package_Name = $packageprice->package_name;
            $package_price = $packageprice->price;
            
            return view('admin.stripe.stripe', compact('id', 'package_Name','package_price'));
        }

        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
        
    }

    public function stripePost(Request $request)
    {
        $ids = base64_decode($request->id);
       
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = \Stripe\Charge::create([
                "amount" => $request->input('price') * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Testing data",
            ]);
            

            if (!empty($charge) && $charge['status'] == 'succeeded') {

                $purchage_date = DB::table('payments')->whereIn('package_name',['Silver','Gold','Diamond'])->latest()->first();
                $purchage_count = DB::table('payments')->where('package_id',$ids)->count();
            
            if($purchage_count == 0)
            {
                $start_date = Carbon::now()->format('Y-m-d');                  
                $end_date = date('Y-m-d', strtotime($start_date . ' +30 days'));

                $data = [
                    'transaction_id' => $charge->id,
                    'user_id'      => Auth::user()->id,
                    'package_id'   => $request->input('package_id'),
                    'package_name' => $request->input('package_name'),
                    'price'        => $request->input('price'),
                    'start_date'   => Carbon::now()->format('Y-m-d'),
                    'end_date'     => $end_date,
                    'status'       => 1,
                    'created_at'   => date('Y-m-d H:i:s')
                ];
                DB::table('payments')->insert($data);
            }
            else
            {
                $nextenddate = $purchage_date->end_date;
                $new_date_end = date('Y-m-d', strtotime($nextenddate . ' +1 days'));
                $next_end_date = date('Y-m-d', strtotime($new_date_end . ' +30 days'));
          
                $data = [
                    'transaction_id' => $charge->id,
                    'user_id'      => Auth::user()->id,
                    'package_id'   => $request->input('package_id'),
                    'package_name' => $request->input('package_name'),
                    'price'        => $request->input('price'),
                    'start_date'   => $new_date_end,
                    'end_date'     => $next_end_date,
                    'status'       => 1,
                    'created_at'   => date('Y-m-d H:i:s')
                ];
                DB::table('payments')->insert($data);
            }

                return response()->json([
                    'success' => true
                ]);
            } else {
                return response()->json([
                    'success' => false,
                ]);
            }
        } catch (\Exception $e) {
            // Handle other exceptions
            return $e;
        }
    }
}
