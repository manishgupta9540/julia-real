@extends('front.master.index')

@section('title','About')

@section('content')

@include('front.master.include.common_sidebar')
<!-- Menu In Hiddn SideBar -->

<!--End Menu In Hiddn SideBar -->
<div class="body_content">
    <!-- UI Elements Sections -->
    <section class="breadcumb-section2 p-0 text-center">
      <div class="container text-white text-center">
        <div class="row">
          <div class="col-lg-12 ">
            <div class="breadcumb-style1">
              <h2 class="title text-white">{{ $abouts->title}}</h2>
              <div class="breadcumb-list text-white">
                <a class="text-white" href="{{route('home')}}">Home</a>
                <a class="text-white" href="#">About Us</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Our About Area -->
    <section class="our-about p-0 pb-0 ">
      <div class="container">
        <div class="row wow fadeInUp julias-rows" data-wow-delay="300ms">
          <!-- {{-- <div class="col-lg-6">
            <h2>{{$abouts->title}}</h2>
          </div> --}} -->
          <!-- <div class="row">
            <div class="col-md-12 col-12" style="margin-bottom: -32px;"  >
                @if($abouts->title  ?? '')
                <h2 class="text-center" style="margin: 30px;">{{$abouts->title}}</h2>
                @endif
            </div>
        </div> -->
          <div class="col-lg-12 about-12 p-5">
            <p class="text mb25">{!! $abouts->description ?? '' !!}</p>
            {{-- <p class="text mb25">It doesn’t matter how organized you are — a surplus of toys will always ensure your house is a mess waiting to happen. Fortunately, getting kids on board with the idea of ditching their stuff is a lot easier than it sounds.</p>
            <p class="text mb55">Maecenas quis viverra metus, et efficitur ligula. Nam congue augue et ex congue, sed luctus lectus congue. Integer convallis condimentum sem. Duis elementum tortor eget condimentum tempor. Praesent sollicitudin lectus ut pharetra pulvinar.</p> --}}
            {{-- <div class="row">
              <div class="col-sm-6">
                <div class="why-chose-list style3">
                  <div class="list-one mb30">
                    <span class="list-icon flex-shrink-0 flaticon-garden mb20"></span>
                    <div class="list-content flex-grow-1">
                      <h6 class="mb-1">Modern Villa</h6>
                      <p class="text mb-0 fz14">Nullam sollicitudin blandit <br class="d-none d-sm-block"> Nullam maximus.</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="why-chose-list style3">
                  <div class="list-one mb30">
                    <span class="list-icon flex-shrink-0 flaticon-secure-payment mb20"></span>
                    <div class="list-content flex-grow-1">
                      <h6 class="mb-1">Secure Payment</h6>
                      <p class="text mb-0 fz14">Nullam sollicitudin blandit <br class="d-none d-sm-block"> Nullam maximus.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div> --}}
          </div>
        </div>
      </div>
    </section>
    <!-- About Banner -->
    <section class="our-about pt-0 my-about">
      <div class="container">
        <div class="row wow fadeInUp" data-wow-delay="300ms">
          <div class="col-lg-12">
            <div class="about-page-img">
              <img class="w-100" src="images/about/about-page-banner.jpg" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
     <!-- CTA Banner -->
    <section class="pt-0">
      <div class="cta-banner3 bgc-thm-light mx-auto maxw1600 pt100 pt60-lg pb90 pb60-lg bdrs24 position-relative overflow-hidden mx20-lg">
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
    <!-- Our Partners --> 
    {{-- <section class="our-partners p-0">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 wow fadeInUp">
            <div class="main-title text-start text-md-center">
                <h2 class="title">Our Partners</h2>
            </div>
        </div>
          <div class="col-lg-12">
            <div class="dots_none nav_none slider-dib-sm slider-6-grid owl-carousel owl-theme wow fadeInUp" data-wow-delay="300ms">
              @foreach ($ourPerents as $ourPerent)
                  <div class="item">
                      <div class="partner_item">
                          <img class="wa m-auto" src="{{ asset('uploads/blogs/' . $ourPerent->image) }}" alt="1.png">
                      </div>
                  </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </section> --}}
    <br>
     <!-- Our CTA --> 
    {{-- <section class="our-cta pb-0">
      <div class="cta-banner bgc-f7 mx-auto maxw1600 pt120 pb120 pt60-md pb60-md bdrs12 position-relative mx20-lg">
        <div class="img-box-5">
          <img class="img-1 spin-right" src="images/about/element-1.png" alt="">
        </div>
        <div class="img-box-6">
          <img class="img-1 spin-left" src="images/about/element-1.png" alt="">
        </div>
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-7 col-xl-6 wow fadeInLeft">
              <div class="cta-style1">
                <h2 class="cta-title">Need help? Talk to our expert.</h2>
                <p class="cta-text mb-0">Talk to our experts or Browse through more properties.</p>
              </div>
            </div>
            <div class="col-lg-5 col-xl-6 wow fadeInRight" data-wow-delay="300ms">
              <div class="cta-btns-style1 d-block d-sm-flex align-items-center justify-content-lg-end">
                <a href="{{route('contact')}}" class="ud-btn btn-transparent mr30 mr0-xs">Contact Us<i class="fal fa-arrow-right-long"></i></a>
                <a href="#" class="ud-btn btn-dark"><span class="flaticon-call vam pe-2"></span>920 851 9087</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> --}}
 



@include('front.master.include.footer')

@endsection