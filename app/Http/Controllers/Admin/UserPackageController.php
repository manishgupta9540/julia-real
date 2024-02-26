<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use DataTables;
use DB;
use Carbon\Carbon;

class UserPackageController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('payments as p')
                    ->select('p.id','u.name','p.price','p.package_name','p.start_date','p.end_date','p.status')
                    ->join('users as u','u.id','=','p.user_id')
                    ->whereIn('p.status',[0,1])
                    ->get();
                    // dd($data);
            return Datatables::of($data)->addIndexColumn()
            ->editColumn('start_date', function($data){ 
                $formatedDate = Carbon::createFromFormat('Y-m-d', $data->start_date)->format('d M, Y'); 
                return $formatedDate; 
            })
            ->addColumn('action', function ($row) {
                $endDate = $row->end_date;
                $purchase= date('Y-m-d');
              
                if($purchase >= $endDate){
                    return '<a href="javascript:void(0)" class="btn btn-danger" >Expired</a>';
                }else{
                    return '<a href="javascript:void(0)" class="btn btn-primary" >On Going</a>';
                }
            })  
            ->rawColumns(['action','status'])
            ->make(true);
        }

        return view('admin.userpackage.index');
        
    }

    
}
