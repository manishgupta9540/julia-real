<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\PropertyAttachment;
use App\Models\PropertyDetail;
use App\Models\PropertyLocation;
use DataTables;
use DB;
use Illuminate\Support\Facades\Validator;
use Hash;
use App\Models\Categorye;
use App\Models\AmenitieMaster;
use Intervention\Image\Facades\Image;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Property::whereIn('status',['0','1'])
                            ->select('id','title','is_featured','created_at','status')
                            ->orderBy('id','desc')
                            ->get();
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
                $edit_url = url('/admin/property/edit',['id'=>base64_encode($row->id)]);

                $action_2 = '<a href="'.$edit_url.'" class="btn btn-outline-info" title="Edit"><i class="fas fa-edit text-info"></i></a>';

                $action_3 = '<span><a class="btn btn-outline-danger  btn-rounded flush-soft-hover deleteBtn" data-bs-toggle="tooltip" data-placement="top" title=""
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

                ->addColumn('featured', function ($row) {
                    $action_4 = '';
                    if ($row->is_featured == 0) {
                        $action_4 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover featuredBtn"
                                            data-bs-toggle="tooltip" data-placement="top" title=""
                                            data-bs-original-title="Inactive" href="javascript:void(0)" data-dc="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('enable') . '">
                                            <span class="icon">
                                            <i class="fas fa-toggle-off" style="color:red;"></i></span>
                                        </a>
                                        <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover featuredBtn d-none"
                                            data-bs-toggle="tooltip" data-placement="top" title=""
                                            data-bs-original-title="Active" href="javascript:void(0)" data-ac="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('disable') . '">
                                            <span class="icon">
                                            <i class="fas fa-toggle-on" style="color:green;"></i></span>
                                        </a>';
                        //dd($action_1);
                    } else {
                        $action_4 = '<a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover featuredBtn d-none"
                                            data-bs-toggle="tooltip" data-placement="top" title=""
                                            data-bs-original-title="Inactive" href="javascript:void(0)" data-dc="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('enable') . '">
                                            <span class="icon">
                                            <i class="fas fa-toggle-off" style="color:red;"></i></span>
                                        </a>
                                        <a class="btn btn-icon btn-flush-dark btn-rounded flush-soft-hover featuredBtn"
                                            data-bs-toggle="tooltip" data-placement="top" title=""
                                            data-bs-original-title="Active" href="javascript:void(0)" data-ac="' . base64_encode($row->id) . '" data-id="' . base64_encode($row->id) . '" data-type="' . base64_encode('disable') . '">
                                            <span class="icon">
                                            <i class="fas fa-toggle-on" style="color:green;"></i></span>
                                        </a>';
                    }

                    $action = '<div class="d-flex align-items-center">
                                    <div class="d-flex">
                                    ' . $action_4 . '
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
                
                ->rawColumns(['action','status','featured'])
                ->make(true);
        }

        return view('admin.property.index');
    }

    public function propertyCreate()
    {
        $categorye = Categorye::where('status',1)->get();
        $countries      = DB::table('countries')->get();
        $state          = DB::table('states')->where('country_id','101')->get();
        $aminities      = DB::table('amenitie_masters')->where('status',1)->get(); 
        $users      = DB::table('users')->where('status',1)->get();
        return view('admin.property.create',compact('categorye','countries','state','aminities','users'));
    }

    public function propertyDelete(Request $request)
    {
        
        $p_id =base64_decode($request->id);

        $privacy = Property::find($p_id);
        $privacy->status = '2';  //Association Status in delete mode
        $privacy->save();

        $privacy = PropertyDetail::where('properti_id',$p_id)->first();
        $privacy->status = '2';  //Association Status in delete mode
        $privacy->save();

        $privacy = PropertyLocation::where('properti_id',$p_id)->first();
        $privacy->status = '2';  //Association Status in delete mode
        $privacy->save();

        DB::table('property_attachments')->where('properti_id',$p_id)->update([
            'status' => '2',
            'updated_at' => date('Y-m-d H:i:s')
        ]);
          
        return response()->json(['success'=>true]);  

    }

    public function propertySave(Request $request)
    {
        $prev_session_status  = 0;

        $step = 1;

        $step_1_arr=[];
        $step_2_arr=[];
        $step_3_arr=[];
        $step_4_arr=[];
        $step_5_arr=[];

        $step_err=[];
        //    dd($request->all());
        DB::beginTransaction();
        try{

            $step = $request->step;
            $prev_session_status  = 0;

            if($step==1)
            {
                // dd($step);
                 
                $rules=[
                    'title'             => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:255',
                    'category_id'       => 'required',
                    'listing_status'    => 'required',
                    'property_status'   => 'required',
                    // 'price'             => 'required|integer|min:1',
                    // 'yearly_tax_rate'   => 'required|integer|min:1|lt:price',
                    'rent_type'         => 'required',
                    //'price_label'       => 'required',
                    'customer_id'       => 'required',
                ];
        
                $custom = [
                    'price.required_if' => 'The price field is required',
                    'yearly_tax_rate.lt' => 'The price must be less than yearly_tax_rate'
                ];

                $validator = Validator::make($request->all(), $rules,$custom);
                
                if ($validator->fails()){
                    return response()->json([
                        'success' => false,
                        'error_type'=> 'validation',
                        'errors' => $validator->errors()
                    ]);
                }

        
                DB::commit();
                return response()->json([
                    'success' =>true,
                    'session_status' => $prev_session_status
                ]);

            }
            else if($step==2)
            {
                //dd($step);
                $rules=[
                    'attachment'   => 'required',
                ];
        
                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()){
                    return response()->json([
                        'success' => false,
                        'error_type'=> 'validation',
                        'errors' => $validator->errors()
                    ]);
                }
   
                DB::commit();
                return response()->json([
                    'success' =>true,
                    'session_status' => $prev_session_status
                ]);

            }
            else if($step==3)
            {
                // dd($step);
                $rules=[
                    'address'           => 'required',
                    'country'        => 'required',
                    'state'          => 'required',
                    'city'           => 'required',
                   // 'landmark'          => 'required',
                    'zip_code'          => 'required',
                ];
        
                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()){
                    return response()->json([
                        'success' => false,
                        'error_type'=> 'validation',
                        'errors' => $validator->errors()
                    ]);
                }
                // dd($request->all());

                DB::commit();
                return response()->json([
                    'success' =>true,
                    'session_status' => $prev_session_status
                ]);
            }
            else if($step==4)
            {
                // dd($step);
                $rules=
                [
                    'size_in_ft'        => 'required',
                    'lot_size_in_ft'    => 'required',
                    'rooms'             => 'required',
                    'bedrooms'          => 'required',
                    'bathrooms'         => 'required',
                    'custom_id'         => 'required',
                    'garages'           => 'required',
                    'garage_size'       => 'required',
                    'year_built'        => 'required',
                    'available_date'    => 'required',
                    'basement'          => 'required',
                    'extra_details'     => 'required',
                    'roofing'           => 'required',
                    'exterior_material' => 'required',
                    'floors_no'         => 'required',
                    'agent_notes'       => 'required',
                    'energy_class'      => 'required',
                    'energy_index'      => 'required',
                ];
        
                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()){
                    return response()->json([
                        'success' => false,
                        'error_type'=> 'validation',
                        'errors' => $validator->errors()
                    ]);
                }

                DB::commit();
                return response()->json([
                    'success' =>true,
                    'session_status' => $prev_session_status
                ]);
            }
            else if($step==5)
            {
                $rules=
                [
                    'aminities_id'  => 'required',
                ];

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()){
                    return response()->json([
                        'success' => false,
                        'error_type'=> 'validation',
                        'errors' => $validator->errors()
                    ]);
                }

                $slug = ltrim(rtrim(strtolower(str_replace(array(' ', '/', '%', '°F', '---', '--'), '-', str_replace(array('&', '?', "'", '"'), '', str_replace('(', '', str_replace(')', '', str_replace(',', '', str_replace('®', '', trim($request->title)))))))), '-'), '-');
                // dd($slug);
                // check to see if any other slugs exist that are the same & count them
    
                $slug_count = DB::table('properties')->whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
    
                $slug = $slug_count ? "{$slug}-{$slug_count}" : $slug;

                $price = $request->input('price');
                $yearPrice = $request->input('yearly_tax_rate');

                 $totalprice = $price+ $yearPrice;

                //$price = trim(preg_replace('/^\s+|\s+$|\s+(?=\s)/', '', $request->input('price').''.$request->input('yearly_tax_rate')));
                // dd($price);
                //add property step 1
                $step_1 = 
                    [
                        'title'           => $request->input('title'),
                        'slug'            => $slug,
                        'customer_id'     => $request->input('customer_id'),
                        'is_rent_type'     => $request->input('rent_type'),
                        'discription'     => $request->input('description'),
                        'category_id'     => $request->input('category_id'),
                        'listing_status'  => $request->input('listing_status'),
                        'property_status' => $request->input('property_status'),
                        'price'           => $totalprice,
                        'yearly_tax_rate' => $request->input('yearly_tax_rate'),
                        'price_label'     => $request->input('price_label'),
                        'property_status' => $request->input('property_status'),
                        'status'          => 1,
                        'created_at'      => date('Y-m-d H:i:s')
                    ];
                // dd($step_1);
                $propertyeId = DB::table('properties')->insertGetId($step_1);

                
                 // Store the Step 2 Data
                 if($request->hasFile('attachment') && $request->file('attachment') !="")
                 {
                    $filePath = public_path('/uploads/property/'); 
                    $files= $request->file('attachment');
        
                    if($request->hasFile('attachment') && $request->file('attachment') !="")
                    {
                    $filePath = public_path('/uploads/property/'); 
                        foreach($files as $file)
                        {
                            $file_data = $file->getClientOriginalName();
                            $tmp_data  = date('YmdHis').'-'.$file_data; 
                           // $data = $file->move($filePath, $tmp_data);
                            
                            $img = Image::make($file->getRealPath());
                            $img->resize('500', '500', function ($constraint) {
                               $constraint->aspectRatio();
                            })->save($filePath.$tmp_data);

                            DB::table('property_attachments')->insert(
                            [
                                'properti_id'     => $propertyeId,
                                'attachment'      => $tmp_data,
                                'status'          => 1,
                                'created_at'      => date('Y-m-d H:i:s')
                            ]
                            );
                        }
                    }
                 }
                //  $allowedextension=['jpg','jpeg','png','svg','pdf','JPG','PDF','JPEG','PNG','webp'];

                //  if($request->hasFile('attachment') && $request->file('attachment') !="")
                //  {
                //      $filePath = public_path('/uploads/property/'); 
                //      $files= $request->file('attachment');
     
                //      foreach($files as $file)
                //      {
                //          $extension = $file->getClientOriginalExtension();
     
                //          $check = in_array($extension,$allowedextension);
     
                //          if(!$check)
                //          {
                //              return response()->json([
                //                  'fail' => true,
                //                  'errors' => ['attachment' => 'Only jpg,jpeg,png,pdf are allowed !'],
                //                  'error_type'=>'validation'
                //              ]);                        
                //          }
                //      }
                     
                //      if($request->hasFile('attachment') && $request->file('attachment') !="")
                //      {
                //        $filePath = public_path('/uploads/property/'); 
                //        foreach($files as $file)
                //        {
                //          $file_data = $file->getClientOriginalName();
                //          $tmp_data  = date('YmdHis').'-'.$file_data; 
                //          $data = $file->move($filePath, $tmp_data);
                         
                //          DB::table('property_attachments')->insert(
                //            [
                //             'properti_id'     => $propertyeId,
                //             'attachment'      => $tmp_data,
                //             'status'          => 1,
                //             'created_at'      => date('Y-m-d H:i:s')
                //            ]
                //          );
                //        }
                //      }

                   
                //  }


                //location add step 3
                $location = 
                [
                    'properti_id'     => $propertyeId,
                    'address'         => $request->input('address'),
                    'latitude'         => $request->input('lat'),
                    'longitude'         => $request->input('lng'),
                    'country_id'      => $request->input('country'),
                    'state_id'        => $request->input('state'),
                    'city_id'         => $request->input('city'),
                    'landmark'        => $request->input('landmark'),
                    'zip_code'        => $request->input('zip_code'),
                    'status'          => 1,
                    'created_at'      => date('Y-m-d H:i:s')
                ];
                // dd($location);
                DB::table('property_locations')->insert($location);



                //details add step 4
                $aminitiesid = [];
                $aminities_id = $request->input('aminities_id');
                $aminitiesid = implode(',', $aminities_id); 

                $property_details = 
                [
                    'properti_id'     => $propertyeId,
                    'size_in_ft'      => $request->input('size_in_ft'),
                    'lot_size_in_ft'  => $request->input('lot_size_in_ft'),
                    'rooms'           => $request->input('rooms'),
                    'bedrooms'        => $request->input('bedrooms'),
                    'bathrooms'       => $request->input('bathrooms'),
                    'custom_id'       => $request->input('custom_id'),
                    'garages'         => $request->input('garages'),
                    'garage_size'     => $request->input('garage_size'),
                    'year_built'      => $request->input('year_built'),
                    'available_date'   => $request->input('available_date'),
                    'basement'         => $request->input('basement'),
                    'extra_details'     => $request->input('extra_details'),
                    'roofing'           => $request->input('roofing'),
                    'exterior_material' => $request->input('exterior_material'),
                    'floors_no'         => $request->input('floors_no'),
                    'energy_class'      => $request->input('energy_class'),
                    'energy_index'      => $request->input('energy_index'),
                    'agent_notes'       => $request->input('agent_notes'),
                    'amenities_id'      => $aminitiesid,
                    'status'           => 1,
                    'created_at'        => date('Y-m-d H:i:s')
                ];

                DB::table('property_details')->insert($property_details);


                DB::commit();
                return response()->json([
                    'success' =>true,
                    'session_status' => $prev_session_status
                ]);
            }


        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
    }

    public function propertyEdit(Request $request)
    {
        $property_id = base64_decode($request->id);

        $propertie = DB::table('property_locations as p')
                    ->select('p.*')
                    ->where(['p.properti_id'=>$property_id])
                    ->first();
        // dd($propertie);  
        
        $properties = DB::table("properties")->where('id', $property_id)->first();
        $property_attachment = DB::table("property_attachments")->where('properti_id', $property_id)->get();
        $property_locations = DB::table("property_locations")->where('properti_id', $property_id)->first();
        $property_details = DB::table("property_details")->where('properti_id', $property_id)->first();
        $categorye =    Categorye::where('status',1)->get();

        $countries      = DB::table('countries')->get();
        $state          = DB::table('states')->where('country_id',$propertie->country_id)->get();
        $citie         = DB::table('cities')->where('state_id',$propertie->state_id)->get();
        

        $aminities      = DB::table('amenitie_masters')->where('status',1)->get(); 
        $users      = DB::table('users')->where('status',1)->get();

        return view('admin.property.edit',compact('categorye','propertie','countries','state','citie','aminities','users','properties','property_attachment','property_locations','property_details'));
    }


    public function propertyUpdate(Request $request)
    {
        $prev_session_status  = 0;

        $step = 1;

        $step_1_arr=[];
        $step_2_arr=[];
        $step_3_arr=[];
        $step_4_arr=[];
        $step_5_arr=[];

        $step_err=[];
        //    dd($request->all());
        DB::beginTransaction();
        try{

            $step = $request->step;
            $prev_session_status  = 0;

            if($step==1)
            {
                // dd($step);
                 
                $rules=[
                    'title'             => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:255',
                    'category_id'       => 'required',
                    'listing_status'    => 'required',
                    'property_status'   => 'required',
                    // 'price'             => 'required|integer|min:1',
                    // 'yearly_tax_rate'   => 'required|integer|min:1|lt:price',
                    //'price_label'       => 'required',
                    'rent_type'         => 'required',
                ];

                $custom = [
                    'price.required_if' => 'The price field is required',
                    'yearly_tax_rate.lt' => 'The price must be less than yearly_tax_rate'
                ];
        
                $validator = Validator::make($request->all(), $rules,$custom);
                
                if ($validator->fails()){
                    return response()->json([
                        'success' => false,
                        'error_type'=> 'validation',
                        'errors' => $validator->errors()
                    ]);
                }
        
                DB::commit();
                return response()->json([
                    'success' =>true,
                    'session_status' => $prev_session_status
                ]);

            }
            else if($step==2)
            {
                //dd($step);
                // $rules=[
                //     'attachment'   => 'nullable|mimes:jpeg,jpg,jpg,bmp,png,gif,svg',
                // ];
        
                // $validator = Validator::make($request->all(), $rules);

                // if ($validator->fails()){
                //     return response()->json([
                //         'success' => false,
                //         'error_type'=> 'validation',
                //         'errors' => $validator->errors()
                //     ]);
                // }
   
                DB::commit();
                return response()->json([
                    'success' =>true,
                    'session_status' => $prev_session_status
                ]);

            }
            else if($step==3)
            {
                // dd($step);
                $rules=[
                    'address'           => 'required',
                    'country'        => 'required',
                    'state'          => 'required',
                    'city'           => 'required',
                    //'landmark'          => 'required',
                    'zip_code'          => 'required',
                ];
        
                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()){
                    return response()->json([
                        'success' => false,
                        'error_type'=> 'validation',
                        'errors' => $validator->errors()
                    ]);
                }
                // dd($request->all());

                DB::commit();
                return response()->json([
                    'success' =>true,
                    'session_status' => $prev_session_status
                ]);
            }
            else if($step==4)
            {
                // dd($step);
                $rules=
                [
                    'size_in_ft'        => 'required',
                    'lot_size_in_ft'    => 'required',
                    'rooms'             => 'required',
                    'bedrooms'          => 'required',
                    'bathrooms'         => 'required',
                    'custom_id'         => 'required',
                    'garages'           => 'required',
                    'garage_size'       => 'required',
                    'year_built'        => 'required',
                    'available_date'    => 'required',
                    'basement'          => 'required',
                    'extra_details'     => 'required',
                    'roofing'           => 'required',
                    'exterior_material' => 'required',
                    'floors_no'         => 'required',
                    //'agent_notes'       => 'required',
                    'energy_class'      => 'required',
                    'energy_index'      => 'required',
                ];
        
                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()){
                    return response()->json([
                        'success' => false,
                        'error_type'=> 'validation',
                        'errors' => $validator->errors()
                    ]);
                }

                DB::commit();
                return response()->json([
                    'success' =>true,
                    'session_status' => $prev_session_status
                ]);
            }
            else if($step==5)
            {
                $rules=
                [
                    'aminities_id'  => 'required',
                ];

                $validator = Validator::make($request->all(), $rules);

                if ($validator->fails()){
                    return response()->json([
                        'success' => false,
                        'error_type'=> 'validation',
                        'errors' => $validator->errors()
                    ]);
                }

                $slug = ltrim(rtrim(strtolower(str_replace(array(' ', '/', '%', '°F', '---', '--'), '-', str_replace(array('&', '?', "'", '"'), '', str_replace('(', '', str_replace(')', '', str_replace(',', '', str_replace('®', '', trim($request->title)))))))), '-'), '-');
                // dd($slug);
                // check to see if any other slugs exist that are the same & count them
    
                $slug_count = DB::table('properties')->whereRaw("slug RLIKE '^{$slug}(-[0-9]+)?$'")->count();
    
                $slug = $slug_count ? "{$slug}-{$slug_count}" : $slug;


                $propties_id = base64_decode($request->id);

                $price = $request->input('price');
                $yearPrice = $request->input('yearly_tax_rate');

                 $totalprice = $price+ $yearPrice;
                //$price = trim(preg_replace('/^\s+|\s+$|\s+(?=\s)/', '', $request->input('price').''.$request->input('yearly_tax_rate')));
                //add property step 1

                $data1 =   DB::table('properties')->where('id',$propties_id)->first();
                $status = $data1->status;

                $properties = 
                    [
                        'title'           => $request->input('title'),
                        'slug'            => $slug,
                        'customer_id'     => $request->input('customer_id'),
                        'is_rent_type'     => $request->input('rent_type'),
                        'discription'     => $request->input('description'),
                        'category_id'     => $request->input('category_id'),
                        'listing_status'  => $request->input('listing_status'),
                        'property_status' => $request->input('property_status'),
                        'price'           => $totalprice,
                        'yearly_tax_rate' => $request->input('yearly_tax_rate'),
                        'price_label'     => $request->input('price_label'),
                        'property_status' => $request->input('property_status'),
                        'status'          => $status,
                        'created_at'      => date('Y-m-d H:i:s')
                    ];
                // dd($properties);
                $propertyeId=  DB::table('properties')->where('id',$propties_id)->update($properties);


                //add property step 2
                 $allowedextension=['jpg','jpeg','png','svg','pdf','JPG','PDF','JPEG','PNG'];

                 if($request->hasFile('attachment') && $request->file('attachment') !="")
                 {
                     $filePath = public_path('/uploads/property/'); 
                     $files= $request->file('attachment');
     
                     foreach($files as $file)
                     {
                         $extension = $file->getClientOriginalExtension();
     
                         $check = in_array($extension,$allowedextension);
     
                         if(!$check)
                         {
                             return response()->json([
                                 'fail' => true,
                                 'errors' => ['attachment' => 'Only jpg,jpeg,png,pdf are allowed !'],
                                 'error_type'=>'validation'
                             ]);                        
                         }
                     }
 
                     if($request->hasFile('attachment') && $request->file('attachment') !="")
                     {
                       $filePath = public_path('/uploads/property/'); 
                       foreach($files as $file)
                       {
                         $file_data = $file->getClientOriginalName();
                         $tmp_data  = date('YmdHis').'-'.$file_data; 
                        //  $data = $file->move($filePath, $tmp_data);
                         
                         $img = Image::make($file->getRealPath());
                         $img->resize('500', '500', function ($constraint) {
                            $constraint->aspectRatio();
                         })->save($filePath.$tmp_data);

                        $attachments_data = ([
                            'properti_id'     => $propties_id,
                            'attachment'      => $tmp_data,
                            'status'          => 1,
                            'created_at'      => date('Y-m-d H:i:s')
                           ]);

                           DB::table('property_attachments')->insert($attachments_data);
                       }
                     }

                    //  foreach($files as $file)
                    //  {
                    //      $file_data = $file->getClientOriginalName();
                    //      $file_ext = $file->getClientOriginalExtension();
                    //      $tmp_data  = $propertyeId.'-'.date('mdYHis').'.'.$file_ext; 
                    //      $data = $file->move($filePath, $tmp_data);       
                    //      $attach_on_select[]=$tmp_data;
 
                    //      $path=public_path()."/uploads/property/".$tmp_data; 
                         
                    //      $candiadteAttachment = ([
                    //          'properti_id'     => $propties_id,
                    //          'attachment'      => $tmp_data,
                    //          'status'          => 1,
                    //          'created_at'      => date('Y-m-d H:i:s')
                    //      ]);
                      
                    //      DB::table('property_attachments')->where('id',$propties_id)->update($candiadteAttachment);
                    //  } 
                 }


                //location add step 3
                $location = 
                [
                    'properti_id'     => $propties_id,
                    'address'         => $request->input('address'),
                    'latitude'         => $request->input('lat'),
                    'longitude'         => $request->input('lng'),
                    'country_id'      => $request->input('country'),
                    'state_id'        => $request->input('state'),
                    'city_id'         => $request->input('city'),
                    'landmark'        => $request->input('landmark'),
                    'zip_code'        => $request->input('zip_code'),
                    'status'          => 1,
                    'created_at'      => date('Y-m-d H:i:s')
                ];
                // dd($location);
                DB::table('property_locations')->where('properti_id',$propties_id)->update($location);



                //details add step 4
                $aminitiesid = [];
                $aminities_id = $request->input('aminities_id');
                $aminitiesid = implode(',', $aminities_id); 

                $property_details = 
                [
                    'properti_id'     => $propties_id,
                    'size_in_ft'      => $request->input('size_in_ft'),
                    'lot_size_in_ft'  => $request->input('lot_size_in_ft'),
                    'rooms'           => $request->input('rooms'),
                    'bedrooms'        => $request->input('bedrooms'),
                    'bathrooms'       => $request->input('bathrooms'),
                    'custom_id'       => $request->input('custom_id'),
                    'garages'         => $request->input('garages'),
                    'garage_size'     => $request->input('garage_size'),
                    'year_built'      => $request->input('year_built'),
                    'available_date'   => $request->input('available_date'),
                    'basement'         => $request->input('basement'),
                    'extra_details'     => $request->input('extra_details'),
                    'roofing'           => $request->input('roofing'),
                    'exterior_material' => $request->input('exterior_material'),
                    'floors_no'         => $request->input('floors_no'),
                    'energy_class'      => $request->input('energy_class'),
                    'energy_index'      => $request->input('energy_index'),
                    'agent_notes'       => $request->input('agent_notes'),
                    'amenities_id'      => $aminitiesid,
                    'status'           => 1,
                    'created_at'        => date('Y-m-d H:i:s')
                ];
                // dd($property_details);
                DB::table('property_details')->where('properti_id',$propties_id)->update($property_details);


                DB::commit();
                return response()->json([
                    'success' =>true,
                    'session_status' => $prev_session_status
                ]);
            }


        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }
    }

    public function removeImage(Request $request)
    {        
       $id =  $request->input('id');
       DB::beginTransaction();
       try{
         DB::table('property_attachments')->where('id',$id)->delete();
          DB::commit();
          // Do something when it fails
          return response()->json([
              'fail' => false,
              'message' => 'File removed!'
          ]);
        }
        catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $e;
        }       
    }

    public function propertyStatus(Request $request)
    {
        $pr_id=base64_decode($request->id);
        //$user = RoleMaster::find($role_id);
        $type = base64_decode($request->type);
        
        if($type == 'disable')
        { 
            $user = Property::find($pr_id);
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
            $user = Property::find($pr_id);
            $user->status = '1';
            $user->save();
        
            return response()->json([
                'success'=>true,
                'type' => $type,
                'message'=>'Status change successfully.'
            ]);
        }
    }

    //featured
    public function featuredStatus(Request $request)
    {
        $pr_id=base64_decode($request->id);
        //$user = RoleMaster::find($role_id);
        $type = base64_decode($request->type);
        // dd($type);
        
        if($type == 'disable')
        { 
            $user = Property::find($pr_id);
            $user->is_featured = '0';
            $user->save();
            
            return response()->json([
                'success'=>true,
                'type' => $type,
                'message'=>'Status change successfully.'
            ]);
        }
        if($type == 'enable')
        {   
            $user = Property::find($pr_id);
            $user->is_featured = '1';
            $user->save();
        
            return response()->json([
                'success'=>true,
                'type' => $type,
                'message'=>'Status change successfully.'
            ]);
        }
    }


    //state get
    public function getstate(Request $request)
    {
       $country_id = $request->country_id; 
        
       $state = DB::table('states')->where('country_id',$country_id)->get();

       return response()->json($state);
     
    }
    
    //city get
    public function getcity(Request $request)
    {
       $state_id = $request->state_id; 

       $city = DB::table('cities')->where('state_id',$state_id)->get();

       return response()->json($city);
    }

}
