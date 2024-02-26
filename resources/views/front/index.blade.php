@extends('front.master.index')

@section('title', 'Julia Real Estate')

@section('content')
    <style>
        .sellview {
        position: absolute;
    z-index: 99999;
    left: 10%;
    bottom: 4%;
}
.sel_v {
    position: relative;
    left: -15%;
}
        
        .wrong_error {
            color: red;
        }

        .modal:before {
            position: fixed;
        }

        .modal-body input {
            padding: 5px 12px !important;
        }

        .listing-style1 .list-thumb,
        .listing-style6 .list-thumb {
            min-height: 354px
        }

        .owl-carousel .owl-item img,
        .listing-style6 img {
            object-fit: cover;
            aspect-ratio: 1/1;
        }
        #product_list {
            max-height: 400px;
            overflow-x: hidden;
            overflow-y: scroll;
        }
        .slider-size {
            height: 200px; 
        }

        /* span.show-hide-password {
              position: absolute;
              top: 34px;
              right: 3%;
              font-size: 21px;
              color: #748a9c;
              cursor: pointer;
              z-index: 6;
        } */
    </style>
    @inject('carbon', 'Carbon\Carbon')


    <!-- Signup Modal -->
    <div class="signup-modal">
        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalToggleLabel">Welcome to Julia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="log-reg-form">
                            <div class="navtab-style2">
                                <nav>
                                    <div class="nav nav-tabs mb20" id="nav-tab" role="tablist">
                                        <button class="nav-link active fw600" id="nav-home-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-home" type="button" role="tab"
                                            aria-controls="nav-home" aria-selected="true">Sign In</button>
                                        <button class="nav-link fw600" id="nav-profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-profile" type="button" role="tab"
                                            aria-controls="nav-profile" aria-selected="false">New Account</button>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent2">
                                    <div class="tab-pane fade show active fz15" id="nav-home" role="tabpanel"
                                        aria-labelledby="nav-home-tab">
                                        <div class="form-style1">
                                            <div class="mb25">
                                                <label class="form-label fw600 dark-color">Email</label>
                                                <input type="email" class="form-control" placeholder="Enter Email">
                                            </div>
                                            <div class="mb15">
                                                <label class="form-label fw600 dark-color">Password</label>
                                                <input type="text" class="form-control" placeholder="Enter Password">
                                            </div>
                                            <div
                                                class="checkbox-style1 d-block d-sm-flex align-items-center justify-content-between mb10">
                                                <label class="custom_checkbox fz14 ff-heading">Remember me
                                                    <input type="checkbox" checked="checked">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <a class="fz14 ff-heading" href="#">Lost your password?</a>
                                            </div>
                                            <div class="d-grid mb20">
                                                <button class="ud-btn btn-thm" type="button">Sign in <i
                                                        class="fal fa-arrow-right-long"></i></button>
                                            </div>
                                            <div class="hr_content mb20">
                                                <hr><span class="hr_top_text">OR</span>
                                            </div>
                                            <div class="d-grid mb10">
                                                <button class="ud-btn btn-white" type="button"><i
                                                        class="fab fa-google"></i> Continue Google</button>
                                            </div>
                                            <div class="d-grid mb10">
                                                <button class="ud-btn btn-fb" type="button"><i
                                                        class="fab fa-facebook-f"></i> Continue Facebook</button>
                                            </div>
                                            <div class="d-grid mb20">
                                                <button class="ud-btn btn-apple" type="button"><i class="fab fa-apple"></i>
                                                    Continue Apple</button>
                                            </div>
                                            <p class="dark-color text-center mb0 mt10">Not signed up? <a
                                                    class="dark-color fw600" href="#">Create an account.</a></p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade fz15" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab">
                                        <div class="form-style1">
                                            <div class="mb25">
                                                <label class="form-label fw600 dark-color">Email</label>
                                                <input type="email" class="form-control" placeholder="Enter Email">
                                            </div>
                                            <div class="mb20">
                                                <label class="form-label fw600 dark-color">Password</label>
                                                <input type="text" class="form-control" placeholder="Enter Password">
                                            </div>
                                            <div class="d-grid mb20">
                                                <button class="ud-btn btn-thm" type="button">Create account <i
                                                        class="fal fa-arrow-right-long"></i></button>
                                            </div>
                                            <div class="hr_content mb20">
                                                <hr><span class="hr_top_text">OR</span>
                                            </div>
                                            <div class="d-grid mb10">
                                                <button class="ud-btn btn-white" type="button"><i
                                                        class="fab fa-google"></i> Continue Google</button>
                                            </div>
                                            <div class="d-grid mb10">
                                                <button class="ud-btn btn-fb" type="button"><i
                                                        class="fab fa-facebook-f"></i> Continue Facebook</button>
                                            </div>
                                            <div class="d-grid mb20">
                                                <button class="ud-btn btn-apple" type="button"><i
                                                        class="fab fa-apple"></i> Continue Apple</button>
                                            </div>
                                            <p class="dark-color text-center mb0 mt10">Not signed up? <a
                                                    class="dark-color fw600" href="#">Create an account.</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Menu In Hiddn SideBar -->
    @include('front.master.include.common_sidebar')

    <!--End Menu In Hiddn SideBar -->
    <!-- Advance Feature Modal Start -->
    <div class="advance-feature-modal">
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header pl30 pr30">
                        <h5 class="modal-title" id="exampleModalLabel">More Filter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="widget-wrapper">
                                    <h6 class="list-title">Price Range</h6>
                                    <!-- Range Slider Mobile Version -->
                                    <div class="range-slider-style modal-version">
                                        <div class="range-wrapper">
                                            <div class="mb30 mt35" id="slider"></div>
                                            <div class="d-flex align-items-center">
                                                <span id="slider-range-value1"></span><i
                                                    class="fa-sharp fa-solid fa-minus mx-2 dark-color icon"></i>
                                                <span id="slider-range-value2"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="widget-wrapper">
                                    <h6 class="list-title">Type</h6>
                                    <div class="form-style2 input-group">
                                        <select class="selectpicker" data-live-search="true" data-width="100%">
                                            <option>Property</option>
                                            <option data-tokens="Apartments">Apartments</option>
                                            <option data-tokens="Bungalow">Bungalow</option>
                                            <option data-tokens="Houses">Houses</option>
                                            <option data-tokens="Loft">Loft</option>
                                            <option data-tokens="Office">Office</option>
                                            <option data-tokens="Townhome">Townhome</option>
                                            <option data-tokens="Villa">Villa</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="widget-wrapper">
                                    <h6 class="list-title">Property ID</h6>
                                    <div class="form-style2">
                                        <input type="text" class="form-control" placeholder="RT04949213">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="widget-wrapper">
                                    <h6 class="list-title">Bedrooms</h6>
                                    <div class="d-flex">
                                        <div class="selection">
                                            <input id="xany" name="xbeds" type="radio" checked>
                                            <label for="xany">any</label>
                                        </div>
                                        <div class="selection">
                                            <input id="xoneplus" name="xbeds" type="radio">
                                            <label for="xoneplus">1+</label>
                                        </div>
                                        <div class="selection">
                                            <input id="xtwoplus" name="xbeds" type="radio">
                                            <label for="xtwoplus">2+</label>
                                        </div>
                                        <div class="selection">
                                            <input id="xthreeplus" name="xbeds" type="radio">
                                            <label for="xthreeplus">3+</label>
                                        </div>
                                        <div class="selection">
                                            <input id="xfourplus" name="xbeds" type="radio">
                                            <label for="xfourplus">4+</label>
                                        </div>
                                        <div class="selection">
                                            <input id="xfiveplus" name="xbeds" type="radio">
                                            <label for="xfiveplus">5+</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="widget-wrapper">
                                    <h6 class="list-title">Bathrooms</h6>
                                    <div class="d-flex">
                                        <div class="selection">
                                            <input id="yany" name="ybath" type="radio" checked>
                                            <label for="yany">any</label>
                                        </div>
                                        <div class="selection">
                                            <input id="yoneplus" name="ybath" type="radio">
                                            <label for="yoneplus">1+</label>
                                        </div>
                                        <div class="selection">
                                            <input id="ytwoplus" name="ybath" type="radio">
                                            <label for="ytwoplus">2+</label>
                                        </div>
                                        <div class="selection">
                                            <input id="ythreeplus" name="ybath" type="radio">
                                            <label for="ythreeplus">3+</label>
                                        </div>
                                        <div class="selection">
                                            <input id="yfourplus" name="ybath" type="radio">
                                            <label for="yfourplus">4+</label>
                                        </div>
                                        <div class="selection">
                                            <input id="yfiveplus" name="ybath" type="radio">
                                            <label for="yfiveplus">5+</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="widget-wrapper">
                                    <h6 class="list-title">Location</h6>
                                    <div class="form-style2 input-group">
                                        <select class="selectpicker" data-live-search="true" data-width="100%">
                                            <option>All Cities</option>
                                            <option data-tokens="California">California</option>
                                            <option data-tokens="Chicago">Chicago</option>
                                            <option data-tokens="LosAngeles">Los Angeles</option>
                                            <option data-tokens="Manhattan">Manhattan</option>
                                            <option data-tokens="NewJersey">New Jersey</option>
                                            <option data-tokens="NewYork">New York</option>
                                            <option data-tokens="SanDiego">San Diego</option>
                                            <option data-tokens="SanFrancisco">San Francisco</option>
                                            <option data-tokens="Texas">Texas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="widget-wrapper">
                                    <h6 class="list-title">Square Feet</h6>
                                    <div class="space-area">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="form-style1">
                                                <input type="text" class="form-control" placeholder="Min.">
                                            </div>
                                            <span class="dark-color">-</span>
                                            <div class="form-style1">
                                                <input type="text" class="form-control" placeholder="Max">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="widget-wrapper mb0">
                                    <h6 class="list-title mb10">Amenities</h6>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="widget-wrapper mb20">
                                    <div class="checkbox-style1">
                                        <label class="custom_checkbox">Attic
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="custom_checkbox">Basketball court
                                            <input type="checkbox" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="custom_checkbox">Air Conditioning
                                            <input type="checkbox" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="custom_checkbox">Lawn
                                            <input type="checkbox" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="widget-wrapper mb20">
                                    <div class="checkbox-style1">
                                        <label class="custom_checkbox">TV Cable
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="custom_checkbox">Dryer
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="custom_checkbox">Outdoor Shower
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="custom_checkbox">Washer
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="widget-wrapper mb20">
                                    <div class="checkbox-style1">
                                        <label class="custom_checkbox">Lake view
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="custom_checkbox">Wine cellar
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="custom_checkbox">Front yard
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="custom_checkbox">Refrigerator
                                            <input type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <a class="reset-button" href="#"><span class="flaticon-turn-back"></span><u>Reset all filters</u></a>
                        <div class="btn-area">
                            <button class="ud-btn btn-thm">
                                <span class="flaticon-search align-text-top pr10"></span>
                                Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Advance Feature Modal End -->

    <div class="hiddenbar-body-ovelay"></div>

    <div class="body_content">
        <!-- Home Banner Style V1 -->
        <section class="home-banner-style3 p0">
            <div class="home-style3">
               <div class="container">
                  <div class="row">
                     <div class="col-xl-8">
                        <div class="inner-banner-style3">
                           <h2 class="hero-title mb30 animate-up-1">Find The Perfect Place to Live With your Family</h2>
                           <div class="advance-style3 mb30 mx-auto animate-up-2">
                              <ul class="nav nav-tabs p-0 m-0" id="myTab" role="tablist">

                                 <li class="nav-item rent_type" role="presentation">
                                    <button class="nav-link active" id="profile-tab" data-bs-toggle="tab"
                                       data-bs-target="#profile" type="button" role="tab"
                                       aria-controls="profile" aria-selected="false">Rent</button>
                                 </li>

                                 <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                       data-bs-target="#contact" type="button" role="tab"
                                       aria-controls="contact" aria-selected="false">Sale</button>
                                 </li>

                              </ul>
                              
                              <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="profile" role="tabpanel"
                                    aria-labelledby="profile-tab">
                                    <div class="advance-content-style3">
                                        <form action="{{route('property-listing')}}" method="post" class="form-search position-relative" accept-charset="utf-8">
                                            @csrf
                                            <div class="row julia-rows">
                                                <input type="hidden" name="fore_rent2" id="fore_rent2" value="2">
                                                <div class="col-md-3 col-lg-4 julia-col">
                                                    <div class="mt-3 mt-md-0">
                                                        <div class="bootselect-multiselect">
                                                            <select class="selectpicker" name="categoryes_id" id="categoryes_id">
                                                                <option value="">Type</option>
                                                                @foreach ($category as $categorye)
                                                                    <option value="{{ $categorye->id }}">{{ $categorye->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 pe-0">
                                                    <div class="d-flex align-items-center justify-content-start justify-content-md-center mt-2 mt-md-0">
                                                        <button class="advance-search-icon ud-btn btn-thm ms-4" type="submit">
                                                        <span class="flaticon-search"></span></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                 <div class="tab-pane fade" id="contact" role="tabpanel"
                                    aria-labelledby="contact-tab">
                                    <div class="advance-content-style3">
                                    <form action="{{route('property-listing')}}" method="post"  class="form-search position-relative" accept-charset="utf-8">
                                            @csrf
                                        <div class="row julia-rows">
                                          {{-- <div class="col-md-5 col-lg-4">
                                             <div class="advance-search-field position-relative text-start">
                                                    <div class="box-search">
                                                    <input type="hidden" name="fore_sale1" id="fore_sale1">
                                                      <span class="icon flaticon-home-1"></span>
                                                      <input class="form-control bgc-f7 search_title" type="text" name="search" id="serachsale" placeholder="Enter Keyword" autocomplete="off">
                                                      <div id="product_list1"></div>
                                                   </div>
                                             </div>
                                          </div> --}}
                                          <input type="hidden" name="fore_sale1" id="fore_sale1" value="1">
                                          <div class="col-md-8 col-lg-4 julia-col">
                                             <div class="mt-3 mt-md-0">
                                                <div class="bootselect-multiselect">
                                                   <select class="selectpicker" name="categoryes_id" id="categoryes_id_sale">
                                                      <option value="">Type</option>
                                                      @foreach ($category as $categorye)
                                                        <option value="{{ $categorye->id }}">{{ $categorye->name }}</option>
                                                      @endforeach
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-md-4 pe-0">
                                             <div class="d-flex align-items-center justify-content-start justify-content-md-center mt-2 mt-md-0">
                                                <button class="advance-search-icon ud-btn btn-thm ms-4" type="submit">
                                                    <span class="flaticon-search"></span>
                                                </button>
                                             </div>
                                          </div>
                                        </div>
                                    </form>
                                    </div>
                                 </div>

                              </div>
                              
                           </div>
                        </div>
                     </div>

                     <div class="col-xl-4 d-none d-xl-block">
                        <div class="home3-img-box1">
                           @foreach ($banners as $banner)
                           <img class="img-1" src="{{ asset('uploads/banner/' . $banner->banner_image) }}"
                              alt="">
                           @endforeach
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        </section>

        @if(count($adddiamond) > 0)
             <!------New-Slider------>
            <section class="new-slider" style="position: relative;">
                <div class="container">
                    <div id="demo" class="carousel slide" data-bs-ride="carousel">
                    <!-- The slideshow/carousel -->
                    <div class="carousel-inner new-cinner">
                        @foreach ($adddiamond as $key=> $add)
                            @php
                                $PackageType1 = DB::table('payments')
                                                ->where('user_id', $add->user_id)
                                                ->where('package_id', $add->package_id)
                                                ->first();

                                $createdAt = date('Y-m-d H:i:s', strtotime($add->created_at));
                                $currentDate = time(); // This gets the current timestamp
                                $daysDifference = floor(($currentDate - strtotime($createdAt)) / (60 * 60 * 24));
                            @endphp
                                @if (isset($PackageType1) &&($PackageType1->package_name == 'Diamond' || $PackageType1->package_id == '4') && $daysDifference <= 30)
                                    <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                                        <img src="{{asset('/uploads/package/'.$add->image)}}" alt="Los Angeles" class="d-block" style="width:100%">
                                        <div class="sellview">
                                            <h6>{!! $add->description ?? '' !!}</h6>
                                            <a class="ud-btn btn-thm mx-2 mx-xl-4 sell-btns sel_v" href="{{ $add->url }}" target="_blank">Shop Now<i class="fal fa-arrow-right-long"></i></a>
                                        </div>
                                    </div>
                                @endif
                        @endforeach 
                    </div>

                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    </button>
                    </div>
                </div>
            </section>
        <!----New-Slider---->
        @endif
       


        <!-- Popular Property -->
        <section class="pb30-md pt-0 suggest-section">
            <div class="container">
                <div class="row wow fadeInUp" data-wow-delay="00ms">
                    <div class="col-lg-9">
                        <div class="main-title2">
                            <h2 class="title">Suggested for you</h2>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="dark-light-navtab style2 text-start text-lg-end mt-0 mt-lg-4 mb-4">
                            <ul class="nav nav-pills justify-content-start justify-content-lg-end" id="pills-tab"
                                role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab"
                                        aria-controls="pills-home" aria-selected="true">For Rent</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link me-0" id="pills-profile-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-profile" type="button" role="tab"
                                        aria-controls="pills-profile" aria-selected="false">For Sale</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 wow fadeInUp" data-wow-delay="300ms">
                        <div class="tab-content" id="pills-tabContent">

                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">

                                <div class="row">
                                    @if (count($propertyes) > 0)
                                        @foreach ($propertyes as $property)
                                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                                <?php
                                                $property_locations = DB::table('property_locations')
                                                    ->where('properti_id', $property->id)
                                                    ->first();
                                                $property_details = DB::table('property_details')
                                                    ->where('properti_id', $property->id)
                                                    ->first();
                                                $property_attachments = DB::table('property_attachments')
                                                    ->where('properti_id', $property->id)
                                                    ->first();
                                                
                                                ?>
                                                <div class="listing-style5">
                                                    <div class="list-thumb">
                                                        <a href="{{ url('details/'.base64_encode($property->id)) }}">
                                                            <img src="{{ asset('uploads/property/' . $property_attachments->attachment) }}"
                                                                alt="" style="width: 100%; height: 290px;">
                                                        </a>
                                                        @if ($property->is_featured == 1)
                                                            <div class="list-tag fz12"><span
                                                                    class="flaticon-electricity me-2"></span>FEATURED</div>
                                                        @endif

                                                        <div class="list-meta2">
                                                           
                                                        </div>
                                                    </div>

                                                    <div class="list-content">
                                                        <div class="d-flex justify-content-between list-price mb-2">
                                                            <?php
                                                               $pricevalue  = $property->price;
                                                               $newprice = (int)$pricevalue;
                                                            ?>
                                                            <div>SRD {{ $newprice }} </div>

                                                            @php
                                                                $wish = DB::table('wishlishts')
                                                                    ->where('product_id', $property->id)
                                                                    ->where('user_id', Auth::id())
                                                                    ->get();
                                                            @endphp

                                                            @if ($wish->isNotEmpty())
                                                                <div class="like-icons rounded-circle">
                                                                    <a href="javascript:void(0)"
                                                                        data-id="{{ $property->id }}"
                                                                        class="addTowishlisht">
                                                                        <i class="fa-solid fa-heart"
                                                                            style="color:red"></i></a>
                                                                </div>
                                                        </div>
                                                    @else
                                                        @if (Auth::check())
                                                            <div class="like-icons rounded-circle">
                                                                <a href="javascript:void(0)"
                                                                    data-id="{{ $property->id }}" class="addTowishlisht">
                                                                    <i class="fa-solid fa-heart"></i></a>
                                                            </div>
                                                    </div>
                                                @else
                                                    <div class="like-icons rounded-circle">
                                                        <a href="javascript:void(0)" data-id="{{ $property->id }}"
                                                            data-bs-toggle="modal" data-bs-target="#login"
                                                            class="addTowishlisht">
                                                            <i class="fa-solid fa-heart"></i></a>
                                                    </div>
                                                </div>
                                        @endif
                                    @endif
                                    <h6 class="list-title"><a
                                            href="{{ url('details/' .base64_encode($property->id)) }}">{{ $property->title }}</a>
                                    </h6>
                                    <p class="list-text">{{ $property_locations->address }}</p>
                                    <div class="list-meta d-flex align-items-center">
                                        <a href="#"><span
                                                class="flaticon-bed"></span>{{ $property_details->bedrooms }}</a>
                                        <a href="#"><span
                                                class="flaticon-shower"></span>{{ $property_details->bathrooms }}</a>
                                        <a href="#"><span
                                                class="flaticon-expand"></span>{{ $property_details->size_in_ft }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="fore_rent" value="{{$property->is_rent_type}}">
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="row">
                        @if (count($propertyestype) > 0)
                            @foreach ($propertyestype as $property)
                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <?php
                                    $property_locations = DB::table('property_locations')
                                        ->where('properti_id', $property->id)
                                        ->first();
                                    $property_details = DB::table('property_details')
                                        ->where('properti_id', $property->id)
                                        ->first();
                                    $property_attachments = DB::table('property_attachments')
                                        ->where('properti_id', $property->id)
                                        ->first();
                                    
                                    ?>
                                    <div class="listing-style5">
                                        <div class="list-thumb">
                                            <a href="{{ url('details/' .base64_encode($property->id)) }}">
                                                <img class="w-100"
                                                    src="{{ asset('uploads/property/' . $property_attachments->attachment) }}"alt="">
                                            </a>
                                            @if ($property->is_featured == 1)
                                                <div class="list-tag fz12"><span
                                                        class="flaticon-electricity me-2"></span>FEATURED</div>
                                            @endif
                                            <div class="list-meta2">
                                               
                                            </div>
                                        </div>
                                        <div class="list-content">
                                            <div class="d-flex justify-content-between list-price mb-2">
                                                <?php
                                                    $pricevalue  = $property->price;
                                                    $newprice = (int)$pricevalue;
                                                ?>
                                                <div>SRD {{ $newprice }} </div>
                                                
                                                @php
                                                    $wish = DB::table('wishlishts')
                                                            ->where('product_id', $property->id)
                                                            ->where('user_id', Auth::id())
                                                            ->get();

                                                @endphp
                                                @if ($wish->isNotEmpty())
                                                <div class="like-icons rounded-circle">
                                                    <a href="javascript:void(0)" data-id="{{ $property->id }}" class="addTowishlisht">
                                                        <i class="fa-solid fa-heart" style="color:#E52D27"></i>
                                                    </a>
                                                </div>
                                                @else
                                                    @if ((Auth::check()))
                                                    <div class="like-icons rounded-circle">
                                                        <a href="javascript:void(0)" data-id="{{ $property->id }}" class="addTowishlisht"><i
                                                                class="fa-solid fa-heart"></i>
                                                            </a>
                                                    </div>
                                                    @else
                                                    <div class="like-icons rounded-circle">
                                                        <a href="javascript:void(0)" data-id="{{ $property->id }}" data-bs-toggle="modal" data-bs-target="#login" class="addTowishlisht"><i
                                                                class="fa-solid fa-heart"></i>
                                                            </a>
                                                    </div>
                                                    @endif
                                                @endif
                                            </div>
                                            <h6 class="list-title"><a
                                                    href="{{ url('details/' .base64_encode($property->id)) }}">{{ $property->title }}</a>
                                            </h6>
                                            <p class="list-text">{{ $property_locations->address }}</p>
                                            <div class="list-meta d-flex align-items-center">
                                                <a href="#"><span
                                                        class="flaticon-bed"></span>{{ $property_details->bedrooms }}</a>
                                                <a href="#"><span
                                                        class="flaticon-shower"></span>{{ $property_details->bathrooms }}</a>
                                                <a href="#"><span
                                                        class="flaticon-expand"></span>{{ $property_details->size_in_ft }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" id="fore_sale" value="{{$property->is_rent_type}}">
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            </div>
            </div>
            </div>
        </section>


            <!------New-Slider------>
        @if (count($addgold) > 0)
            <section class="new-slider1" style="position: relative;">
                <div class="container">
                    <div id="demo2" class="carousel slide" data-bs-ride="carousel">
                    <!-- The slideshow/carousel -->
                    <div class="carousel-inner new-cinner">
                        @foreach ($addgold as $key=> $add)
                            @php
                                $PackageType1 = DB::table('payments')
                                                ->where('user_id', $add->user_id)
                                                ->where('package_id', $add->package_id)
                                                ->first();

                                $createdAt = date('Y-m-d H:i:s', strtotime($add->created_at));
                                $currentDate = time(); // This gets the current timestamp
                                $daysDifference = floor(($currentDate - strtotime($createdAt)) / (60 * 60 * 24));
                            @endphp
                             @if (isset($PackageType1) &&($PackageType1->package_name == 'Gold' || $PackageType1->package_id == '3') && $daysDifference <= 30)
                                <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                                    <img src="{{asset('/uploads/package/'.$add->image)}}" alt="Los Angeles" class="d-block" style="width:100%">
                                    <div class="sellview">
                                        <h6>{!! $add->description ?? '' !!}</h6>
                                        <a class="ud-btn btn-thm mx-2 mx-xl-4 sell-btns sel_v" href="{{ $add->url }}" target="_blank">Shop Now<i class="fal fa-arrow-right-long"></i></a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    
                    </div>

                    <!-- Left and right controls/icons -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#demo2" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#demo2" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    </button>
                    </div>
                </div>
            </section>
        @endif
        <!----New-Slider---->


    <!-- Why Chose Us -->
    <section class="choose-section">
        <div class="container">
            @foreach ($whyChooses as $choose)      
            <div class="row align-items-md-center wow fadeInRight" data-wow-delay="300ms">
            <div class="main-title2">
                        <h2 class="title">Why Choose Us</h2>
                        {{-- <p class="paragraph fz15">{{$choose->description}}</p> --}}
                    </div>
                <div class="col-md-6 col-lg-6">
                    <div class="position-relative mb30-md">
                        <img class="w-100 choose-img" src="{{ asset('uploads/why/' . $choose->image) }}" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 offset-lg-1 wow fadeInLeft" data-wow-delay="500ms">
                    
                    @if($choose->property_types!=NULL)
                        @php
                            $input_item_data = $choose->property_types;
                            $input_item_data_array =  json_decode($input_item_data, true);
                            
                        @endphp
                          @if($input_item_data_array != null)
                            @foreach ($input_item_data_array as $key => $input)
                              <?php 
                                  $key_val = array_keys($input);
                                  $input_val = array_values($input);
                              ?>

                                <div class="why-chose-list">
                                    <div class="list-one d-flex align-items-start mb30">
                                        <span class="list-icon flex-shrink-0 flaticon-security"></span>
                                        <div class="list-content flex-grow-1 ml20">
                                            <h6 class="mb-1">{{$key_val[0]}}</h6>
                                            <p class="text mb-0 fz15">{{$input_val[0]}}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif    
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </section>

    

<!------New-Slider------>
    @if (count($addsilver) > 0)
    <section class="new-slider1" style="position: relative;">
        <div class="container">
            <div id="demo3" class="carousel slide" data-bs-ride="carousel">
            <!-- The slideshow/carousel -->
            <div class="carousel-inner new-cinner">
                @foreach ($addsilver as $key=> $add)
                    @php
                        $PackageType1 = DB::table('payments')
                                        ->where('user_id', $add->user_id)
                                        ->where('package_id', $add->package_id)
                                        ->first();

                        $createdAt = date('Y-m-d H:i:s', strtotime($add->created_at));
                        $currentDate = time(); // This gets the current timestamp
                        $daysDifference = floor(($currentDate - strtotime($createdAt)) / (60 * 60 * 24));
                    @endphp

                    @if (isset($PackageType1) &&($PackageType1->package_name == 'Silver' || $PackageType1->package_id == '2') && $daysDifference <= 30)
                        <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                            <img src="{{asset('/uploads/package/'.$add->image)}}" alt="Los Angeles" class="d-block" style="width:100%">

                            <div class="sellview">
                                    <h6>{!! $add->description ?? '' !!}</h6>
                                    <a class="ud-btn btn-thm mx-2 mx-xl-4 sell-btns sel_v" href="{{ $add->url }}" target="_blank">Shop Now<i class="fal fa-arrow-right-long"></i></a>
                                </div>
                        </div>
                    @endif

                @endforeach
            </div>
            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#demo3" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#demo3" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            </button>
            </div>
        </div>
    </section>
    @endif
<!----New-Slider---->




    <!-- Explore Apartment -->
    <section class="bgc-f7 recommended-section">
        <div class="container">
            <div class="row align-items-center wow fadeInUp" data-wow-delay="00ms">
                <div class="col-lg-9">
                    <div class="main-title2">
                        <h2 class="title">Recommended for you</h2>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="text-start text-lg-end mb-3">
                        {{-- <a class="ud-btn2" href="#">See All Properties<i class="fal fa-arrow-right-long"></i></a> --}}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="300ms">
                    <div class="feature-listing-slider navi_pagi_bottom_center slider-dib-sm slider-3-grid owl-carousel owl-theme">
                        @foreach ($propertyesrecomend as $propertye)
                            <div class="item">
                                <?php
                                $property_attachments = DB::table('property_attachments')
                                                        ->where('properti_id', $propertye->id)
                                                        ->first();
                                ?>
                                <div class="listing-style1">
                                    <div class="list-thumb">
                                        <a href="{{ url('details/' .base64_encode($propertye->id)) }}">
                                            <img class="w-100" src="{{ asset('uploads/property/' . $property_attachments->attachment) }}"
                                                alt="">
                                        </a>
                                        @if ($propertye->is_featured == 1)
                                            <div class="list-tag fz12"><span class="flaticon-electricity me-2"></span>FEATURED</div>
                                        @endif
                                        <?php
                                            $pricevalue  = $propertye->price;
                                            $newprice = (int)$pricevalue;
                                        ?>       
                                        <div class="list-price">SRD {{ $newprice}} </div>
                                    </div>

                                    <div class="list-content slider-content">
                                        <h6 class="list-title"><a href="{{ url('details/' .base64_encode($propertye->id)) }}">{{ $propertye->title }}</a></h6>
                                        <p class="list-text">{{ $propertye->address }}</p>
                                        <div class="list-meta d-flex align-items-center">
                                            <a href="#">
                                                <span class="flaticon-bed"></span>{{ $propertye->bedrooms }}
                                            </a>
                                            <a href="#">
                                                <span class="flaticon-shower"></span>{{ $propertye->bathrooms }}
                                            </a>
                                            <a href="#">
                                                <span class="flaticon-expand"></span>{{ $propertye->size_in_ft }} sqft
                                            </a>
                                        </div>
                                        <hr class="mt-2 mb-2">
                                        <div class="list-meta2 d-flex justify-content-between align-items-center">
                                            @if ($propertye->is_rent_type == 1)
                                                <span class="for-what">For Sale</span>
                                            @elseif ($propertye->is_rent_type == 2)
                                                <span class="for-what">For Rent</span>
                                            @endif
                                            <div class="icons d-flex align-items-center">
                                                @php
                                                    $wish = DB::table('wishlishts')
                                                            ->where('product_id', $propertye->id)
                                                            ->where('user_id', Auth::id())
                                                            ->get();
                                                @endphp

                                                @if ($wish->isNotEmpty())
                                                    <a href="javascript:void(0)" data-id="{{ $propertye->id }}"
                                                        class="addTowishlisht rounded-circle border">
                                                        <i class="fa-solid fa-heart" style="color:red"></i>
                                                    </a>
                                                @else
                                                    @if (Auth::check())
                                                        <a href="javascript:void(0)" data-id="{{ $propertye->id }}"
                                                            class="addTowishlisht rounded-circle border">
                                                            <i class="fa-solid fa-heart"></i>
                                                        </a>
                                                    @else
                                                        <a href="javascript:void(0)" data-id="{{ $propertye->id }}"
                                                            class="addTowishlisht rounded-circle border"
                                                            data-bs-toggle="modal" data-bs-target="#login">
                                                            <i class="fa-solid fa-heart"></i>
                                                        </a>
                                                    @endif
                                                @endif
                                                
                                                {{-- <a href="javascript:void(0)" data-id="{{$propertye->id}}" class="addTowishlisht"><i class="fa-solid fa-heart heartm"></i></a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Explore Apartment -->

    <!-- Property Cities -->
    <section class="bgc-white property-section">
        <div class="container">
            <div class="row align-items-center wow fadeInUp" data-wow-delay="100ms">
                <div class="col-lg-9">
                    <div class="main-title2">
                        <h2 class="title">Properties by Cities</h2>

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="text-start text-lg-end mb-3">
                        <a class="ud-btn2" href="{{ route('cities-listing') }}">See All Cities<i
                                class="fal fa-arrow-right-long"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="300ms">
                    <div
                        class="property-city-slider style2 dots_none slider-dib-sm slider-6-grid vam_nav_style owl-theme owl-carousel">
                        @if (count($propertCities) > 0)
                            @foreach ($propertCities as $propertCitie)
                                <div class="item">
                                    <a href="#">
                                        <div class="feature-style3 mb30 text-center">
                                            <div class="feature-img rounded-circle">
                                                <img class="w-100"
                                                    src="{{ asset('uploads/cities/' . $propertCitie->image) }}"
                                                    alt="">
                                            </div>
                                            <div class="feature-content pt25">
                                                <h6 class="title mb-1">{{ $propertCitie->title }}</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            @endforeach
                        @endif
                        {{-- <div class="item">
                                <a href="#">
                                    <div class="feature-style3 mb30 text-center">
                                        <div class="feature-img rounded-circle"><img class="w-100"
                                                src="{{ asset('front/images/listings/cp-m-2.png') }}" alt="">
                                        </div>
                                        <div class="feature-content pt25">
                                            <h6 class="title mb-1">Chicago</h6>
                                            <p class="fz15 fw400 dark-color mb-0">12 Properties</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <div class="feature-style3 mb30 text-center">
                                        <div class="feature-img rounded-circle"><img class="w-100"
                                                src="{{ asset('front/images/listings/cp-m-3.png') }}" alt="">
                                        </div>
                                        <div class="feature-content pt25">
                                            <h6 class="title mb-1">Manhattan</h6>
                                            <p class="fz15 fw400 dark-color mb-0">12 Properties</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <div class="feature-style3 mb30 text-center">
                                        <div class="feature-img rounded-circle"><img class="w-100"
                                                src="{{ asset('front/images/listings/cp-m-4.png') }}" alt="">
                                        </div>
                                        <div class="feature-content pt25">
                                            <h6 class="title mb-1">San Francisco</h6>
                                            <p class="fz15 fw400 dark-color mb-0">12 Properties</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <div class="feature-style3 mb30 text-center">
                                        <div class="feature-img rounded-circle"><img class="w-100"
                                                src="{{ asset('front/images/listings/cp-m-5.png') }}" alt="">
                                        </div>
                                        <div class="feature-content pt25">
                                            <h6 class="title mb-1">Los Angeles</h6>
                                            <p class="fz15 fw400 dark-color mb-0">12 Properties</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="item">
                                <a href="#">
                                    <div class="feature-style3 mb30 text-center">
                                        <div class="feature-img rounded-circle"><img class="w-100"
                                                src="{{ asset('front/images/listings/cp-m-6.png') }}" alt="">
                                        </div>
                                        <div class="feature-content pt25">
                                            <h6 class="title mb-1">California</h6>
                                            <p class="fz15 fw400 dark-color mb-0">12 Properties</p>
                                        </div>
                                    </div>
                                </a>
                            </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-0 discover-section">
        <div class="container">
            <div class="row wow fadeInUp" data-wow-delay="100ms">
                <div class="col-lg-6">
                    <div class="main-title2">
                        <h2 class="title">Discover Popular Properties</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="dark-light-navtab style2 text-start text-lg-end mt-0 mt-lg-4 mb-4">
                        <ul class="nav nav-pills justify-content-start justify-content-lg-end" id="pills-tab"
                            role="tablist">
                            @foreach ($categoryes as $categorye)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link mb10-sm  categoryesFilter" data-id="{{ $categorye->id }}"
                                        id="pills-house-tab" data-bs-toggle="pill" data-bs-target="#pills-house"
                                        type="button" role="tab" aria-controls="pills-house"
                                        aria-selected="true">{{ $categorye->name }}</button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="300ms">
                    <div class="tab-content" id="pills-tabContent">
                        <div id='categoryes'>
                            <div class="tab-pane fade show active" id="pills-house" role="tabpanel"
                                aria-labelledby="pills-house-tab">
                                <div class="row">
                                    @foreach ($propertyesrecomend as $propertyes)
                                        <?php
                                        $property_attachments = DB::table('property_attachments')
                                            ->where('properti_id', $propertyes->id)
                                            ->first();
                                        ?>
                                        <div class="col-md-6 col-xl-4 showcategorye">
                                            <div class="listing-style6">
                                                <div class="list-thumb">
                                                    <a href="{{ url('details/' .base64_encode($propertyes->id)) }}">
                                                        <img class="w-100" src="{{ asset('uploads/property/' . $property_attachments->attachment) }}"
                                                            alt="">
                                                    </a>

                                                    @if ($propertyes->is_featured == 1)
                                                        <div class="list-tag fz12">
                                                            <span class="flaticon-electricity me-2"></span>FEATURED</div>
                                                    @endif
                                                    @if ($propertyes->is_rent_type == 1)
                                                        <div class="list-tag2 fz12">FOR SALE</div>
                                                    @elseif ($propertyes->is_rent_type == 2)
                                                        <div class="list-tag2 fz12">FOR RENT</div>
                                                    @endif

                                                    <div class="list-meta">

                                                        <div class="icons">
                                                            @php
                                                                $wish = DB::table('wishlishts')
                                                                    ->where('product_id', $propertyes->id)
                                                                    ->where('user_id', Auth::id())
                                                                    ->get();
                                                            @endphp

                                                            @if ($wish->isNotEmpty())
                                                                <a href="javascript:void(0)"
                                                                    data-id="{{ $propertyes->id }}"
                                                                    class="addTowishlisht like-icon rounded-circle"><i
                                                                        class="fa-solid fa-heart"
                                                                        style="color:red"></i></a>
                                                            @else
                                                                @if (Auth::check())
                                                                    <a href="javascript:void(0)"
                                                                        data-id="{{ $propertyes->id }}"
                                                                        class="addTowishlisht like-icon rounded-circle"><i
                                                                            class="fa-solid fa-heart"></i></a>
                                                                @else
                                                                    <a href="javascript:void(0)"
                                                                        data-id="{{ $propertyes->id }}"
                                                                        data-bs-toggle="modal" data-bs-target="#login"
                                                                        class="addTowishlisht like-icon rounded-circle"><i
                                                                            class="fa-solid fa-heart"></i></a>
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="list-content">
                                                    <?php
                                                        $priceval  = $propertyes->price;
                                                        $newpricevallue = (int)$priceval;
                                                    ?> 
                                                    <div class="list-price mb-2">SRD {{ $newpricevallue }}</div>
                                                    <h6 class="list-title"><a href="{{ url('details/' .base64_encode($propertyes->id)) }}">{{ $propertyes->title }}</a>
                                                    </h6>
                                                    <p class="list-text">{!! Str::limit($propertyes->address, 25, ' ...') !!}</p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                       
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Partners -->
    {{-- <section class="our-partners">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 wow fadeInUp">
                    <div class="main-title text-start text-md-center">
                        <h2 class="title">Our Partners</h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="dots_none nav_none slider-dib-sm slider-6-grid owl-carousel owl-theme wow fadeInUp">
                        @foreach ($ourPerents as $ourPerent)
                            <div class="item">
                                <div class="partner_item">
                                    <img class="wa m-auto" src="{{ asset('uploads/blogs/' . $ourPerent->image) }}"
                                        alt="1.png">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="pt30 pb-0">
        <div class="cta-banner3 julia-banner bgc-thm-light mx-auto maxw1600 pt100 pt60-lg pb90 pb60-lg bdrs24 position-relative overflow-hidden">
            <div class="container">
                @foreach ($findSellings as $sellings)
                    <div class="row">
                        <div class="col-md-6 col-lg-5 pl30-md pl15-xs wow fadeInRight" data-wow-delay="500ms">
                            <div class="mb30">
                                <h2 class="title text-capitalize">{{$sellings->title ?? ''}}</h2>
                            </div>
                            @if($sellings->property_types!=NULL)
                                @php
                                    $input_item_data = $sellings->property_types;
                                    $input_item_data_array =  json_decode($input_item_data, true);
                                    
                                @endphp
                                 @if($input_item_data_array != null)
                                    @foreach ($input_item_data_array as $key => $input)
                                    <?php 
                                        $key_val = array_keys($input);
                                        $input_val = array_values($input);
                                    ?>
                                    <div class="why-chose-list style2">
                                        <div class="list-one d-flex align-items-start mb30">
                                            <span class="list-icon flex-shrink-0 flaticon-security"></span>
                                            <div class="list-content flex-grow-1 ml20">
                                                <h6 class="mb-1">{{$key_val[0]}}</h6>
                                                <p class="text mb-0 fz15">{{$input_val[0]}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                @endif
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

<br>
    <!------New-Slider------>
    @if(count($addbasic) > 0)
        <section class="new-slider1" style="position: relative;">
            <div class="container">
                <div id="demo4" class="carousel slide" data-bs-ride="carousel">
                <!-- The slideshow/carousel -->
                <div class="carousel-inner new-cinner">
                    @foreach ($addbasic as $key=> $add)
                        @php
                            $PackageType1 = DB::table('payments')
                                            ->where('user_id', $add->user_id)
                                            ->where('package_id', $add->package_id)
                                            ->first();

                            $createdAt = date('Y-m-d H:i:s', strtotime($add->created_at));
                            $currentDate = time(); // This gets the current timestamp
                            $daysDifference = floor(($currentDate - strtotime($createdAt)) / (60 * 60 * 24));
                        @endphp

                        @if (isset($PackageType1) &&($PackageType1->package_name == 'Basic' || $PackageType1->package_id == '1') && $daysDifference <= 30)
                            <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                                <img src="{{asset('/uploads/package/'.$add->image)}}" alt="Los Angeles" class="d-block" style="width:100%">
                                <div class="sellview">
                                    <h6>{!! $add->description ?? '' !!}</h6>
                                    <a class="ud-btn btn-thm mx-2 mx-xl-4 sell-btns sel_v" href="{{ $add->url }}" target="_blank">Shop Now<i class="fal fa-arrow-right-long"></i></a>
                                </div>
                            </div>
                        @endif    
                    @endforeach
                </div>
                <!-- Left and right controls/icons -->
                <button class="carousel-control-prev" type="button" data-bs-target="#demo4" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#demo4" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                </button>
                </div>
            </div>
        </section>
    @endif
    <!----New-Slider---->


    <!-- Explore Apartment -->
    <section class="mb35 mb0-md pb30-md exp-section blog-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto wow fadeInUp" data-wow-delay="00ms">
                    <div class="main-title text-start text-md-center">
                        <h2 class="title">From Our Blog</h2>

                    </div>
                </div>
            </div>
            <div class="row wow fadeInUp" data-wow-delay="300ms">
                @if (count($blogs) > 0)
                    @foreach ($blogs as $blog)
                        <div class="col-sm-6 col-lg-4">
                            <div class="blog-style1 all-section-img">
                                <a href="{{ url('blog-details/' . $blog->slug) }}">
                                    <div class="blog-img"><img class="w-100"
                                            src="{{ asset('uploads/blogs/' . $blog->image) }}" alt=""></div>
                                    <div class="blog-content">
                                        {{-- <div class="date">
                                                <span class="month">{{ $carbon::parse($blog->created_at)->format('M') }}</span>    
                                                <span class="day">{{ $carbon::parse($blog->created_at)->format('d') }}</span>
                                            </div> --}}
                                        <a class="tag" href="javascript:void(0)">{{ $blog->small_title }}</a>
                                        <h6 class="title mt-1">
                                            <a href="{{ url('blog-details/' . $blog->slug) }}">{{ $blog->title }}</a>
                                        </h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <a href="{{ route('blog') }}" class="btn btn-primary btn-sm"
                style="color: white; margin-left: 598px; width: 100px;">More</a>
        </div>
    </section>

    <!-- <section class="our-cta p-0">
        <div class="cta-banner bgc-thm-light mx-auto maxw1600 pt90 pt60-md pb90 pb60-md bdrs12 position-relative mx20-lg px20-md">
            <div class="img-box-5">
                <img class="img-1 bounce-y" src="{{ asset('front/images/about/element-4.png') }}" alt="">
            </div>
            <div class="container">
                @foreach ($getDreame as $item)
                    <div class="row">
                        <div class="col-lg-7 col-xl-6 wow fadeInLeft">
                            <div class="cta-style3">
                                <h2 class="cta-title">{{ $item->title ?? ''}}</h2>
                                <p class="cta-text mb25">{!! $item->description ?? ''!!}</p>
                                @if (Auth::check())
                                @else
                                    <a href="javascript:" class="ud-btn btn-dark" data-bs-toggle="modal" data-bs-target="#register"> Register</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-5 col-xl-4 offset-xl-2 d-none d-lg-block wow fadeIn" data-wow-delay="300ms">
                            <div class="cta-img">
                                <img src="{{asset('/uploads/dream/'.$item->image)}}" alt="">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section> -->

    @include('front.master.include.footer')

@endsection
@push('custom-scripts')
    <script>
        $(document).ready(function() {
            
            //filter category
            $(document).on('click', '.categoryesFilter', function(event) {
                var id = $(this).attr('data-id');

                $.ajax({
                    type: 'GET',
                    url: "{{ url('/categorye-filter') }}",
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        console.log(response);
                        $('#categoryes').replaceWith(response);
                    },
                });
            });

            // added sell_login
            $(document).on('click', '#sell_login', function(event) {
                $('#login').show();
            });

            // addedd login
            $(document).on('click', '#loginfrm', function(event) {
                $('#register').show();
            });

            // addedd register
            $(document).on('click', '#registerfrm', function(event) {
                $('#login').show();
            });

            //added to wishlisht
            $(document).on('click', '.addTowishlisht', function(event) {
                var current = $(this);
                var id = $(this).attr('data-id');

                $.ajax({
                    type: 'GET',
                    url: "{{ url('/add-To-wishlisht') }}",
                    data: {
                        'id': id
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.success == true) {
                            toastr.success('Property Added To Wishlist')
                            $(current).html('<i class="fa-solid fa-heart" style="color:#E52D27"></i>');
                            window.setTimeout(function() {
                              //  window.location.href = "{{url('/')}}";
                            }, 2000);

                        } else {
                            window.setTimeout(function() {
                                swal({
                                    icon: 'error',
                                    title: 'Already added property in wishlist',
                                    text: 'Something went wrong!',
                                })
                            }, 2000);
                        }
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });

            // property rent serarcs 
            // $(document).on('click', '#categoryes_id', function(event) {
            //     // var value = $(this).val();
            //     var categoryes_id  = $("#categoryes_id option:selected").val();
            //     alert(categoryes_id);
            //     var fore_rent  = $('#fore_rent').val();
            //     $('#fore_rent1').val(fore_rent);

            //         $.ajax({
            //             type: 'GET',
            //             url: "{{ route('product-filter') }}",
            //             data: {
            //                  'title': value ,
            //                 //'categorye': value ,
            //                 'categoryes_id':categoryes_id,
            //                 },
            //             success: function(data) {
            //                 console.log(data);
            //                 $('#product_list').html(data);
            //             },
            //         });
                
            // });

            // $(document).on('click','.row_title',function(){
            //     var value1 = $(this).text();
            //     $('#serach').val(value1);
            //     $('#product_list').html("");
            // });

            // //property type sale
            // $('#serachsale').on('keyup',function(){
            //     var value = $(this).val();
            //     //var categoryes_id = $("#categoryes_id_sale option:selected").val();
            //     var fore_sale  = $('#fore_sale').val();
            //     $('#fore_sale1').val(fore_sale);
                
            //         $.ajax({
            //             type: 'GET',
            //             url: "{{ route('product-filter') }}",
            //             data: {
            //                 // 'title': value ,
            //                 'categorye':value
            //             },
            //             success: function(data) {
            //                 console.log(data);
            //                 $('#product_list1').html(data);
            //             },
            //         });
            // });

            // $(document).on('click','.row_title',function(){
            //     var value1 = $(this).text();
            //     $('#serachsale').val(value1);
            //     $('#product_list1').html("");
            // });

        });
    </script>
    <style>
        .fa-heart {
            color: gray;
        }
    </style>
    {{-- <script>
        $(".hearts").click(function(){
        $(".hearts").css("color", "red");
        });
    </script>  
    <script>
        $(".heartm").click(function(){
        $(".heartm").css("color", "red");
        });
    </script>
    <script>
        $(".heartp").click(function(){
        $(".heartp").css("color", "red");
        });
    </script>
    <script>
        $(".hearta").click(function(){
        $(".hearta").css("color", "red");
        });
    </script> --}}
@endpush
