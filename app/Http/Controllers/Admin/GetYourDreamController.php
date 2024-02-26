<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GetYourDream;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use DataTables;
use DB;


class GetYourDreamController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = GetYourDream::select('id','title','image','created_at','status')->whereIn('status',[0,1])->get();
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
                $edit_url = url('/admin/get-your-dream/edit',['id'=>base64_encode($row->id)]);

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
                ->editColumn('image', function($data){
                    $url = url("uploads/dream/".$data->image);        
                    return '<img src="'. $url .'" style="width:100px; height:100px;"/>'; 

                })      
                ->rawColumns(['action','status','image'])
                ->make(true);
        }

        return view('admin.getdream.index');
        
    }

    public function create(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('admin.getdream.create');
        }

        $rules = [
            'title' => 'required',
            'description' => 'required',
            'image' =>  'required|mimes:jpeg,jpg,bmp,png,gif,svg',
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
           
            if($request->file('image'))
            {
                $image = $request->file('image');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_image_name = $date.$random_no.'.'.$image->getClientOriginalExtension();
    
                $destination_path = public_path('/uploads/dream/');
                if(!File::exists($destination_path))
                {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path , $final_image_name);

            }

            $data = [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'image' => !empty($final_image_name) ? $final_image_name:NULL,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];
            DB::table('get_your_dreams')->insert($data);

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

    public function getYourDreamEdit(Request $request)
    {
        $dream_id = base64_decode($request->id);

        $getDreame  = DB::table('get_your_dreams')->where('id',$dream_id)->first();
        return view('admin.getdream.edit',compact('getDreame'));
    }

    public function getYourDreamUpdate(Request $request)
    {
        $dream_id = base64_decode($request->id);

        $rules = [
            'title' => 'required',
            'description' => 'required',
            'image' =>  'nullable|mimes:jpeg,jpg,bmp,png,gif,svg',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }

        $old_image = DB::table('get_your_dreams')->where('id',$dream_id)->first();

        DB::beginTransaction();
        try{

            $data1 =   DB::table('get_your_dreams')->where('id',$dream_id)->first();
            $status = $data1->status;

            if($request->file('image'))
            {
                $image = $request->file('image');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_image_name = $date.$random_no.'.'.$image->getClientOriginalExtension();
    
                $destination_path = public_path('/uploads/dream/');
                if(!File::exists($destination_path))
                {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path , $final_image_name);
            }
            else
            {
                $final_image_name = $old_image->image;
            }

            $data = [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'image' => !empty($final_image_name) ? $final_image_name:NULL,
                'status' => $status,
                'created_at' => date('Y-m-d H:i:s')
            ];
            DB::table('get_your_dreams')->where('id',$dream_id)->update($data);

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

    public function getYourDreamDelete(Request $request)
    {
        $blog_id = base64_decode($request->id);
        DB::beginTransaction();
        try{
            $blog = GetYourDream::find($blog_id);
            $blog->status = '2';
            $blog->save();


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

    public function getYourDreamStatus(Request $request)
    {
        $dream_id=base64_decode($request->id);
        //$user = RoleMaster::find($role_id);
        $type = base64_decode($request->type);
        
        if($type == 'disable')
        { 
            $user = GetYourDream::find($dream_id);
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
            $user = GetYourDream::find($dream_id);
            $user->status = '1';
            $user->save();
        
            return response()->json([
                'success'=>true,
                'type' => $type,
                'message'=>'Status change successfully.'
            ]);
        }
    }
}
