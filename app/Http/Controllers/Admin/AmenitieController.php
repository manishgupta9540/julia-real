<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\AmenitieMaster;
use DataTables;
use DB;


class AmenitieController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = AmenitieMaster::whereIn('status',['0','1'])->select('id','amenities_name','created_at','status')->get();
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
                $edit_url = url('/admin/aminities/edit',['id'=>base64_encode($row->id)]);

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

        return view('admin.aminities.index');
    }

    public function create(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('admin.aminities.create');
        }

        $rules = [
            'amenities_name' => 'required',
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

            $aminities = new AmenitieMaster();
            $aminities->amenities_name= $request->amenities_name; 
            $aminities->status ='1';
            $aminities->save();
            

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


    public function aminitiesEdit(Request $request)
    {
        $ami_id = base64_decode($request->id);

        $aminities  = DB::table('amenitie_masters')->where('id',$ami_id)->first();
        return view('admin.aminities.edit',compact('aminities'));
    }

    public function aminitiesUpdate(Request $request)
    {
        $ami_id = base64_decode($request->id);;
        // dd($$da)
        $rules = [
            'amenities_name' => 'required',
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

            $data1 =   DB::table('amenitie_masters')->where('id',$ami_id)->first();
            $status = $data1->status;
            $data = [
                'amenities_name' => $request->input('amenities_name'),
                'status' => $status,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            DB::table('amenitie_masters')->where('id',$ami_id)->update($data);

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

    public function aminitiesDelete(Request $request)
    {
        $ami_id = base64_decode($request->id);
        DB::beginTransaction();
        try{
            $aminities = AmenitieMaster::find($ami_id);
            $aminities->status = '2';
            $aminities->save();


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

    public function aminitiesStatus(Request $request)
    {
        $user_id=base64_decode($request->id);
        //$user = User::find($user_id);
        $type = base64_decode($request->type);

        if($type == 'disable')
        { 
            $users =  DB::table('amenitie_masters')->where('id',$user_id)->update(['status'=>0]);;
            return response()->json([
                'success'=>true,
                'type' => $type,
                'message'=>'Status change successfully.'
            ]);
        }
        elseif($type == 'enable')
        {   
            $users = DB::table('amenitie_masters')->where('id',$user_id)->update(['status'=>1]);
            
            return response()->json([
                'success'=>true,
                'type' => $type,
                'message'=>'Status change successfully.'
            ]);
        }
        
    }
}
