@extends('front.master.index')
@section('title','Property details')
@section('content')

@include('front.master.include.common_sidebar')
<style>
   #map{
        width: 100%;
        height: 300px;
    }
</style>
<div class="body_content">
    <!-- Property All Lists -->
    <section class="pt140 bgc-f7 property-section">
      @if(!empty($property_slug))

        <div class="container">
          <div class="row wow fadeInUp" data-wow-delay="100ms">
            <div class="col-lg-8">
              <div class="single-property-content mb30-md">
                <h2 class="sp-lg-title">{{$property_slug->title ?? ''}}</h2>
                <div class="pd-meta mb15 d-md-flex align-items-center">
                  <p class="text fz15 mb-0 bdrr1 pr10 bdrrn-sm">{{$property_slug->address ?? ''}}</p>
                  
                  @if ($property_slug->is_rent_type == 1)
                   
                    <a class="ff-heading text-thm fz15 bdrr1 pr10 ml0-sm ml10 bdrrn-sm" href="#">
                      <i class="fas fa-circle fz10 pe-2"></i>For sale
                    </a>
                  @endif

                  @if($property_slug->is_rent_type == 2)
           
                    <a class="ff-heading text-thm fz15 bdrr1 pr10 ml0-sm ml10 bdrrn-sm" href="#">
                      <i class="fas fa-circle fz10 pe-2"></i>For Rent
                    </a>
                  @endif
                
                  <a class="ff-heading bdrr1 fz15 pr10 ml10 ml0-sm bdrrn-sm" href="#"><i class="far fa-clock pe-2"></i>1 years ago</a>
                  <a class="ff-heading ml10 ml0-sm fz15" href="#"><i class="flaticon-fullscreen pe-2 align-text-top"></i>8721</a>
                </div>
                <div class="property-meta d-flex align-items-center">
                  <a class="text fz15" href="#"><i class="flaticon-bed pe-2 align-text-top"></i>{{$property_details->bedrooms ?? ''}}</a>
                  <a class="text ml20 fz15" href="#"><i class="flaticon-shower pe-2 align-text-top"></i>{{$property_details->bathrooms ?? ''}}</a>
                  <a class="text ml20 fz15" href="#"><i class="flaticon-expand pe-2 align-text-top"></i>{{$property_details->size_in_ft ?? ''}}</a>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="single-property-content">
                <div class="property-action text-lg-end">
                  <div class="d-flex mb20 mb10-md align-items-center justify-content-lg-end">
                    @php
                      $wish = DB::table('wishlishts')
                            ->where('product_id', $property_slug->id)
                            ->where('user_id', Auth::id())
                            ->get();
                    @endphp

                    @if ($wish->isNotEmpty())
                    <a href="javascript:void(0)" data-id="{{$property_slug->id}}" class="icon mr10 addTowishlisht like-icone rounded-circle">
                      <i class="fa-solid fa-heart" style="color:red"></i>
                    </a>
                    @else
                      @if(Auth::check())
                        <a href="javascript:void(0)" data-id="{{$property_slug->id}}" class="icon mr10 addTowishlisht like-icone rounded-circle">
                          <i class="fa-solid fa-heart"></i>
                        </a>
                      @else
                        <a href="javascript:void(0)" data-id="{{$property_slug->id}}" data-bs-toggle="modal" data-bs-target="#login"  class="icon mr10 addTowishlisht like-icone rounded-circle">
                          <i class="fa-solid fa-heart"></i>
                        </a>
                      @endif
                    @endif

                    @if(Auth::check())
                        <a class="icon mr10" href="{{url('chatify/'.$username->usId)}}"><span class="fas fa-comment"></span></a>
                    @else
                        <a class="icon mr10" href="{{url('chatify')}}" data-bs-toggle="modal" data-bs-target="#login"><span class="fas fa-comment"></span></a>
                    @endif
                  </div>
                  <?php  
                     $pricevalue  = $property_slug->price;
                      $newprice = (int)$pricevalue;
                  ?>
                  <h3 class="price mb-0">SRD {{$newprice}}</h3>
                  <p class="text space fz15">SRD {{$property_details->lot_size_in_ft}}/sq ft</p>
                </div>
              </div>
            </div>
          </div>

          <div class="row mb30 mt30 wow fadeInUp" data-wow-delay="300ms">

            @foreach ($property_attachments as $key => $attachments)
              @if ($key==0)
                <div class="col-sm-6">
                  <div class="sp-img-content mb15-md">
                    <a class="popup-img preview-img-1 sp-img" href="{{ asset('uploads/property/'.$attachments->attachment) }}">
                      <img class="w-100" src="{{ asset('uploads/property/'.$attachments->attachment) }}" alt="1.jpg">
                    </a>
                  </div>
                </div>
              @endif
            @endforeach

            <div class="col-sm-6">
              <div class="row">
                @php 
                  $im_count = count($property_attachments);
                @endphp
                @foreach ($property_attachments as $key => $attachments)
                @if($im_count >= 5)
                  @if ($key>=1)
                    <div class="col-6 ps-sm-0">
                      <div class="sp-img-content">
                        <a class="popup-img preview-img-2 sp-img mb10" href="{{ asset('uploads/property/'.$attachments->attachment) }}">
                          <img class="w-100" src="{{ asset('uploads/property/'.$attachments->attachment) }}" alt="2.jpg">
                        </a>
                        @if ($key == 4)
                          <a href="images/listings/listing-single-5.jpg" class="all-tag popup-img">See All {{$im_count}} Photos</a>
                        @endif
                      </div>
                    </div>
                  @endif
                  @else
                    @if ($key>=1)
                      <div class="col-6 ps-sm-0">
                        <div class="sp-img-content">
                          <a class="popup-img preview-img-2 sp-img mb10" href="{{ asset('uploads/property/'.$attachments->attachment) }}">
                            <img class="w-100" src="{{ asset('uploads/property/'.$attachments->attachment) }}" alt="2.jpg">
                          </a>
                        </div>
                      </div>
                    @endif
                  @endif
                  @endforeach
              </div>
            </div>
            
          </div>

          <div class="row wrap wow fadeInUp" data-wow-delay="500ms">
            <div class="col-lg-8">
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 julia-div mb30 overflow-hidden position-relative">
                <div><h4 class="title fz17 mb30">Overview</h4></div>
                <div class="row jusliasrows">
                  <div class="col-sm-6 col-lg-4">
                    <div class="overview-element mb25 d-flex align-items-center">
                      <span class="icon flaticon-bed"></span>
                      <div class="ml15">
                        <h6 class="mb-0">Bedroom</h6>
                        <p class="text mb-0 fz15">{{$property_details->bedrooms}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-4">
                    <div class="overview-element mb25 d-flex align-items-center">
                      <span class="icon flaticon-shower"></span>
                      <div class="ml15">
                        <h6 class="mb-0">Bath</h6>
                        <p class="text mb-0 fz15">{{$property_details->bathrooms}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-4">
                    <div class="overview-element mb25 d-flex align-items-center">
                      <span class="icon flaticon-event"></span>
                      <div class="ml15">
                        <h6 class="mb-0">Year Built</h6>
                        <p class="text mb-0 fz15">{{$property_details->year_built}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-4">
                    <div class="overview-element mb25-xs d-flex align-items-center">
                      <span class="icon flaticon-garage"></span>
                      <div class="ml15">
                        <h6 class="mb-0">Garage</h6>
                        <p class="text mb-0 fz15">{{$property_details->garages}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-4">
                    <div class="overview-element mb25-xs d-flex align-items-center">
                      <span class="icon flaticon-expand"></span>
                      <div class="ml15">
                        <h6 class="mb-0">Sqft</h6>
                        <p class="text mb-0 fz15">{{$property_details->size_in_ft}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6 col-lg-4">
                    <div class="overview-element d-flex align-items-center">
                      <span class="icon flaticon-home-1"></span>
                      <div class="ml15">
                        <h6 class="mb-0">Property Type</h6>
                        <p class="text mb-0 fz15">{{$property_slug->name ?? ''}}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <h4 class="title fz17 mb30">Property Description</h4>
                <p class="text mb10">{!!$property_slug->discription!!}</p>
                    <div class="agent-single-accordion">
                  <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                        <div class="accordion-body p-0"><p class="text">Placeholder content for this accordion, which is intended to demonstrate the class. This is the first item's accordion body you get groundbreaking performance and amazing battery life. Add to that a stunning Liquid Retina XDR display, the best camera and audio ever in a Mac notebook, and all the ports you need.</p></div>
                      </div>
                      <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button p-0 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">Show more</button>
                      </h2>
                    </div>
                  </div>
                </div>
                <h4 class="title fz17 mb30 mt50">Property Details</h4>
                <div class="row">
                  <div class="col-md-6 col-xl-4">
                    <div class="d-flex justify-content-between">
                      <div class="pd-list">
                        <p class="fw600 mb10 ff-heading dark-color">Property ID</p>
                        <p class="fw600 mb10 ff-heading dark-color">Inclusive Price</p>
                        <p class="fw600 mb10 ff-heading dark-color">Property Size</p>
                        <p class="fw600 mb10 ff-heading dark-color">Bathrooms</p>
                        <p class="fw600 mb-0 ff-heading dark-color">Bedrooms</p>
                      </div>
                      <div class="pd-list">
                        <?php  
                          $priceva  = $property_slug->price;
                          $pricevalue = (int)$priceva;
                        ?>
                        <p class="text mb10">{{$property_details->custom_id}}</p>
                        <p class="text mb10">SRD {{$pricevalue}}</p>
                        <p class="text mb10">{{$property_details->garage_size}} Sq Ft</p>
                        <p class="text mb10">{{$property_details->bathrooms}}</p>
                        <p class="text mb-0">{{$property_details->bedrooms}}</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-xl-4 offset-xl-2">
                    <div class="d-flex justify-content-between">
                      <div class="pd-list">
                        <p class="fw600 mb10 ff-heading dark-color">Garage</p>
                        <p class="fw600 mb10 ff-heading dark-color">Garage Size</p>
                        <p class="fw600 mb10 ff-heading dark-color">Year Built</p>
                        <p class="fw600 mb10 ff-heading dark-color">Property Type</p>
                        <p class="fw600 mb-0 ff-heading dark-color">Property Status</p>
                      </div>
                      <div class="pd-list">
                        <p class="text mb10">{{$property_details->garages}}</p>
                        <p class="text mb10">{{$property_details->garage_size}}SqFt</p>
                        <p class="text mb10">{{$property_details->year_built}}</p>
                        <p class="text mb10">{{$property_slug->name ?? ''}}</p>
                        <p class="text mb-0">{{$property_slug->property_status}}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <h4 class="title fz17 mb30 mt30">Address</h4>
                <div class="row">
                  <div class="col-md-7 col-xl-7 px-4">
                    <div class="d-flex justify-content-between">
                      <!-- <div class="pd-list">
                        <p class="fw600 mb10 ff-heading dark-color">Address</p>
                        <p class="fw600 mb10 ff-heading dark-color">City</p>
                        <p class="fw600 mb-0 ff-heading dark-color">State</p>
                      </div> -->
                      <div class="pd-list">
                        <input type="hidden" id="lat" value="{{ $property_slug->latitude }}">
                        <input type="hidden" id="lag" value="{{ $property_slug->longitude }}">
                        <p class="text mb10"><span><strong>Address</strong></span> <span style="margin-left: 12px;">{{$property_slug->address}}</span></p>
                        <p class="text mb10"><span><strong>City</strong></span><span style="margin-left: 12px;">{{$property_slug->city_id ?? ''}}</span></p>
                        <p class="text mb-0"><span><strong>State</strong></span><span style="margin-left: 12px;">{{$property_slug->state_id ?? ''}}</span></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5 col-xl-5">
                    <div class="d-flex justify-content-between">
                      <!-- <div class="pd-list">
                        <p class="fw600 mb10 ff-heading dark-color">Zip/Postal Code</p>
                        <p class="fw600 mb10 ff-heading dark-color">Area</p>
                        <p class="fw600 mb-0 ff-heading dark-color">Country</p>
                      </div> -->
                      <div class="pd-list">
                        <p class="text mb10"><span><strong>Zip/Postal Code</strong></span><span style="margin-left: 12px;">{{$property_slug->zip_code}}</span></p>
                        <p class="text mb10"><span><strong>Area</strong></span><span style="margin-left: 12px;">{{$property_slug->landmark}}</span></p>
                        <p class="text mb-0"><span><strong>Country</strong></span><span style="margin-left: 12px;">{{$property_slug->country_id ?? ''}}</span></p>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <div class="col-lg-12 pt-4">
                  <div id="map"></div>
                </div>
              </div>
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <h4 class="title fz17 mb30">Features & Amenities</h4>
                <div class="row">
                  @foreach ($aminitiesData as $data)
                  <div class="col-sm-6 col-md-4">
                    <div class="pd-list mb10-sm">
                      <p class="text mb10"><i class="fas fa-circle fz6 align-middle pe-2"></i>{{$data->amenities_name ?? ''}}</p>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <h4 class="title fz17 mb30">Floor Plans</h4>
                <div class="row">
                  <div class="col-md-12">
                    <div class="accordion-style1 style2">
                      <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingFirst">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFirst" aria-expanded="true" aria-controls="collapseFirst">
                              <span class="w-100 d-md-flex align-items-center">
                                <span class="mr10-sm">First Floor</span>
                                <span class="ms-auto d-md-flex align-items-center justify-content-end">
                                  <span class="me-2 me-md-4">
                                    <span class="fw600">Size:</span>
                                    <span class="text">1267 Sqft</span>
                                  </span>
                                  <span class="me-2 me-md-4">
                                    <span class="fw600">Bedrooms</span>
                                    <span class="text">2</span>
                                  </span>
                                  <span class="me-2 me-md-4">
                                    <span class="fw600">Bathrooms</span>
                                    <span class="text">2</span>
                                  </span>
                                  <span>
                                    <span class="fw600">Price</span>
                                    <span class="text">SRD 920,99</span>
                                  </span>
                                </span>
                              </span>
                            </button>
                          </h2>
                          <div id="collapseFirst" class="accordion-collapse collapse" aria-labelledby="headingFirst" data-parent="#accordionExample">
                            <div class="accordion-body text-center"><img class="w-100" src="{{asset('front/images/listings/listing-single-1.png')}}" alt=""></div>
                          </div>
                        </div>
                        <div class="accordion-item active">
                          <h2 class="accordion-header" id="headingSecond">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSecond" aria-expanded="false" aria-controls="collapseSecond">
                              <span class="w-100 d-md-flex align-items-center">
                                <span class="mr10-sm">Second Floor</span>
                                <span class="ms-auto d-md-flex align-items-center justify-content-end">
                                  <span class="me-2 me-md-4">
                                    <span class="fw600">Size:</span>
                                    <span class="text">1267 Sqft</span>
                                  </span>
                                  <span class="me-2 me-md-4">
                                    <span class="fw600">Bedrooms</span>
                                    <span class="text">2</span>
                                  </span>
                                  <span class="me-2 me-md-4">
                                    <span class="fw600">Bathrooms</span>
                                    <span class="text">2</span>
                                  </span>
                                  <span>
                                    <span class="fw600">Price</span>
                                    <span class="text"> SRD 920,99</span>
                                  </span>
                                </span>
                              </span>
                            </button>
                          </h2>
                          <div id="collapseSecond" class="accordion-collapse collapse show" aria-labelledby="headingSecond" data-parent="#accordionExample">
                            <div class="accordion-body text-center"><img class="w-100" src="{{asset('front/images/listings/listing-single-1.png')}}" alt=""></div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingThird">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThird" aria-expanded="false" aria-controls="collapseThird">
                              <span class="w-100 d-md-flex align-items-center">
                                <span class="mr10-sm">Third Floor</span>
                                <span class="ms-auto d-md-flex align-items-center justify-content-end">
                                  <span class="me-4">
                                    <span class="fw600">Size:</span>
                                    <span class="text">1267 Sqft</span>
                                  </span>
                                  <span class="me-4">
                                    <span class="fw600">Bedrooms</span>
                                    <span class="text">2</span>
                                  </span>
                                  <span class="me-4">
                                    <span class="fw600">Bathrooms</span>
                                    <span class="text">2</span>
                                  </span>
                                  <span>
                                    <span class="fw600">Price</span>
                                    <span class="text">SRD 920,99</span>
                                  </span>
                                </span>
                              </span>
                            </button>
                          </h2>
                          <div id="collapseThird" class="accordion-collapse collapse" aria-labelledby="headingThird" data-parent="#accordionExample">
                            <div class="accordion-body text-center"><img class="w-100" src="{{asset('front/images/listings/listing-single-1.png')}}" alt=""></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <h4 class="title fz17 mb30">Video</h4>
                <div class="row">
                  <div class="col-md-12">
                    <div class="property_video bdrs12 w-100">
                      <a class="video_popup_btn mx-auto popup-img popup-youtube" href="https://www.youtube.com/watch?v=oqNZOOWF8qM"><span class="flaticon-play"></span></a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <h4 class="title fz17 mb30">360° Virtual Tour</h4>
                <div class="row">
                  <div class="col-md-12">
                    <img src="{{asset('front/images/listings/listing-single-7.jpg')}}" alt="" class="w-100 bdrs12">
                  </div>
                </div>
              </div>
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <h4 class="title fz17 mb30">What's Nearby?</h4>
                <div class="row">
                  <div class="col-md-12">
                    <div class="navtab-style1">
                      <nav>
                        <div class="nav nav-tabs mb20" id="nav-tab2" role="tablist">
                          <button class="nav-link fw600 active" id="nav-item1-tab" data-bs-toggle="tab" data-bs-target="#nav-item1" type="button" role="tab" aria-controls="nav-item1" aria-selected="true">Education</button>
                          <button class="nav-link fw600" id="nav-item2-tab" data-bs-toggle="tab" data-bs-target="#nav-item2" type="button" role="tab" aria-controls="nav-item2" aria-selected="false">Health & Medical</button>
                          <button class="nav-link fw600" id="nav-item3-tab" data-bs-toggle="tab" data-bs-target="#nav-item3" type="button" role="tab" aria-controls="nav-item3" aria-selected="false">Transportation</button>
                        </div>
                      </nav>
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade fz15 active show" id="nav-item1" role="tabpanel" aria-labelledby="nav-item1-tab">
                          <div class="nearby d-sm-flex align-items-center mb20">
                            <div class="rating dark-color mr15 ms-1 mt10-xs mb10-xs"><span class="fw600 fz14">4</span><span class="text fz14">/10</span></div>
                            <div class="details">
                              <p class="dark-color fw600 mb-0">South Londonderry Elementary School</p>
                              <p class="text mb-0">Grades: PK-6   Distance: 3.7 mi</p>
                              <div class="blog-single-review">
                                <ul class="mb0 ps-0">
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                          <div class="nearby d-sm-flex align-items-center mb20">
                            <div class="rating dark-color mr15 ms-1 mt10-xs mb10-xs"><span class="fw600 fz14">5</span><span class="text fz14">/10</span></div>
                            <div class="details">
                              <p class="dark-color fw600 mb-0">Londonderry Senior High School</p>
                              <p class="text mb-0">Grades: PK-6   Distance: 3.7 mi</p>
                              <div class="blog-single-review">
                                <ul class="mb0 ps-0">
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                          <div class="nearby d-sm-flex align-items-center">
                            <div class="rating style2 dark-color mr15 ms-1 mt10-xs mb10-xs"><span class="fw600 fz14">5</span><span class="text fz14">/10</span></div>
                            <div class="details">
                              <p class="dark-color fw600 mb-0">Londonderry Middle School</p>
                              <p class="text mb-0">Grades: PK-6   Distance: 3.7 mi</p>
                              <div class="blog-single-review">
                                <ul class="mb0 ps-0">
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade fz15" id="nav-item2" role="tabpanel" aria-labelledby="nav-item2-tab">
                          <div class="nearby d-sm-flex align-items-center mb20">
                            <div class="rating dark-color mr15 ms-1 mt10-xs mb10-xs"><span class="fw600 fz14">4</span><span class="text fz14">/10</span></div>
                            <div class="details">
                              <p class="dark-color fw600 mb-0">South Londonderry Elementary School</p>
                              <p class="text mb-0">Grades: PK-6   Distance: 3.7 mi</p>
                              <div class="blog-single-review">
                                <ul class="mb0 ps-0">
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                          <div class="nearby d-sm-flex align-items-center mb20">
                            <div class="rating dark-color mr15 ms-1 mt10-xs mb10-xs"><span class="fw600 fz14">5</span><span class="text fz14">/10</span></div>
                            <div class="details">
                              <p class="dark-color fw600 mb-0">Londonderry Senior High School</p>
                              <p class="text mb-0">Grades: PK-6   Distance: 3.7 mi</p>
                              <div class="blog-single-review">
                                <ul class="mb0 ps-0">
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                          <div class="nearby d-sm-flex align-items-center">
                            <div class="rating style2 dark-color mr15 ms-1 mt10-xs mb10-xs"><span class="fw600 fz14">5</span><span class="text fz14">/10</span></div>
                            <div class="details">
                              <p class="dark-color fw600 mb-0">Londonderry Middle School</p>
                              <p class="text mb-0">Grades: PK-6   Distance: 3.7 mi</p>
                              <div class="blog-single-review">
                                <ul class="mb0 ps-0">
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane fade fz15" id="nav-item3" role="tabpanel" aria-labelledby="nav-item3-tab">
                          <div class="nearby d-sm-flex align-items-center mb20">
                            <div class="rating dark-color mr15 ms-1 mt10-xs mb10-xs"><span class="fw600 fz14">4</span><span class="text fz14">/10</span></div>
                            <div class="details">
                              <p class="dark-color fw600 mb-0">South Londonderry Elementary School</p>
                              <p class="text mb-0">Grades: PK-6   Distance: 3.7 mi</p>
                              <div class="blog-single-review">
                                <ul class="mb0 ps-0">
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                          <div class="nearby d-sm-flex align-items-center mb20">
                            <div class="rating dark-color mr15 ms-1 mt10-xs mb10-xs"><span class="fw600 fz14">5</span><span class="text fz14">/10</span></div>
                            <div class="details">
                              <p class="dark-color fw600 mb-0">Londonderry Senior High School</p>
                              <p class="text mb-0">Grades: PK-6   Distance: 3.7 mi</p>
                              <div class="blog-single-review">
                                <ul class="mb0 ps-0">
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                          <div class="nearby d-sm-flex align-items-center">
                            <div class="rating style2 dark-color mr15 ms-1 mt10-xs mb10-xs"><span class="fw600 fz14">5</span><span class="text fz14">/10</span></div>
                            <div class="details">
                              <p class="dark-color fw600 mb-0">Londonderry Middle School</p>
                              <p class="text mb-0">Grades: PK-6   Distance: 3.7 mi</p>
                              <div class="blog-single-review">
                                <ul class="mb0 ps-0">
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                  <li class="list-inline-item me-0"><a href="#"><i class="fas fa-star review-color2 fz10"></i></a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <h4 class="title fz17 mb30">Walkscore</h4>
                <div class="row">
                  <div class="col-md-12">
                    <h4 class="fw400 mb20">10425 Tabor St Los Angeles CA 90034 USA</h4>
                    <div class="walkscore d-sm-flex align-items-center mb20">
                      <span class="icon mr15 mb10-sm flaticon-walking"></span>
                      <div class="details">
                        <p class="dark-color fw600 mb-2">Walk Score</p>
                        <p class="text mb-0">57 / 100  (Somewhat Walkable)</p>
                      </div>
                    </div>
                    <div class="walkscore d-sm-flex align-items-center mb20">
                      <span class="icon mr15 mb10-sm flaticon-bus"></span>
                      <div class="details">
                        <p class="dark-color fw600 mb-2">Transit Score</p>
                        <p class="text mb-0">27 / 100  (Some Transit)</p>
                      </div>
                    </div>
                    <div class="walkscore d-sm-flex align-items-center">
                      <span class="icon mr15 mb10-sm flaticon-bike"></span>
                      <div class="details">
                        <p class="dark-color fw600 mb-2">Walk Score</p>
                        <p class="text mb-0">45 / 100  (Somewhat Bikeable)</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              {{-- <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <h4 class="title fz17 mb30">Mortgage Calculator</h4>
                <div class="row">
                  <div class="col-md-12">
                    <div class="d-flex align-items-center flex-wrap calculator-chart-percent">
                      <div class="principal-interest-st"></div>
                      <div class="property-tax-st"></div>
                      <div class="home-insurance-st"></div>
                    </div>
                    <ul class="list-result-calculator d-md-flex flex-wrap justify-content-between bdrb1 mt20 ps-0 pb15 mb-0">
                      <li class="d-sm-flex align-items-center">
                        <span class="name-result text">Principal and Interest</span>
                        <span class="principal-interest-val fw600">$2,412</span>
                      </li>
                      <li class="d-sm-flex align-items-center">
                        <span class="name-result text">Property Taxes</span>
                        <span class="property-tax-val fw600">$2,412</span>
                      </li>
                      <li class="d-sm-flex align-items-center"> 
                        <span class="name-result text">Homeowners' Insurance</span>
                        <span class="home-insurance-val fw600">$2,412</span>
                      </li>
                    </ul>
                    <form class="comments_form mt30">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="mb-4">
                            <label class="fw600 ff-heading mb-2">Total Amount</label>
                            <input type="text" class="form-control" placeholder="$ 250">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-4">
                            <label class="fw600 ff-heading mb-2">Down Payment</label>
                            <input type="text" class="form-control" placeholder="$2304">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-4">
                            <label class="fw600 ff-heading mb-2">Interest Rate</label>
                            <input type="text" class="form-control" placeholder="%3.5">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-4">
                            <label class="fw600 ff-heading mb-2">Loan Terms (Years)</label>
                            <input type="text" class="form-control" placeholder="12">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-4">
                            <label class="fw600 ff-heading mb-2">Property Tax</label>
                            <input type="text" class="form-control" placeholder="$1000">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="mb-4">
                            <label class="fw600 ff-heading mb-2">Home Insurance</label>
                            <input type="text" class="form-control" placeholder="$1000">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <a href="#" class="ud-btn btn-white2">Calculate<i class="fal fa-arrow-right-long"></i></a>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div> --}}
            
            
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <h4 class="title fz17 mb30">Get More Information</h4>
                <div class="agent-single d-sm-flex align-items-center bdrb1 mb30 pb25">
                  <div class="single-img mb30-sm">
                    <img class="w90" src="{{asset('front/images/team/images.jpeg')}}" alt="">
                  </div>
                  <div class="single-contant ml30 ml0-xs">
                    <h6 class="title mb-1">{{$username->name ?? ''}}</h6>
                    <div class="agent-meta mb10 d-md-flex align-items-center">
                      <a class="text fz15 pe-2 bdrr1" href="#"><i class="flaticon-call pe-1"></i>{{ $username->phone_number ?? ''}}</a>
                      {{-- <a class="text fz15 pe-2 ps-2 bdrr1" href="#"><i class="flaticon-smartphone pe-1"></i>(920) 012-4390</a> --}}
                      @if (Auth::check())
                          <a href="https://wa.me/{{ $username->phone_number }}?text=Hello%20from%20your%20website" class="m-2 pl-2 mt-lg-1">
                            <i class="fab fa-whatsapp whtsdes"></i>
                          </a>   
                      @endif
                    </div>
                    <div class="agent-social">
                      <a class="mr20" href="https://www.facebook.com/JuliaSuriname"><i class="fab fa-facebook-f"></i></a>
                      <a class="mr20" href="https://www.instagram.com/juliasuriname/"><i class="fab fa-instagram"></i></a>
                      {{-- <a class="mr20" href="#"><i class="fab fa-twitter"></i></a>
                      <a href="#"><i class="fab fa-linkedin-in"></i></a> --}}
                    </div>
                  </div>
                </div>
                
              </div>
              
            
            </div>
            <div class="col-lg-4">
              <div class="column">
                <div class="default-box-shadow1 bdrs12 bdr1 p30 mb30-md bgc-white position-relative">
                  <h4 class="form-title mb5">User Post Details</h4>
                  {{-- <p class="text">Choose your preferred day</p> --}}
                  <div class="ps-navtab">
                    {{-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                      <li class="nav-item" role="presentation">
                        <button class="nav-link active mr15 mb5-lg" id="pills-inperson-tab" data-bs-toggle="pill" data-bs-target="#pills-inperson" type="button" role="tab" aria-controls="pills-inperson" aria-selected="true">In Person</button>
                      </li>
                      <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-videochat-tab" data-bs-toggle="pill" data-bs-target="#pills-videochat" type="button" role="tab" aria-controls="pills-videochat" aria-selected="false">Video Chat</button>
                      </li>
                    </ul> --}}
                    @if(isset($username))
                    <div class="tab-content" id="pills-tabContent">
                      <div class="tab-pane fade show active" id="pills-inperson" role="tabpanel" aria-labelledby="pills-inperson-tab">
                        <form class="form-style1">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="mb20">
                               <label for="">Name:  {{$username->name ?? ''}}</label>
                              </div>
                            </div>
                            {{-- <div class="col-lg-12">
                              <div class="mb20">
                                <label for="">Email : {{$username->email ?? ''}} </label>
                              </div>
                            </div> --}}
                            {{-- <div class="col-lg-12">
                              <div class="mb20">
                                <label for="">Phone Number : {{$username->phone_number ?? ''}}</label>
                              </div>
                            </div> --}}
                            <div class="col-md-12">
                              <div class="mb20">
                                <label for="">Chat :</label> 
                                @if (Auth::check() && isset($username))
                                  <a class="icon mr10" href="{{url('chatify/'.$username->usId)}}"><span class="fas fa-comment"></span></a>
                                @else
                                  <a class="icon mr10" href="{{url('chatify')}}" data-bs-toggle="modal" data-bs-target="#login"><span class="fas fa-comment"></span></a>
                                @endif
                              </div>
                            </div>

                            <div class="col-md-12">
                              <div class="mb20">
                                <label for="">WhatsApp :</label> 
                                @if (Auth::check())
                                <a href="https://wa.me/{{ $username->phone_number }}?text=Hello%20from%20your%20website" class="m-2 pl-2 mt-lg-1">
                                  <i class="fab fa-whatsapp whtsdes"></i>
                                </a>
                               
                                @endif
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                      @endif

                      <div class="tab-pane fade" id="pills-videochat" role="tabpanel" aria-labelledby="pills-videochat-tab">
                        <form class="form-style1">
                          <div class="row">
                            <div class="col-md-12">
                              <div class="mb20">
                                <input type="text" class="form-control" placeholder="Time" />
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="mb20">
                                <input type="text" class="form-control" placeholder="Name">
                              </div>
                            </div>
                            <div class="col-lg-12">
                              <div class="mb20">
                                <input type="text" class="form-control" placeholder="Phone">
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="mb20">
                                <input type="email" class="form-control" placeholder="Email">
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="mb10">
                                <textarea cols="30" rows="4" placeholder="Enter Your Messages"></textarea>
                              </div>
                            </div>
                            <div class="col-md-12">
                              <div class="d-grid">
                                <a class="ud-btn btn-thm" href="#">Submit a Tour Request<i class="fal fa-arrow-right-long"></i></a>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="agen-personal-info position-relative bgc-white default-box-shadow1 bdrs12 p30 mt30">
                  <div class="widget-wrapper mb-0">
                    <h6 class="title fz17 mb30">Get More Information</h6>
                    <div class="agent-single d-sm-flex align-items-center pb25">
                      <div class="single-img mb30-sm">
                        <img class="w90" src="{{asset('front/images/team/images.jpeg')}}" alt="">
                      </div>
                      <div class="single-contant ml20 ml0-xs">
                        <h6 class="title mb-1">{{$username->name ?? ''}}</h6>
                        <div class="agent-meta mb10 d-md-flex align-items-center">
                          <a class="text fz15" href="#">
                            <i class="flaticon-call pe-1"></i>{{ $username->phone_number ?? ''}}
                          </a>
                        </div>
                        {{-- <a href="#" class="text-decoration-underline fw600">View Listings</a> --}}
                      </div>
                    </div>
                    <div class="d-grid">
                      <button class="ud-btn btn-white2">Contact Agent<i class="fal fa-arrow-right-long"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>


          <div class="row mt30 wow fadeInUp" data-wow-delay="700ms">
            <div class="col-lg-9">
              <div class="main-title2">
                <h2 class="title">Nearby Similar Homes</h2>
              </div>
            </div>
          </div>

          <div class="row wow fadeInUp" data-wow-delay="900ms">
            <div class="col-lg-12">
              <div class="property-city-slider navi_pagi_top_right slider-dib-sm slider-3-grid owl-theme owl-carousel">
                @if(count($propertyestype)>0)
                  @foreach ($propertyestype as $propertye)
                    @if($propertye->distance <= 25)
                    <div class="item">
                      <?php 
                          $property_attachments = DB::table('property_attachments')->where('properti_id',$propertye->properti_id)->first();
                          $property = DB::table('properties')->where('id',$propertye->properti_id)->first();
                          $propertylocation = DB::table('property_details')->where('properti_id',$propertye->properti_id)->first();
                         
                      ?>
                      <div class="listing-style1">
                        <div class="list-thumb all-section-img">
                          <img class="w-100" src="{{ asset('uploads/property/'.$property_attachments->attachment) }}" alt="">
                          
                          @if($property->is_featured == 1)
                            <div class="list-tag fz12"><span class="flaticon-electricity me-2"></span>FEATURED</div>
                          @endif

                          <?php  
                              $newvalue  = $property->price;
                              $pricenew = (int)$newvalue;
                          ?>
                          <div class="list-price">SRD {{$pricenew}}</div>
                        </div>
                        <div class="list-content">
                          <h6 class="list-title"><a href="{{ url('details/' .base64_encode($property->id)) }}">{{$property->title}}</a></h6>
                          <p class="list-text">{{$propertye->address}}</p>
                          <div class="list-meta d-flex align-items-center">
                            <a href="#"><span class="flaticon-bed"></span>{{$propertylocation->bedrooms}}</a>
                            <a href="#"><span class="flaticon-shower"></span>{{$propertylocation->bathrooms}}</a>
                            <a href="#"><span class="flaticon-expand"></span>{{$propertylocation->size_in_ft}}</a>
                          </div>
                          <hr class="mt-2 mb-2">
                          <div class="list-meta2 d-flex justify-content-between align-items-center">
                            @if($property->is_rent_type == 1)
                              <span class="for-what">For Rent</span>
                            @elseif($property->is_rent_type == 2)
                              <span class="for-what">For Sale</span>
                            @endif
                            <div class="icons d-flex align-items-center">
                              @php
                              $wish = DB::table('wishlishts')
                                    ->where('product_id', $property_slug->id)
                                    ->where('user_id', Auth::id())
                                    ->get();
                            @endphp
        
                              @if ($wish->isNotEmpty())
                                <a href="javascript:void(0)" data-id="{{$property_slug->id}}" class="icon mr10 addTowishlisht like-icone rounded-circle">
                                  <i class="fa-solid fa-heart" style="color:red"></i>
                                </a>
                              @else
                                @if(Auth::check())
                                  <a href="javascript:void(0)" data-id="{{$property_slug->id}}" class="icon mr10 addTowishlisht like-icone rounded-circle">
                                    <i class="fa-solid fa-heart"></i>
                                  </a>
                                @else
                                  <a href="javascript:void(0)" data-id="{{$property_slug->id}}" data-bs-toggle="modal" data-bs-target="#login"  class="icon mr10 addTowishlisht like-icone rounded-circle">
                                    <i class="fa-solid fa-heart"></i>
                                  </a>
                                @endif
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                  @endforeach
                @endif 
              </div>
            </div>
          </div>
          
        </div>

      @else
        <div class="row">
          <div class="no-up">
              <div class="noenquery for-margin" style="text-align: center">
                  {{-- <img src="{{asset('front/no-data.gif')}}" alt="Girl in a jacket"> --}}
              </div>
              <div style="text-align:center;padding-top: 25px;">
                  <h2 class="noupcom">There is no post available.</h2>
              </div>
          </div>
        </div>  
      @endif
    </section>
    @include('front.master.include.footer')
@endsection

@push('custom-scripts')

  <script type="text/javascript"
   src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&loading=async&libraries=geometry&callback=initMap" async defer>  
   </script> 
        <script type="text/javascript">
          
          function initMap() {
            const lat = $('#lat').val();
            const lng = $('#lag').val();
            
            const myLatLng = { lat: parseFloat(lat), lng: parseFloat(lng) };
            const map = new google.maps.Map(document.getElementById("map"), {
              zoom: 5,
              center: myLatLng,
            });
            
            new google.maps.Marker({
            position: myLatLng,
            map:map,
           
          });
          }
        
      </script>
   
<script>
    //  Fixed sidebar Custom Script For That 
    $(function() {
      var cols = $('.wrap .column');
      var enabled = true;
      var scrollbalance = new ScrollBalance(cols, {
        minwidth: 0
      });
      // bind to scroll and resize events
      scrollbalance.bind();
    });
    
    // show maps js code
   
        
    //added to wishlisht
        $(document).on('click', '.addTowishlisht', function (event) {
                var current = $(this);
                var id = $(this).attr('data-id');
                
                $.ajax({
                    type: 'GET', 
                    url:"{{ url('/add-To-wishlisht') }}",
                    data: {'id':id},  
                    success: function (response) {
                        console.log(response);      
                        if (response.success == true) {
                            toastr.success('Property Added To Wishlist')
                            $(current).html('<i class="fa-solid fa-heart" style="color:#E52D27"></i>');
                            // window.setTimeout(function() {
                            // }, 2000);
                        }else{
                            window.setTimeout(function() {
                                swal({
                                    icon: 'error',
                                    title: 'Already added property in wishlist',
                                    text: 'Something went wrong!',
                                })
                               // window.location = "<?php echo e(url('/')); ?>" + "categoryesnew";
                            }, 2000); 
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });
    </script>
    <style>
        .fa-heart {
        color: gray;
        }
    </style> 
    <script>
        $(".hearti").click(function(){
        $(".heartis").css("color", "red");
        });
    </script>  
@endpush