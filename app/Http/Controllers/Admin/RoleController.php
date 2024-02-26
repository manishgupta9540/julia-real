<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoleMaster;
use DataTables;
use DB;
use Illuminate\Support\Facades\Validator;
use Hash;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = RoleMaster::whereIn('status',['0','1'])->select('id','role','created_at','status')->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){

                if($row->status==1)
                {
                    $action_1 = '<span data-d="'.base64_encode($row->id).'"><a href="javascript:;" class="btn btn-outline-dark status" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'" title="Deactivate"><i class="far fa-times-circle"></i> Deactivate</a></span>
                                <span data-a="'.base64_encode($row->id).'" class="d-none"><a href="javascript:;" class="btn btn-outline-success status" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'" title="Active"><i class="far fa-check-circle"></i> Active</a></span>';
                    
                }
                else
                {
                    $action_1 = '<span class="d-none" data-d="'.base64_encode($row->id).'"><a href="javascript:;" class="btn btn-outline-dark status" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'" title="Deactivate"><i class="far fa-times-circle"></i> Deactivate</a></span>
                                <span data-a="'.base64_encode($row->id).'"><a href="javascript:;" class="btn btn-outline-success status" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'" title="Active"><i class="far fa-check-circle"></i> Active</a></span>';
                }
                $edit_url = url('/admin/role/edit',['id'=>base64_encode($row->id)]);

                $action_2 = '<a href="'.$edit_url.'" class="btn btn-outline-info" title="Edit"><i class="fas fa-edit text-info"></i></a>';

                $action_3 = '<span><a class="btn btn-outline-danger  btn-rounded flush-soft-hover deleteBtn" data-bs-toggle="tooltip" data-placement="top" title=""
                            data-bs-original-title="Delete" href="javascript:void(0)" data-id="'.base64_encode($row->id).'">
                            <i class="fas fa-trash text-danger"></i>
                            </a></span>';

                $permission_url = url('/admin/roles/permission',['id'=>base64_encode($row->id)]);

                $action_4 = '<a href="'.$permission_url.'" class="btn btn-outline-info" title="Permission"><i class="fa fa-key"></i></a>';
                            
                $action =   '<div class="d-flex align-items-center">
                                <div class="d-flex">
                                '.$action_1.'
                                '.$action_2.'
                                '.$action_3.'
                                '.$action_4.'
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

        return view('admin.roles.index');
    }

    public function create(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('admin.roles.create');
        }

        $rules = [
            'role' => 'required',
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

            $role_exist = DB::table('role_masters')->where(['role'=>$request->role,'status'=>'1'])->count();

            if($role_exist > 0)
            {
                return response()->json([
                    'success' => false,
                    'errors' => ['role' => 'This Role is Already Exist!']
                ]);
            }

            $new_role = new RoleMaster();
            $new_role->role= $request->role; 
            $new_role->status ='1';
            $new_role->save();
            

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

    public function roleEdit(Request $request)
    {
        $role_id = base64_decode($request->id);
        
        $roles = DB::table("role_masters")->where('id', $role_id)->first();
        return view('admin.roles.edit',compact('roles'));
    }

    public function roleUpdate(Request $request)
    {
        $role_id = base64_decode($request->id);

        $rules = [
            'role' => 'required',
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

            $role_exist = DB::table('role_masters')->where(['role'=>$request->role,'status'=>'1'])->count();

            if($role_exist > 0)
            {
                return response()->json([
                    'success' => false,
                    'errors' => ['role' => 'This Role is Already Exist!']
                ]);
            }

            $data = [
                'role' => $request->input('role'),
                'status' => '1',
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('role_masters')->where('id',$role_id)->update($data);

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

    public function roleDelete(Request $request)
    {
        
        $role_id =base64_decode($request->id);
        $privacy = RoleMaster::find($role_id);
        $privacy->status = '2'; //Association Status in delete mode
        $privacy->save();

        return response()->json(['success'=>true]);  
    }


    public function rolesStatus(Request $request)
    {
        $role_id=base64_decode($request->id);
        //$user = RoleMaster::find($role_id);
        $type = base64_decode($request->type);
        
        if($type == 'disable')
        { 
            $user = RoleMaster::find($role_id);
            $user->status = '0';
            $user->save();
            
            return response()->json([
                'success'=>true,
                'type' => $type,
                'message'=>'Status change successfully.'
            ]);
        }
        elseif($type == 'enable')
        {   
            $user = RoleMaster::find($role_id);
            $user->status = '1';
            $user->save();
        
            return response()->json([
                'success'=>true,
                'type' => $type,
                'message'=>'Status change successfully.'
            ]);
        }
        
    }


    public function getAddPermissionPage(Request $request)
    {
        // ->whereNotIn('parent_id','0')
        $role_id = base64_decode($request->id);

        $role_data = DB::table('role_masters')->where(['status'=>'1','id'=>$role_id])->first();
        // dd($role_data);
        $action_route_count = DB::table('role_permissions')->where(['role_id'=>$role_id,'status'=>'1'])->count();  
        $action_route = DB::table('role_permissions')->where(['role_id'=>$role_id,'status'=>'1'])->first();        
        $permission  = DB::table('action_masters')->where(['route_group'=>'','status'=>'1','parent_id'=>'0'])->get();
      
        return view('admin.roles.permission',compact('permission','role_id','action_route','role_data','action_route_count'));
    }

    
    public function addPermission(Request $request)
    {
         //  dd($request->business_id);
         $this->validate($request, [
            'permissions'      => 'required',
         ]);
        DB::beginTransaction();
        try{
                foreach($request->permissions as $permissions){
                    $data[] = $permissions;
                }
                $permissions_id =json_encode($data);
                $permission_data =
                        [
                            'role_id'        => $request->role_id,
                            'permission_id'  => $permissions_id,
                            'status'         => '1'
                        ];
                $count = DB::table('role_permissions')->where('role_id',$request->role_id)->count();
                if($count>0){
                DB::table('role_permissions')->where(['role_id'=>$request->role_id])->update($permission_data);
                }else{
                    $user_id = DB::table('role_permissions')->insertGetId($permission_data);
                }

                DB::commit();
                return redirect('/admin/roles-list')->with('success', 'Permission updated successfully');
        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        } 

    }
    



}
