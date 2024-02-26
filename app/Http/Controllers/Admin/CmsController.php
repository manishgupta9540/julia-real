<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CmsManage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use DataTables;
use DB;
use Auth;

class CmsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = CmsManage::select('id','title','created_at','status')->whereIn('status',[0,1])->get();
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
                $edit_url = url('/admin/cms/edit',['id'=>base64_encode($row->id)]);

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
        return view('admin.cms_pages.index');
    }

    public function cmsCreate(Request $request)
    {
        if($request->isMethod('get'))
        {
            return view('admin.cms_pages.create');
        }

        $rules = [
            'title' => 'required',
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
           
            $slug = ltrim(rtrim(strtolower(str_replace(array(' ', '/', '%', '°F', '---', '--'), '-', str_replace(array('&', '?', "'", '"'), '', str_replace('(', '', str_replace(')', '', str_replace(',', '', str_replace('®', '', trim($request->title)))))))), '-'), '-');
            // dd($slug);
            // check to see if any other slugs exist that are the same & count them

            $slug_count = DB::table('blogs')->whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();

            $slug = $slug_count ? "{$slug}-{$slug_count}" : $slug;

            $data = [
                'title' => $request->input('title'),
                'slug' => $slug,
                'description' => $request->input('description'),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s')
            ];
            DB::table('cms_manages')->insert($data);

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

    public function cmsEdit(Request $request)
    {
        $cms_id = base64_decode($request->id);

        $cms_data  = DB::table('cms_manages')->where('id',$cms_id)->first();
        return view('admin.cms_pages.edit',compact('cms_data'));
    }

    public function cmsUpdate(Request $request)
    {
        $cms_id = base64_decode($request->id);

        $rules = [
            'title' => 'required',
            'description' => 'required',
            
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {

            return response()->json([
                'success' => false,
                'errors' => $validation->errors()
            ]);

        }

        //$old_image = DB::table('cms_manages')->where('id',$cms_id)->first();

        DB::beginTransaction();
        try{
            $data1 =   DB::table('cms_manages')->where('id',$cms_id)->first();
            $status = $data1->status;

            $data = [
                'title' => $request->input('title'),
                //'slug' => $slug,
                'description' => $request->input('description'),
                'status' => $status,
                'created_at' => date('Y-m-d H:i:s')
            ];
            DB::table('cms_manages')->where('id',$cms_id)->update($data);

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

    public function cmsDelete(Request $request)
    {
        $blog_id = base64_decode($request->id);
        DB::beginTransaction();
        try{
            $blog = CmsManage::find($blog_id);
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

    public function cmsStatus(Request $request)
    {
        $cms_id=base64_decode($request->id);
        //$user = RoleMaster::find($role_id);
        $type = base64_decode($request->type);
        
        if($type == 'disable')
        { 
            $user = CmsManage::find($cms_id);
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
            $user = CmsManage::find($cms_id);
            $user->status = '1';
            $user->save();
        
            return response()->json([
                'success'=>true,
                'type' => $type,
                'message'=>'Status change successfully.'
            ]);
        }
    }

    public function fetch(Request $request)
    {
        $slug = $request->slug;

        $data = DB::table('cms_manages')->where('slug',$slug)->first();
        
        if(isset($data) && $data->slug == 'terms-conditions'){
            $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
            return view('front.terms-conditions',compact('data','address'));
        }
        if(isset($data) && $data->slug == 'privacy-policy'){
            $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
            return view('front.policy',compact('data','address'));
        }
        if(isset($data) && $data->slug == 'safety'){
            $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
            return view('front.safety',compact('data','address'));
        }
        if(isset($data) && $data->slug == 'helps-contacts'){
            $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
            return view('front.helps_contacts',compact('data','address'));
        }
        if(isset($data) && $data->slug == 'advertisement-packages'){
            $packages     = DB::table('packages')->where('status',1)->get();
           
            $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
            return view('front.advertisement',compact('data','address','packages'));
        }
        $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
        return view('front.policy',compact('data','address'));
    }
    

}
