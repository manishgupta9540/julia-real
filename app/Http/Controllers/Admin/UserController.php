<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use DB;
use Illuminate\Support\Facades\Validator;
use Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::select('id','name','email','created_at','status')->where('user_type',2)->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){

                if($row->status==1)
                {
                    $action_1 = '<span data-d="'.base64_encode($row->id).'"><a href="javascript:;" class="btn btn-outline-dark status" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'" data-name="'.$row->name.'" title="Deactivate"><i class="far fa-times-circle"></i> Deactivate</a></span>
                                <span data-a="'.base64_encode($row->id).'" class="d-none"><a href="javascript:;" class="btn btn-outline-success status" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'" data-name="'.$row->name.'" title="Active"><i class="far fa-check-circle"></i> Active</a></span>';
                    
                }
                else
                {
                    $action_1 = '<span class="d-none" data-d="'.base64_encode($row->id).'"><a href="javascript:;" class="btn btn-outline-dark status" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'" data-name="'.$row->name.'" title="Deactivate"><i class="far fa-times-circle"></i> Deactivate</a></span>
                                <span data-a="'.base64_encode($row->id).'"><a href="javascript:;" class="btn btn-outline-success status" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'" data-name="'.$row->name.'"  title="Active"><i class="far fa-check-circle"></i> Active</a></span>';
                }
                $edit_url = url('/admin/user/edit',['id'=>base64_encode($row->id)]);

                $action_2 = '<a href="'.$edit_url.'" class="btn btn-outline-info" title="Edit"><i class="fas fa-edit text-info"></i></a>';

                $action_3 = '<span><a class="btn btn-outline-danger btn-rounded flush-soft-hover deleteBtn" data-bs-toggle="tooltip" data-placement="top" title=""
                            data-bs-original-title="Delete" href="javascript:void(0)" data-id="'.base64_encode($row->id).'">
                            <i class="fas fa-trash text-danger"></i>
                            </a></span>';

                        
                $action =   '<div class="d-flex align-items-center">
                                <div class="d-flex">
                                '.$action_1.'
                                '.$action_2.'
                                '.$action_3.'
                                </div>
                            </div>';
                return $action;
                })

                ->editColumn('created_at', function ($user) {
                    return [
                    'display' => e($user->created_at->format('m-d-Y')),
                    'timestamp' => $user->created_at->timestamp
                    ];
                })
                ->addColumn('status', function ($data) {
                    if ($data->status==0){
                        return'<span data-dc="'.base64_encode($data->id).'" class="badge badge-danger">Inactive</span>
                        <span data-ac="'.base64_encode($data->id).'" class="badge badge-success d-none">Active</span>';
                    }
                    else{
                        return '<span data-dc="'.base64_encode($data->id).'" class="badge badge-danger d-none">Inactive</span>
                        <span data-ac="'.base64_encode($data->id).'" class="badge badge-success">Active</span>';
                    }
                })
                
                ->rawColumns(['action','status'])
                ->make(true);
        }

        return view('admin.users.index');
        
    }

    public function create(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('admin.users.create');
        }

        $rules = [
            'name'      => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:255',
            'last_name' => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:255',
            'email'     => 'required|email|unique:users',
            'phone_number' => 'required',
            'address'    => 'required',
            'password'   => 'required|min:6',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }

        $hashed_random_password = Hash::make($request->input('password'));

        DB::beginTransaction();
        try{
           
            $data = [
                'name' => $request->input('name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'phone_number'  => $request->phone_number,
                'address'       => $request->address,
                'password'      => $hashed_random_password,
                'user_type'     => 2,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s')
            ];

            DB::table('users')->insert($data);

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

    public function userEdit(Request $request)
    {
        $user_id = base64_decode($request->id);

        $user  = DB::table('users')->where('id',$user_id)->first();
        return view('admin.users.edit',compact('user'));
    }

    public function userUpdate(Request $request)
    {
        $user_id = $request->id;

        $rules = [
            'name' => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:255',
            'last_name' => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:255',
            'email' => 'required|email|unique:users,email,'.$user_id,
            'phone_number' => 'required',
            'address'    => 'required',
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

            $data1 =   DB::table('users')->where('id',$user_id)->first();
            $status = $data1->status;

            $data = [
                'name' => $request->input('name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'user_type'     => 2,
                'status' => $status,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('users')->where('id',$user_id)->update($data);

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

    public function userDelete(Request $request)
    {
        $user_id = base64_decode($request->id);
        DB::beginTransaction();
        try{
            User::find($user_id)->delete($user_id);

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

    public function userStatus(Request $request)
    {
        $user_id=base64_decode($request->id);
        $user = User::find($user_id);
        $type = base64_decode($request->type);

        if($type == 'disable')
        { 
            $users =  DB::table('users')->where('id',$user_id)->update(['status'=>0]);;
            return response()->json([
                'success'=>true,
                'type' => $type,
                'message'=>'Status change successfully.'
            ]);
        }
        elseif($type == 'enable')
        {   
            $users = DB::table('users')->where('id',$user_id)->update(['status'=>1]);
            
            return response()->json([
                'success'=>true,
                'type' => $type,
                'message'=>'Status change successfully.'
            ]);
        }
        
    }
}
