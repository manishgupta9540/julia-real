<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FindSelling;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use DataTables;
use DB;
use Auth;

class FindSellingController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = FindSelling::select('id','title','image','created_at','status')->whereIn('status',[0,1])->get();
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
                $edit_url = url('/admin/find-sell/edit',['id'=>base64_encode($row->id)]);

                $action_2 = '<a href="'.$edit_url.'" class="btn btn-outline-info" title="Edit"><i class="fas fa-edit text-info"></i></a>';

                // $action_3 = '<span><a class="btn btn-outline-danger btn-rounded flush-soft-hover deleteBtn" data-bs-toggle="tooltip" data-placement="top" title=""
                //             data-bs-original-title="Delete" href="javascript:void(0)" data-id="'.base64_encode($row->id).'">
                //             <i class="fas fa-trash text-danger"></i>
                //             </a></span>';

                        
                $action =   '<div class="d-flex align-items-center">
                                <div class="d-flex">
                                '.$action_1.'
                                '.$action_2.'
                                
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
                    $url = url("uploads/why/".$data->image);        
                    return '<img src="'. $url .'" style="width:100px; height:100px;"/>'; 

                })      
                ->rawColumns(['action','status','image'])
                ->make(true);
        }

        return view('admin.find_sell.index');
        
    }

    public function create(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('admin.find_sell.create');
        }

        $rules = [
            'title'      => 'required',
            'property_types' => 'sometimes|required',
            'image'            =>  'required|mimes:jpeg,jpg,bmp,png,gif,svg',
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
    
                $destination_path = public_path('/uploads/why/');
                if(!File::exists($destination_path))
                {
                    File::makeDirectory($destination_path, $mode = 0777, true, true);
                }
                $image->move($destination_path , $final_image_name);

            }

            $chose_point=[];
            if($request->has('property_types'))
            {
                if(count($request->property_types)>0)
                {
                    foreach ($request->property_types as $key => $value) 
                    {
                        $chose_point[] = [
                             $request->property_types[$key]=>$request->property_description[$key], 
                        ];
                    }
                    
                }
                $json_array = json_encode($chose_point);
            }

            $data = [
                'title'     => $request->input('title'),
                'image'           => !empty($final_image_name) ? $final_image_name:NULL,
                'property_types' => count($chose_point) > 0 ? json_encode($chose_point) : NULL,
                'status'          => 1,
                'created_at'      => date('Y-m-d H:i:s')
            ];
            DB::table('find_sellings')->insert($data);

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

    public function findSellEdit(Request $request)
    {
        $find_id = base64_decode($request->id);

        $choose  = DB::table('find_sellings')->where('id',$find_id)->first();
        $choosesibgle  = DB::table('find_sellings')->where('id',$find_id)->first();
        return view('admin.find_sell.edit',compact('choose','choosesibgle'));
    }

    public function findSellDelete(Request $request)
    {
        $id = base64_decode($request->id);

        $choose_id = base64_decode($request->customer_id);

        DB::beginTransaction();
        try{
            if(Auth::check()){

                $why_choose = DB::table('find_sellings')->where(['id'=>$choose_id])->first();

                $spoke_arr = [];

                $spoke_arr = json_decode($why_choose->property_types,2);

                unset($spoke_arr[$id]);

                DB::table('find_sellings')->where(['id'=>$choose_id])->update([
                    'property_types' => count($spoke_arr) > 0 ? json_encode($spoke_arr) : NULL
                ]);
                
                //return result 
                 
                    
                DB::commit();
                return response()->json([
                'status'=>'ok',
                'message' => 'deleted',                
                ], 200);
    
            }
            else{   
                return response()->json([
                    'status' =>'no',
                    ], 200);
            }
        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }       
    }

    public function findSellUpdate(Request $request)
    {
        $choose_id = base64_decode($request->id);
        
        $rules = [
            'title'      => 'required',
            'property_types' => 'sometimes|required',
            'image' =>  'nullable|mimes:jpeg,jpg,bmp,png,gif,svg',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }

        $old_image = DB::table('find_sellings')->where('id',$choose_id)->first();

        DB::beginTransaction();
        try{

            $data1 =   DB::table('find_sellings')->where('id',$choose_id)->first();
            $status = $data1->status;

            if($request->file('image'))
            {
                $image = $request->file('image');
                $date = date('YmdHis');
                $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                $random_no = substr($no, 0, 2);
                $final_image_name = $date.$random_no.'.'.$image->getClientOriginalExtension();
    
                $destination_path = public_path('/uploads/blogs/');
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

            $chose_point=[];
            if($request->has('property_types'))
            {
                if(count($request->property_types)>0)
                {
                    foreach ($request->property_types as $key => $value) 
                    {
                        $chose_point[] = [
                             $request->property_types[$key]=>$request->property_description[$key], 
                        ];
                    }
                }
                $json_array = json_encode($chose_point);
            }
        

            $data = [
                'title'     => $request->input('title'),
                'image'           => !empty($final_image_name) ? $final_image_name:NULL,
                'property_types' => count($chose_point) > 0 ? json_encode($chose_point) : NULL,
                'status'          => $status,
                'created_at'      => date('Y-m-d H:i:s')
            ];

            DB::table('find_sellings')->where('id',$choose_id)->update($data);

           
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

    public function whyChooseDelete(Request $request)
    {
        $choose_id = base64_decode($request->id);
        DB::beginTransaction();
        try{
            $blog = WhyChoose::find($choose_id);
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

    public function findSellStatus(Request $request)
    {
        $choose_id=base64_decode($request->id);
        //$user = RoleMaster::find($role_id);
        $type = base64_decode($request->type);
        
        if($type == 'disable')
        { 
            $user = FindSelling::find($choose_id);
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
            $user = FindSelling::find($choose_id);
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
