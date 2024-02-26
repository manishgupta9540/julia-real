@extends('front.master.index')
@section('title','How we work')
@section('content')
@include('front.master.include.common_sidebar')
<div class="body_content">
    <!-- UI Elements Sections -->
    <section class="breadcumb-section2 p-0">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <div class="breadcumb-style1">
              @if (count($howwework) > 0)
                @foreach ($howwework as $how)
                  <h2 class="title text-white">{{ $how->title }}</h2>
                @endforeach
              @endif
              
             
              <div class="breadcumb-list">
                <a class="text-white" href="#">Home</a>
                <a class="text-white" href="#">How We Work</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="py-5 border-bottoms">
        
      <div class="axil-checkout-area axil-section-gap foot-pages">
          <div class="container mt-5 pt-5 advertisement-container">
              <div class="row julias-rows">
                  <div class="col-md-12 col-12 p-5 julias-cols-add">
                    @if (count($howwework) > 0 )
                      @foreach ($howwework as $how)
                        <p>{!! $how->description !!}</p>
                      @endforeach
                    @else
                      <div class="row">
                        <div class="no-up">
                            <div class="noenquery for-margin" style="text-align: center">
                                <img src="{{asset('front/no-data.gif')}}" alt="Girl in a jacket">
                            </div>
                            <div style="text-align:center;padding-top: 25px;">
                                <h2 class="noupcom">There is no post available.</h2>
                            </div>
                        </div>
                      </div>
                    @endif
                   
            </div>
        </div>
          
      </div>
      
</section>
    {{-- <section class="pb90 pb10-md pt-5">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 m-auto wow fadeInUp" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInUp;">
            <div class="main-title text-center">
              <h2 class="title">See how House for Sale can help</h2>
              <p class="paragraph">Aliquam lacinia diam quis lacus euismod</p>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-lg-4 wow fadeInLeft" data-wow-delay="00ms" style="visibility: visible; animation-delay: 0ms; animation-name: fadeInLeft;">
            <div class="iconbox-style2 text-center">
              <div class="icon"><img src="{{asset('front/images/icon/property-buy.svg')}}" alt=""></div>
              <div class="iconbox-content">
                <h4 class="title">Buy a property</h4>
                <p class="text">Nullam sollicitudin blandit eros eu pretium. Nullam maximus ultricies auctor.</p>
                <a href="#" class="ud-btn btn-white2">Find a home<i class="fal fa-arrow-right-long"></i></a>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 wow fadeInUp" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInUp;">
            <div class="iconbox-style2 active text-center">
              <div class="icon"><img src="{{asset('front/images/icon/property-sell.svg')}}" alt=""></div>
              <div class="iconbox-content">
                <h4 class="title">Sell a property</h4>
                <p class="text">Nullam sollicitudin blandit eros eu pretium. Nullam maximus ultricies auctor.</p>
                <a href="#" class="ud-btn btn-white2">Place an ad<i class="fal fa-arrow-right-long"></i></a>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4 wow fadeInRight" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInRight;">
            <div class="iconbox-style2 text-center">
              <div class="icon"><img src="{{asset('front/images/icon/property-rent.svg')}}" alt=""></div>
              <div class="iconbox-content">
                <h4 class="title">Rent a property</h4>
                <p class="text">Nullam sollicitudin blandit eros eu pretium. Nullam maximus ultricies auctor.</p>
                <a href="#" class="ud-btn btn-white2">Find a rental<i class="fal fa-arrow-right-long"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="pb90 pb30-md pt-0">
      <div class="container">
        <div class="row">
          <div class="col-xl-6 wow fadeInUp" data-wow-delay="100ms" style="visibility: visible; animation-delay: 100ms; animation-name: fadeInUp;">
            <div class="about-box2">
              <h4 class="title">The New Way to Find <br class="d-none d-xl-block"> Your Home</h4>
              <p class="text fz15">From as low as $10 per day with <br class="d-none d-xl-block"> limited time offer discounts.</p>
              <a href="#" class="ud-btn btn-thm">How İt Works<i class="fal fa-arrow-right-long"></i></a>
              <img class="img-1" src="{{asset('front/images/about/home6-about-1.png')}}" alt="">
            </div>
          </div>
          <div class="col-xl-6 wow fadeInUp" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInUp;">
            <div class="row">
              <div class="col-sm-6">
                <div class="iconbox-style6">
                  <span class="icon flaticon-search-1"></span>
                  <h3 class="title mb-1">01</h3>
                  <h6 class="subtitle">Search Your Dream Home</h6>
                  <p class="iconbox-text">Get ready to launch your real estate website without...</p>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="iconbox-style6">
                  <span class="icon flaticon-chat"></span>
                  <h3 class="title mb-1">02</h3>
                  <h6 class="subtitle">Search Your Dream Home</h6>
                  <p class="iconbox-text">Get ready to launch your real estate website without...</p>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="iconbox-style6">
                  <span class="icon flaticon-bird-house"></span>
                  <h3 class="title mb-1">03</h3>
                  <h6 class="subtitle">Search Your Dream Home</h6>
                  <p class="iconbox-text">Get ready to launch your real estate website without...</p>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="iconbox-style6">
                  <span class="icon flaticon-house-1"></span>
                  <h3 class="title mb-1">04</h3>
                  <h6 class="subtitle">Search Your Dream Home</h6>
                  <p class="iconbox-text">Get ready to launch your real estate website without...</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
     <!-- Our Funfact -->
    <section class="bgc-thm-light pb90 pb30-md">
      <img class="funfact-floating-img1 wow zoomIn d-none d-lg-block" src="{{asset('front/images/resource/h7-bg-1.png')}}" alt="">
      <img class="funfact-floating-img2 wow zoomIn d-none d-lg-block" src="{{asset('front/images/resource/h7-bg-2.png')}}" alt="">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-md-6 col-xl-5 wow fadeInRight" data-wow-delay="100ms">
            <div class="cta-style6 mb30-sm">
              <h2 class="cta-title mb25">More than 20 Years of Real <br class="d-none d-lg-block"> Estate Experience</h2>
              <p class="cta-text fz15 mb25">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed <br class="d-none d-lg-block"> do eiusmod tempor incididunt.</p>
              <a href="#" class="ud-btn btn-dark bdrs0">Get Started <i class="fal fa-arrow-right-long"></i></a>
            </div>
          </div>
          <div class="col-md-6 col-xl-6 offset-xl-1 wow fadeInLeft" data-wow-delay="300ms">
            <div class="row align-items-center">
              <div class="col-sm-6">
                <div class="funfact-style1 text-center">
                  <ul class="ps-0 mb-0 d-flex justify-content-center">
                    <li><div class="timer title mb15">2,500</div></li>
                    <li><span>+</span></li>
                  </ul>
                  <p class="fz15 dark-color">Listing for <br>sale</p>
                </div>
                <div class="funfact-style1 text-center">
                  <ul class="ps-0 mb-0 d-flex justify-content-center">
                    <li><div class="timer title mb15">900</div></li>
                    <li><span>+</span></li>
                  </ul>
                  <p class="fz15 dark-color">Property <br>sold</p>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="funfact-style1 text-center">
                  <ul class="ps-0 mb-0 d-flex justify-content-center">
                    <li><div class="timer title mb15">1,350</div></li>
                    <li><span>+</span></li>
                  </ul>
                  <p class="fz15 dark-color">Listing for <br>rent</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> --}}

    <section>
      <div class="container">
        @foreach ($whyChooses as $choose)  
          <div class="row align-items-md-center wow fadeInRight" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInRight;">
            <div class="col-md-6 col-lg-6">
              <div class="position-relative mb30-md howwework-img">
                <img class="w-100" src="{{ asset('uploads/why/' . $choose->image) }}" alt="">
                {{-- <a href="#">
                  <div class="iconbox-style5 d-flex align-items-center">
                    <span class="icon flaticon-home flex-shrink-0"></span>
                    <div class="iconbox-content flex-shrink-1 ms-2">
                      <p class="text mb-0">Total Rent</p>
                      <h4 class="title mb-0">4,382 Unit</h4>
                    </div>
                  </div>
                </a> --}}
              </div>
            </div>
            <div class="col-md-6 col-lg-5 offset-lg-1 wow fadeInLeft" data-wow-delay="500ms" style="visibility: visible; animation-delay: 500ms; animation-name: fadeInLeft;">
              <div class="main-title2">
                <h2 class="title">Why Choose Us</h2>
                {{-- <p class="paragraph fz15">{{$choose->description}}</p> --}}
              </div>

              <div class="why-chose-list">

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

                {{-- <div class="list-one d-flex align-items-start mb30">
                  <span class="list-icon flex-shrink-0 flaticon-keywording"></span>
                  <div class="list-content flex-grow-1 ml20">
                    <h6 class="mb-1">Mortgage Services</h6>
                    <p class="text mb-0 fz15">Nullam sollicitudin blandit eros eu pretium. Nullam maximus ultricies auctor.</p>
                  </div>
                </div>
                <div class="list-one d-flex align-items-start">
                  <span class="list-icon flex-shrink-0 flaticon-investment"></span>
                  <div class="list-content flex-grow-1 ml20">
                    <h6 class="mb-1">Currency Services</h6>
                    <p class="text mb-0 fz15">Nullam sollicitudin blandit eros eu pretium. Nullam maximus ultricies auctor.</p>
                  </div>
                </div> --}}

              </div>
            </div>
          </div>
        @endforeach
      </div>
    </section>

    {{-- <section class="our-cta pb-0 pt-0">
      <div class="cta-banner bgc-f7 mx-auto maxw1600 pt120 pb120 pt60-md pb60-md bdrs12 position-relative mx20-lg">
        <div class="img-box-5">
          <img class="img-1 spin-right" src="{{asset('front/images/about/element-1.png')}}" alt="">
        </div>
        <div class="img-box-6">
          <img class="img-1 spin-left" src="{{asset('front/images/about/element-1.png')}}" alt="">
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
    <!-- The Login Modal -->
{{-- <div class="modal" id="login">
  <div class="modal-dialog">
    <div class="modal-content">

      <!--Login Modal Header -->
      <div class="modal-header">
        <h2 class="modal-title">To Login</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!--Login Modal body -->
      <div class="modal-body">
          <label for="email" class="lab1">Email</label>
          <input type="email" name="email" id="email" class="w-100 rounded-2">
          <label for="password" class="lab1 mt-3">Password</label><br>
          <input type="password" name="password" id="password" class="w-100 rounded-2">
          <input type="checkbox" name="checkbox" id="checkbox" class="rounded-2">
          <label for="checkbox">Keep me login</label>
          <a href="" class="float-end text-decoration-none anc1">Lost your password?</a>
          <a href=""><button class="btn w-100 rounded-4 mt-3"><b>Login</b></button></a>
          <p class="text-center or fortest mt-3">Or</p>
          <a href=""><button class="btn w-100 rounded-pill bt1"><i class="fa-brands fa-google float-start"></i><b>Continue Google</b></button></a>
          <a href=""><button class="btn w-100 mt-3 mb-2 rounded-pill bt2"><i class="fa-brands fa-facebook-f float-start"></i><b>Continue Facebook</b></button></a>
      </div>
      <div class="modal-footer justify-content-center pt-1 pb-0">
          <p class="text-center p1">Not signed up?<a href="" class="anc1"><b> Create an account.</b></a></p>   
      </div>
    </div>
  </div>
</div>

<!-- The Register Modal -->
<div class="modal" id="register">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Register Modal Header -->
      <div class="modal-header">
        <h2 class="modal-title">To Register</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Register Modal body -->
      <div class="modal-body">
          <p class="para">Create your account so that you can log in to House for Sale in business and manage your data.</p>
          <label for="name" class="lab1">First Name</label>
          <input type="text" name="name" id="name" class="w-100 rounded-2">
          <label for="lname" class="lab1 mt-3">Last Name</label><br>
          <input type="text" name="lname" id="lname" class="w-100 rounded-2">
          <label for="email" class="lab1 mt-3">E-mail Address</label><br>
          <input type="email" name="email" id="email" class="w-100 rounded-2">
          <div class="d-flex df">
          <input type="checkbox" name="checkbox" id="checkbox" class="rounded-2 align-self-start m-1"> 
          <label for="" class="para"> I want to register for news and inspiration from House for Sale, partly based on my profile</label>
        </div>
          <a href=""><button class="btn w-100 rounded-4 mt-3"><b>To Register</b></button></a>
          <p class="para m-0">By signing up you agree to our <a href="" class="text-decoration-none">Terms of Use</a>. 
            Our <a href="" class="text-decoration-none">Privacy Policy</a> applies.</p>
      </div>
      <div class="modal-footer justify-content-center pt-1 pb-0">
           <p class="para1 text-center">Already registered with Julia? <a href="" class="text-decoration-none"><b>Log in here.</b></a></p>
      </div>
    </div>
  </div>
</div> --}}

@include('front.master.include.footer')
@endsection