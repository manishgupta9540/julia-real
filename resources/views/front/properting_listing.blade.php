@extends('front.master.index')
@section('title','Property Listing')
@section('content')
<section class="pb90 pb30-md pt-0" style="padding-top: 100px!important">
    <div class="container">
        <br><br>
        <div class="row wow fadeInUp" data-wow-delay="00ms">
            <div class="col-lg-9">
                <div class="main-title2">
                    <h2 class="title">Suggested for you</h2>
                </div>
            </div>
    
            <div class="col-lg-3">
                {{-- <div class="dark-light-navtab style2 text-start text-lg-end mt-0 mt-lg-4 mb-4">
                    <ul class="nav nav-pills justify-content-start justify-content-lg-end" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active"  id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">For Rent</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link me-0" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">For Sale</button>
                        </li>
                    </ul>
                </div> --}}
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 wow fadeInUp" data-wow-delay="300ms">
                <div class="tab-content" id="pills-tabContent">

                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="row">
                            @if(count($propertyes)>0)
                                @foreach ($propertyes as $property)
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <?php
                                                $property_locations = DB::table('property_locations')->where('properti_id',$property->id)->first();
                                                $property_details = DB::table('property_details')->where('properti_id',$property->id)->first();
                                                $property_attachments = DB::table('property_attachments')->where('properti_id',$property->id)->first();
                                                
                                            ?>
                                        <div class="listing-style5">
                                            <div class="list-thumb">
                                                <a href="{{url('details/'.base64_encode($property->id))}}">
                                                    <img src="{{ asset('uploads/property/'.$property_attachments->attachment) }}" alt="" style="width: 100%; height: 290px;">
                                                </a>
                                                @if($property->is_featured == 1)
                                                    <div class="list-tag fz12"><span class="flaticon-electricity me-2"></span>FEATURED</div>
                                                @endif

                                                <div class="list-meta2">
                                        
                                                </div>
                                            </div>
                                            
                                            <div class="list-content">
                                                <?php
                                                    $pricevalue  = $property->price;
                                                    $newprice = (int)$pricevalue;
                                                ?>
                                                <div class="d-flex justify-content-between list-price mb-2"><div>SRD {{$newprice}} </div>
                                                
                                                @php
                                                    $wish = DB::table('wishlishts')
                                                            ->where('product_id', $property->id)
                                                            ->where('user_id', Auth::id())
                                                            ->get();
                                                @endphp

                                                @if ($wish->isNotEmpty())
                                                    <div class="like-icons rounded-circle">
                                                        <a href="javascript:void(0)" data-id="{{$property->id}}" class="addTowishlisht">
                                                            <i class="fa-solid fa-heart" style="color:red"></i></a>
                                                        </div>
                                                    </div>
                                                @else
                                                    @if (Auth::check())
                                                        <div class="like-icons rounded-circle">
                                                            <a href="javascript:void(0)" data-id="{{$property->id}}" class="addTowishlisht">
                                                                <i class="fa-solid fa-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="like-icons rounded-circle">
                                                            <a href="javascript:void(0)" data-id="{{$property->id}}" data-bs-toggle="modal" data-bs-target="#login" class="addTowishlisht">
                                                                <i class="fa-solid fa-heart"></i></a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                                <h6 class="list-title"><a href="{{url('details/'.base64_encode($property->id))}}">{{$property->title}}</a>
                                                </h6>
                                                <p class="list-text">{{$property_locations->address ?? ''}}</p>
                                                <div class="list-meta d-flex align-items-center">
                                                    <a href="#"><span class="flaticon-bed"></span>{{$property_details->bedrooms}}</a>
                                                    <a href="#"><span class="flaticon-shower"></span>{{$property_details->bathrooms}}</a>
                                                    <a href="#"><span class="flaticon-expand"></span>{{$property_details->size_in_ft}}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="row">
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('front.master.include.footer')
@endsection