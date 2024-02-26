<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use DataTables;
use DB;

class ContactUsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Contact::select('id','name','email','phone_number','created_at')->where('status',1)->get();
            return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){

                // if($row->status==1)
                // {
                //     $action_1 = '<span data-d="'.base64_encode($row->id).'"><a href="javascript:;" class="btn btn-outline-dark status" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'" data-name="'.$row->name.'" title="Deactivate"><i class="far fa-times-circle"></i> Deactivate</a></span>
                //                 <span data-a="'.base64_encode($row->id).'" class="d-none"><a href="javascript:;" class="btn btn-outline-success status" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'" data-name="'.$row->name.'" title="Active"><i class="far fa-check-circle"></i> Active</a></span>';
                    
                // }
                // else
                // {
                //     $action_1 = '<span class="d-none" data-d="'.base64_encode($row->id).'"><a href="javascript:;" class="btn btn-outline-dark status" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('disable').'" data-name="'.$row->name.'" title="Deactivate"><i class="far fa-times-circle"></i> Deactivate</a></span>
                //                 <span data-a="'.base64_encode($row->id).'"><a href="javascript:;" class="btn btn-outline-success status" data-id="'.base64_encode($row->id).'" data-type="'.base64_encode('enable').'" data-name="'.$row->name.'"  title="Active"><i class="far fa-check-circle"></i> Active</a></span>';
                // }
                $edit_url = url('/admin/contact-view/edit',['id'=>base64_encode($row->id)]);

                $action_2 = '<a href="'.$edit_url.'" class="btn btn-outline-info" title="Edit"><i class="fas fa-eye text-info"></i></a>';

                $action_3 = '<span><a class="btn btn-outline-danger btn-rounded flush-soft-hover deleteBtn" data-bs-toggle="tooltip" data-placement="top" title=""
                            data-bs-original-title="Delete" href="javascript:void(0)" data-id="'.base64_encode($row->id).'">
                            <i class="fas fa-trash text-danger"></i>
                            </a></span>';

                        
                $action =   '<div class="d-flex align-items-center">
                                <div class="d-flex">
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
                // ->addColumn('status', function ($data) {
                //     if ($data->status==0){
                //         return'<span data-dc="'.base64_encode($data->id).'" class="badge badge-danger">Inactive</span>
                //         <span data-ac="'.base64_encode($data->id).'" class="badge badge-success d-none">Active</span>';
                //     }
                //     else{
                //         return '<span data-dc="'.base64_encode($data->id).'" class="badge badge-danger d-none">Inactive</span>
                //         <span data-ac="'.base64_encode($data->id).'" class="badge badge-success">Active</span>';
                //     }
                // })     
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.contact_pages.index');
    }

    public function contactView(Request $request)
    {   
        $cms_id = base64_decode($request->id);

        $contact_data  = DB::table('contacts')->where('id',$cms_id)->first();
        
        return view('admin.contact_pages.show',compact('contact_data'));
    }

    public function contactDelete(Request $request)
    {
        $contact_id = base64_decode($request->id);
        DB::beginTransaction();
        try{
            $blog = Contact::find($contact_id);
            $blog->delete($contact_id);
            // $blog->save();


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
