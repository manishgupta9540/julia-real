<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use DataTables;
use DB;
use Auth;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Banner::select('id','banner_image','created_at','status')->get();
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
                $edit_url = url('/admin/banner/edit',['id'=>base64_encode($row->id)]);

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
                ->editColumn('banner_image', function($data){
                    $url = url("uploads/banner/".$data->banner_image);        
                    return '<img src="'. $url .'" style="width:100px; height:100px;"/>'; 

                })      
                ->rawColumns(['action','status','banner_image'])
                ->make(true);
        }

        return view('admin.banners.index');
        
    }

    public function create(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('admin.banners.create');
        }

        $rules = [
            // 'title' => 'required',
            'banner_image' =>  'required|mimes:jpeg,jpg,bmp,png,gif,svg',
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
           
            $banner = DB::table('banners')->where('user_id',Auth::user()->id)->first();
            if(!empty($banner))
            {
                if($request->file('banner_image'))
                {
                    $image = $request->file('banner_image');
                    $date = date('YmdHis');
                    $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                    $random_no = substr($no, 0, 2);
                    $final_image_name = $date.$random_no.'.'.$image->getClientOriginalExtension();
        
                    $destination_path = public_path('/uploads/banner/');
                    if(!File::exists($destination_path))
                    {
                        File::makeDirectory($destination_path, $mode = 0777, true, true);
                    }
                    $image->move($destination_path , $final_image_name);

                }

                $data = [
                    // 'title' => $request->input('title'),
                    'user_id' => Auth::user()->id,
                    'banner_image' => !empty($final_image_name) ? $final_image_name:NULL,
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                DB::table('banners')->where('user_id',Auth::user()->id)->update($data);
            }
            else
            {
                if($request->file('banner_image'))
                {
                    $image = $request->file('banner_image');
                    $date = date('YmdHis');
                    $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                    $random_no = substr($no, 0, 2);
                    $final_image_name = $date.$random_no.'.'.$image->getClientOriginalExtension();
        
                    $destination_path = public_path('/uploads/banner/');
                    if(!File::exists($destination_path))
                    {
                        File::makeDirectory($destination_path, $mode = 0777, true, true);
                    }
                    $image->move($destination_path , $final_image_name);

                }

                $data = [
                    // 'title' => $request->input('title'),
                    'user_id' => Auth::user()->id,
                    'banner_image' => !empty($final_image_name) ? $final_image_name:NULL,
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                DB::table('banners')->insert($data);
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

    public function bannerEdit(Request $request)
    {
        $banner_id = base64_decode($request->id);

        $banner  = DB::table('banners')->where('id',$banner_id)->first();
        return view('admin.banners.edit',compact('banner'));
    }

    public function bannerUpdate(Request $request)
    {
        $banner_id = base64_decode($request->id);

        $rules = [
            // 'title' => 'required',
            'banner_image' =>  'nullable|mimes:jpeg,jpg,bmp,png,gif,svg',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }

        $old_image = DB::table('banners')->where('id',$banner_id)->first();

        DB::beginTransaction();
        try{

            if($request->file('banner_image'))
            {
                $image = $request->file('banner_image');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_image_name = $date.$random_no.'.'.$image->getClientOriginalExtension();
    
                $destination_path = public_path('/uploads/banner/');
                if(!File::exists($destination_path))
                {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path , $final_image_name);
            }
            else
            {
                $final_image_name = $old_image->banner_image;
            }

            $data1 =   DB::table('banners')->where('id',$banner_id)->first();
            $status = $data1->status;

            $data = [
                // 'title' => $request->input('title'),
                'user_id' => Auth::user()->id,
                'banner_image' => !empty($final_image_name) ? $final_image_name:NULL,
                'status' => $status,
                'created_at' => date('Y-m-d H:i:s')
            ];
            DB::table('banners')->where('id',$banner_id)->update($data);

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

    public function bannerDelete(Request $request)
    {
        $banner_id = base64_decode($request->id);
        DB::beginTransaction();
        try{
            Banner::find($banner_id)->delete($banner_id);

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

    public function bannersStatus(Request $request)
    {
        $banner_id=base64_decode($request->id);
        //$user = RoleMaster::find($role_id);
        $type = base64_decode($request->type);
        
        if($type == 'disable')
        { 
            $user = Banner::find($banner_id);
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
            $user = Banner::find($banner_id);
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
