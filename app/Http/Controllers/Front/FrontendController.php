<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Categorye;
use App\Models\AmenitieMaster;
use App\Models\Property;
use App\Models\About;
use App\Models\FaqRent;
use App\Models\Faq;
use App\Models\User;
use App\Models\Wishlisht;
use App\Models\PropertieCities;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use DB;
use Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $propertyes = DB::table('properties as p')
                        ->select('p.*','pl.address','pl.country_id','pl.state_id','pl.city_id','pd.bedrooms','pd.bathrooms','pd.size_in_ft')
                        ->join('property_locations as pl','pl.properti_id','=','p.id')
                        // ->join('countries as cr','cr.id','=','pl.country_id')
                        // ->join('cities as c','c.id','=','pl.city_id')
                        ->join('property_details as pd','pd.properti_id','=','p.id')
                        ->where('p.status',1)
                        ->where('p.is_rent_type',2)
                        ->orderBy('p.created_at','desc')
                        ->take(4)
                        ->get();
        // dd($propertyes);
        $propertyestype = DB::table('properties as p')
                        ->select('p.*','pl.address','pl.country_id','pl.state_id','pl.city_id','pd.bedrooms','pd.bathrooms','pd.size_in_ft')
                        ->join('property_locations as pl','pl.properti_id','=','p.id')
                        ->join('property_details as pd','pd.properti_id','=','p.id')
                        ->where('p.status',1)
                        ->where('p.is_rent_type',1)
                        ->orderBy('p.created_at','desc')
                        ->take(4)
                        ->get();
                        //dd($propertyes);

        $propertyesrecomend = DB::table('properties as p')
                        ->select('p.*','pl.address','pl.country_id','pl.state_id','pl.city_id','pd.bedrooms','pd.bathrooms','pd.size_in_ft')
                        ->join('property_locations as pl','pl.properti_id','=','p.id')
                        ->join('property_details as pd','pd.properti_id','=','p.id')
                        ->where('p.status',1)
                        ->orderBy('p.created_at','desc')
                        ->get();          
                    // dd($propertyesrecomend);        
        $blogs = Blog::where('status',1)->take(3)->orderBy('id','desc')->get();
        $banners = Banner::where('status',1)->get();
        $categoryes = DB::table('categoryes')->take(4)->get();
        $category = DB::table('categoryes')->where('status','1')->get();
        $ourPerents = DB::table('our_pertners')->where('status',1)->orderBy('id','desc')->get();
        $propertCities = DB::table('propertie_cities')->where('status',1)->orderBy('id','desc')->get();
        $whyChooses = DB::table('why_chooses')->where('status',1)->orderBy('id','desc')->get();
        $findSellings = DB::table('find_sellings')->where('status',1)->orderBy('id','desc')->get();
        $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
        $addbasic = DB::table('advertisements')->where('package_id',1)->where('status',1)->orderBy('package_id','desc')->get();
        $addsilver = DB::table('advertisements')->where('package_id',2)->where('status',1)->orderBy('package_id','desc')->get();
        $addgold = DB::table('advertisements')->where('package_id',3)->where('status',1)->orderBy('package_id','desc')->get();
        $adddiamond = DB::table('advertisements')->where('package_id',4)->where('status',1)->orderBy('package_id','desc')->get();
        $getDreame = DB::table('get_your_dreams')->where('status',1)->orderBy('id','desc')->get();
        return view('front.index',compact('banners','blogs','category','propertyes','propertyesrecomend','categoryes','ourPerents','propertyestype','propertCities','whyChooses','findSellings','address','addbasic','addsilver','addgold','adddiamond','getDreame'));
    }

    public function autocomplete(Request $request)
    {
        if($request->ajax())
        {
            $data = DB::table('properties as p')
                    ->select('p.*','c.name')
                    ->join('categoryes as c','c.id','=','p.category_id')
                    //->where('p.title','LIKE','%'.$request->title.'%')
                    ->where('c.name','LIKE','%'.$request->categoryes_id.'%')
                    ->get();
            // dd($data);
            $output = '';           
            if(count($data)>0){
                $output .= '<ul class="list-group" style="display:blcok;" position-relative;z-index:1;>';
                    foreach($data as $row){
                        $output .= '<li class="list-group-item row_title">'.$row->name.'</li>';
                    }
                $output .= '</ul>';
            }else{
            
                $output .= '<li class="list-group-item">No Product Found</li>';
            }
            return $output;
        }
    }

    public function propertyListing(Request $request)
    {
         
        $propertyes = DB::table('properties as p')
                    ->select('p.*','pl.address','pl.country_id','pl.state_id','pl.city_id','pd.bedrooms','pd.bathrooms','pd.size_in_ft')
                    ->join('property_locations as pl','pl.properti_id','=','p.id')
                    ->join('property_details as pd','pd.properti_id','=','p.id')
                    ->join('categoryes as ca','ca.id','=','p.category_id')
                    ->where('p.status',1);

        if($request->get('categoryes_id')){
            $propertyes->where('ca.id','like','%'.$request->get('categoryes_id').'%');
        }  
        
        if($request->get('fore_rent2') != ''){
            $propertyes->where('p.is_rent_type',2);
        }
        if($request->get('fore_sale1') != ''){
            $propertyes->where('p.is_rent_type',1);
        }
        
        $propertyes = $propertyes->orderBy('p.id','asc')->paginate(10);       
    
        //dd($propertyes);

       if(!isset($propertyes)){
            $propertyes = [];
        }
        $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
       return view('front.properting_listing',compact('propertyes','address'));
    }

    public function about()
    {
        $abouts = About::where('status',1)->orderBy('id','desc')->first();
        $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
        $ourPerents = DB::table('our_pertners')->where('status',1)->orderBy('id','desc')->get();
        $findSellings = DB::table('find_sellings')->where('status',1)->orderBy('id','desc')->get();
        return view('front.about',compact('abouts','address','ourPerents','findSellings'));
    }

    public function contact()
    {
        $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
        return view('front.contact',compact('address'));
    }

    public function details(Request $request)
    {
        $id = base64_decode($request->id);
        $property_slug  = DB::table('properties as p')
                            ->select('p.*','pl.address','pl.country_id','pl.state_id','pl.city_id','pl.zip_code','pl.landmark','pl.latitude','pl.longitude','pd.bedrooms','pd.bathrooms','pd.size_in_ft')
                            ->join('property_locations as pl','pl.properti_id','=','p.id')
                            ->join('property_details as pd','pd.properti_id','=','p.id')
                            ->join('categoryes as ca','ca.id','=','p.category_id')
                            ->where('p.status',1)
                            ->where('p.id',$id)
                            ->first();

        $latitude = $property_slug->latitude; 
        $longitude = $property_slug->longitude; 
       
        if(isset($property_slug))
        {
            $property_details = DB::table('property_details')->where('properti_id',$property_slug->id)->first();
            $aminities= $property_details->amenities_id;
            $amarray = explode(',',$aminities);
            $aminitiesData = DB::table('amenitie_masters')->whereIn('id',$amarray)->orderBy('id','desc')->get();
            
            $property_attachments = DB::table('property_attachments')->where('properti_id',$property_slug->id)->get();
        
            $propertyestype = DB::table('property_locations as pl')
                                ->select("pl.*"
                                ,DB::raw("6371 * acos(cos(radians(" . $latitude . "))
                                * cos(radians(pl.latitude))
                                * cos(radians(pl.longitude) - radians(" . $longitude . "))
                                + sin(radians(" .$latitude. "))
                                * sin(radians(pl.latitude))) AS distance"))
                                ->orderBy('created_at','Desc')
                                ->get();
            // dd($propertyestype);
            $username     =  DB::table('properties as p1')
                                ->select('p1.*','u.name','u.email','u.phone_number','u.id as usId')
                                ->join('users as u','u.id','=','p1.customer_id')
                                ->where('u.id',$property_slug->customer_id)
                                ->first();
            
            $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
            // dd($username);
            return view('front.details',compact('property_slug','property_details','property_attachments','aminitiesData','propertyestype','username','address'));
        }else{
            $propertyestype     = '';
            $username = '';
        }
        
        $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
        return view('front.details',compact('property_slug','propertyestype','username','address'));
       
    }

    public function faq()
    {
        // $faqsRent = FaqRent::where('status',1)->get();
        $faqs = Faq::where('status',1) ->where('faq_type', 1)->orderBy('id','desc')->get();
        $faqsrent = Faq::where('status',1) ->where('faq_type', 2)->orderBy('id','desc')->get();
        $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
        return view('front.faq',compact('faqs','faqsrent','address'));
    }

    public function howwework()
    {
        $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
        $whyChooses = DB::table('why_chooses')->where('status',1)->orderBy('id','desc')->get();
        $howwework = DB::table('how_we_works')->where('status',1)->orderBy('id','desc')->get();
        return view('front.howwework',compact('address','whyChooses','howwework'));
    }

    public function sell()
    {
        $categorye = Categorye::where('status',1)->get();
        $countries      = DB::table('countries')->get();
        $state          = DB::table('states')->where('country_id','101')->get();
        $aminities      = DB::table('amenitie_masters')->where('status',1)->get(); 
        // dd($aminities);
        $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
        return view('front.sell',compact('categorye','countries','state','aminities','address'));
    }

    public function myproperty(Request $request)
    {
        $userPropertys = DB::table('properties as p')
                        ->select('p.*','pl.address','pl.country_id','pl.city_id')
                        ->join('property_locations as pl','pl.properti_id','=','p.id')
                       
                        ->where('p.customer_id',Auth::user()->id)
                        ->where('p.status',1);
                       
        if($request->get('user_search')){
            $userPropertys->where('title','like','%'.$request->get('user_search').'%');
        }

        if($request->get('sort_by') != '' ){
            if($request->get('sort_by')=='lowest_price'){
                $userPropertys->orderBy('p.price','asc');
            }
            if($request->get('sort_by')=='highest_price'){
                $userPropertys->orderBy('p.price','desc');
            }
        }

        $userPropertys = $userPropertys->paginate(10);

        $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
        if($request->ajax())
            return view('front.myproperty_ajax',compact('userPropertys','address'));
        else
            return view('front.my_property',compact('userPropertys','address'));
    }

    public function myfavorites()
    {
        $wishlishts = DB::table('wishlishts as w')
                        ->select('p.*','pl.address','pl.country_id','pl.state_id','pl.city_id','pl.zip_code','pl.landmark','pd.bedrooms','pd.bathrooms','pd.size_in_ft')
                        ->join('properties as p','p.id','=','w.product_id')
                        ->join('property_locations as pl','pl.properti_id','=','p.id')
                        // ->join('countries as cr','cr.id','=','pl.country_id')
                        // ->join('cities as c','c.id','=','pl.city_id')
                        ->join('property_details as pd','pd.properti_id','=','p.id')
                        ->where('w.user_id',Auth::id())
                        ->paginate(4);
        // dd($wishlishts);
        return view('front.myfavorites',compact('wishlishts'));
    }

    public function savedsearch()
    {
        return view('front.savedsearch');
    }

    public function myprofile()
    {
        $users = DB::table('users')->where('id',Auth::id())->first();
        return view('front.myprofile',compact('users'));
    }

    public function profileUpdate(Request $request)
    {
        $id=Auth::user()->id;
    
        $this->validate($request, [
            'name'   => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:255',
            'last_name'     => 'nullable|regex:/^[a-zA-Z ]+$/u|min:1|max:255',
            'email'       => 'required',
            'address'       => 'required',
            'phone_number'        => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10',
        ]);

        $phone = preg_replace('/\D/', '', $request->input('phone_number'));

        if(strlen($phone)!=10)
        {
            return back()->withInput()->withErrors(['phone_number'=>['Phone Number Must be 10-digit Number !!']]);
        }

       
        DB::table('users')->where('id',$id)->update([
            'name'          => $request->input('name'),
            'last_name'     =>$request->input('last_name'),
            'email'         =>$request->input('email'),
            'phone_number'  =>$request->input('phone_number'),
            'address'       =>$request->input('address'),
            'description'   =>$request->input('description'),
            'updated_at'    => date('Y-m-d H:i:s')
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

   
    public function myaccount()
    {
        $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
        return view('front.myaccount',compact('address'));
    }

    public function profileChangepassword(Request $request)
    {
        $id=Auth::user()->id;
    
        $rules= [
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
          
        ];

        $validator = Validator::make($request->all(), $rules);
          
        if ($validator->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        if(!Hash::check($request->old_password, auth()->user()->password)){
            return response()->json([
                'success' =>false,
                'error_type'=>'reset-pass',
                'custom'  =>'yes',
                'errors'  =>[]
            ]);
        }
        
        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        Auth::logout();
        return response()->json([
            'success' =>true,
            'custom'  =>'yes',
            'errors'  =>[]
        ]);
        

    }

    public function citiesListing()
    {
        $propertCities = PropertieCities::where('status',1)->orderBy('id','desc')->paginate(6);
        $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
        return view('front.property_cities',compact('propertCities','address'));
    }

    public function blog()
    {
        $blogs = Blog::where('status',1)->orderBy('id','desc')->paginate(6);
        $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
        return view('front.blog',compact('blogs','address'));
    }

    public function blogDetails($slug)
    {
        $blogs_details = Blog::where('status',1)->where('slug',$slug)->first();
        // dd($blogs_details);
        $address      = DB::table('addresses')->where('status',1)->orderBy('id','desc')->get();
        return view('front.blog_details',compact('blogs_details','address'));
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

    public function propertyCreated(Request $request)
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
                 
                $rules=[
                    'title'             => 'required|regex:/^[a-zA-Z ]+$/u|min:1|max:255',
                    'category_id'       => 'required',
                    'listing_status'    => 'required',
                    'property_status'   => 'required',
                    // 'price'             => 'required|integer|min:1',
                    // 'yearly_tax_rate'   => 'required|integer|min:1|lt:price',
                    //'price_label'       => 'required',
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
                    'rooms'             => 'required|numeric',
                    'bedrooms'          => 'required|numeric',
                    'bathrooms'         => 'required|numeric',
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
                //  dd($totalprice);
                // $price = trim(preg_replace('/^\s+|\s+$|\s+(?=\s)/', '', $request->input('price').''.$request->input('yearly_tax_rate')));
                //add property step 1
                $step_1 = 
                    [
                        'customer_id'     => Auth::user()->id,
                        'title'           => $request->input('title'),
                        'is_rent_type'    => $request->input('rent_type'),
                        'slug'            => $slug,
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

                
                //Store the Step 2 Data
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
                         //$data = $file->move($filePath, $tmp_data);
                         
                         $img = Image::make($file);
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

                //location add step 3
                $location = 
                [
                    'properti_id'     => $propertyeId,
                    'address'         => $request->input('address'),
                    'latitude'         => $request->input('lat'),
                    'longitude'         => $request->input('lng'),
                    'country_id'      => $request->input('country'),
                    'city_id'         => $request->input('city'),
                    'state_id'        => $request->input('state'),
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
                    'agent_notes'       => $request->input('agent_notes'),
                    'energy_class'      => $request->input('energy_class'),
                    'energy_index'      => $request->input('energy_index'),
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


    public function propertyDelete(Request $request)
    {
        $property_id = $request->id;
    
        DB::beginTransaction();
        try{
            DB::table('properties')->where('id',$property_id)->delete();
            DB::table('property_attachments')->where('properti_id',$property_id)->delete();
            DB::table('property_details')->where('properti_id',$property_id)->delete();
            DB::table('property_details')->where('properti_id',$property_id)->delete();
            // $blog = Property::find($property_id);
            // $blog->delete() = '2';
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

    public function propertyEdit(Request $request)
    {
        $property_id = base64_decode($request->id);
        // dd($property_id);
        $propertie = DB::table('property_locations as p')
                    ->select('p.*')
                    ->where(['p.properti_id'=>$property_id])
                    ->first();

        $propertyes  = DB::table('properties')->where('id',$property_id)->first();
        $property_attachment = DB::table("property_attachments")->where('properti_id', $property_id)->get();
        $property_locations = DB::table("property_locations")->where('properti_id', $property_id)->first();
        $property_details = DB::table("property_details")->where('properti_id', $property_id)->first();


        $categorye      = Categorye::where('status',1)->get();
        $countries      = DB::table('countries')->get();
        $state          = DB::table('states')->where('country_id','101')->get();
        $citie         = DB::table('cities')->where('state_id',$propertie->state_id)->get();

        $aminities      = DB::table('amenitie_masters')->where('status',1)->get(); 
        // dd($aminities);
        return view('front.property_edit',compact('categorye','countries','state','citie','aminities','propertyes','property_attachment','property_locations','property_details','propertie'));
    }


    public function frontPropertyUpdate(Request $request)
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
                //dd($step);
                 
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
                $properties = 
                    [
                        'title'           => $request->input('title'),
                        'slug'            => $slug,
                        'customer_id'     => Auth::user()->id,
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
                         //$data = $file->move($filePath, $tmp_data);
                         
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

                   
                 }


                //location add step 3
                $location = 
                [
                    'properti_id'     => $propties_id,
                    'address'         => $request->input('address'),
                    'latitude'        => $request->input('lat'),
                    'longitude'       => $request->input('lng'),
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

    public function propertyRemoveImage(Request $request)
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


    public function categoryeFilter(Request $request)
    {
        $id = $request->id;
        //$categoryes = DB::table('properties')->where('category_id',$id)->get();
    
        $propertyesrecomend = DB::table('properties as p')
                        ->select('p.*','pl.address','pl.country_id','pl.state_id','pl.city_id','pd.bedrooms','pd.bathrooms','pd.size_in_ft')
                        ->join('property_locations as pl','pl.properti_id','=','p.id')
                        ->join('property_details as pd','pd.properti_id','=','p.id')
                        ->where('p.category_id',$id)
                        ->orderBy('p.id','desc')
                        ->get(); 
                        // dd($propertyesrecomend);   
        
        return view('front.categoryes_filter',compact('propertyesrecomend'));

        // return response()->json(
        //     array(
        //       'success' => true, 
        //       'result' => '',
        //       'html'=>$viewRender
        //     ));
    }

    public function advertismentList()
    {
        $addLists = DB::table('advertisements as ad')
                    ->select('ad.*','p.package_name')
                    ->join('packages as p','p.id','=','ad.package_id')
                    ->where('p.status',1)
                    ->orderBy('p.created_at','desc')
                    ->paginate(5);
                    
        return view('front.advertismentlist',compact('addLists'));
    }

    public function addAddvertisement(Request $request)
    {
        return view('front.advertismentcreate');
    }

   
     public function saveAddvertisement(Request $request)
    {

        $rules = [
            'url' => 'required',
            'image' => 'required|image',
            'package_id' => 'required',
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
        try {
                $userId = Auth::user()->id;
                $userPackage = DB::table('payments')
                                ->where('user_id', $userId)
                                ->orderBy('created_at', 'desc')
                                ->first();

                if (!$userPackage) {
                    return response()->json([
                        'success2' => false,
                        // 'message' => "You don't have an active package. Please purchase a package to post."
                    ]);
                }

                $packageId = $userPackage->package_id;
                $packageType = $userPackage->package_name;
                // $start_date = $userPackage->start_date;
                // $end_date = $userPackage->end_date;
                $allowedFreePosts = 0;

                // Define package limits for free posts
                $packageLimits = [
                    'Basic' => 5,
                    'Silver' => 10,
                    'Gold' => 20,
                    'Diamond' => -1,
                ];

                if (array_key_exists($packageType, $packageLimits)) {
                    $allowedFreePosts = $packageLimits[$packageType];
                }

                // Calculate the number of posts made by the user within the last month
                $oneMonthAgo = date('Y-m-d H:i:s', strtotime('-30 days'));
                $userPostsCount = DB::table('advertisements')
                                    ->where('user_id', $userId)
                                    ->where('created_at', '>=', $oneMonthAgo)
                                    ->count();

                // Check if the user has exceeded the allowed free posts
                if ($allowedFreePosts != -1 && $userPostsCount >= $allowedFreePosts) {
                    // Show a message indicating the user has reached the free post limit for this package
                    return response()->json([
                        'success3' => false,
                        'message' => "You have reached your free post limit for this month."
                    ]);
                }

                if($request->file('image'))
                {
                    $image = $request->file('image');
                    $date = date('YmdHis');
                    $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
                    $random_no = substr($no, 0, 2);
                    $final_image_name = $date.$random_no.'.'.$image->getClientOriginalExtension();
        
                    $destination_path = public_path('/uploads/package/');
                    if(!File::exists($destination_path))
                    {
                        File::makeDirectory($destination_path, $mode = 0777, true, true);
                    }
                    $image->move($destination_path , $final_image_name);
    
                }

            $data = [
                'user_id'    => Auth::user()->id,
                'package_id' => $request->input('package_id'),
                'url'        => $request->input('url'),
                'image'      => !empty($final_image_name) ? $final_image_name : null,
                'description' => $request->input('description'),
                'status'      => 1,
                'created_at'  => now(),
            ];

            $u_id = DB::table('advertisements')->insertGetId($data);

            DB::commit();

            return response()->json([
                'success' => true,
                'u_id' => $u_id,
            ]);

        } catch (\Exception $e) {
                DB::rollback();
                
                return $e;
            }
    }

    // public function create(Request $request)
    // {

    //         $rules = [
    //             'url' => 'required',
    //             'description' => 'required',
    //             'package' => 'required',
    //             'image' => 'required|image',
    //         ];

    //         $validation = Validator::make($request->all(), $rules);

    //         if ($validation->fails()) {
    //             return response()->json([
    //                 'success' => false,
    //                 'errors' => $validation->errors()
    //             ]);
    //         }
    //         DB::beginTransaction();
    //         try {
    //                 $userId = Auth::user()->id;
    //                 $userPackage = DB::table('payments')
    //                     ->where('user_id', $userId)
    //                     ->orderBy('created_at', 'desc')
    //                     ->first();

    //                 if (!$userPackage) {
    //                     return response()->json([
    //                         'success2' => false,
    //                         // 'message' => "You don't hav6e an active package. Please purchase a package to post."
    //                     ]);
    //                 }

                
    //                 $packageId = $userPackage->package_id;
    //                 $packageType = $userPackage->package_name;
    //                 $allowedFreePosts = 0;

    //                 // Define package limits for free posts
    //                 $packageLimits = [
    //                     'Basic' => 5,
    //                     'Silver' => 10,
    //                     'Gold' => 20,
    //                     'Diamond' => -1,
    //                     // '1' => 5,
    //                     // '2' => 10,
    //                     // '3' => 20,
    //                     // '4' => -1, // Unlimited free posts for diamond package
    //                 ];

    //                 if (array_key_exists($packageType, $packageLimits)) {
    //                     $allowedFreePosts = $packageLimits[$packageType];
    //                 }

    //                 // Calculate the number of posts made by the user within the last month
    //                 $oneMonthAgo = date('Y-m-d H:i:s', strtotime('-30 days'));
    //                 $userPostsCount = DB::table('user_advertisements')
    //                     ->where('user_id', $userId)
    //                     ->where('created_at', '>=', $oneMonthAgo)
    //                     ->count();

    //                     // dd($allowedFreePosts);

    //                       // Check if the user has exceeded the allowed free posts
    //                 if ($allowedFreePosts != -1 && $userPostsCount >= $allowedFreePosts) {
    //                     // Show a message indicating the user has reached the free post limit for this package
    //                     return response()->json([
    //                         'success3' => false,
    //                         'message' => "You have reached your free post limit for this month."
    //                     ]);
    //                 }
    //             if ($request->file('image')) {
    //                 // Process and save the image
    //                 $avatar = $request->file('image');
    //                 $date = now()->format('YmdHis');
    //                 $no = str_shuffle('123456789023456789034567890456789905678906789078908909000987654321987654321876543217654321654321543214321321211');
    //                 $random_no = substr($no, 0, 2);
    //                 $final_image_name = $date . $random_no . '.' . $avatar->getClientOriginalExtension();

    //                 $destination_path = public_path('/uploads/package/');
    //                 if (!File::exists($destination_path)) {
    //                     File::makeDirectory($destination_path, $mode = 0777, true, true);
    //                 }
    //                 $img = Image::make($avatar->getRealPath());
    //                 $img->resize('500', '500', function ($constraint) {
    //                 })->save($destination_path . $final_image_name);
    //             }

    //             $data = [
    //                 'user_id' => Auth::user()->id,
    //                 'package_id' => $request->input('package'),
    //                 'image' => !empty($final_image_name) ? $final_image_name : null,
    //                 'url' => $request->input('url'),
    //                 'description' => $request->input('description'),
    //                 'created_at' => now(),
    //             ];

    //             $u_id = DB::table('user_advertisements')->insertGetId($data);

    //             DB::commit();

    //             return response()->json([
    //                 'success' => true,
    //                 'u_id' => $u_id,
    //             ]);
    //         } catch (\Exception $e) {
    //             DB::rollback();

    //             return response()->json([
    //                 'success' => false,
    //                 'error' => $e->getMessage()
    //             ]);
    //         }
    // }
}
