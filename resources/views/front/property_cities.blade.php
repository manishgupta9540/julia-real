@extends('front.master.index')

@section('title','Cities Listing')

@section('content')

@include('front.master.include.common_sidebar')

@inject('carbon', 'Carbon\Carbon')
<div class="body_content">
    <!-- Blog Section Area -->
    <!-- UI Elements Sections -->
    <section class="breadcumb-section b-sec bgc-f7">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcumb-style1">
              <h2 class="title">Cities</h2>
              <div class="breadcumb-list">
                <a href="{{route('home')}}">Home</a>
                <a href="#">Cities</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<!-- Blog Section Area -->
    <section class="our-blog pt-0 bgc-f7">
      <div class="container">
        <div class="main-title text-start text-md-center">
          <h2 class="title">From Our Cities</h2>
          <p class="paragraph">Aliquam lacinia diam quis lacus euismod</p>
        </div>
        
        <div class="row wow fadeInUp" data-wow-delay="300ms">
          <div class="col-xl-12">
            <div class="navpill-style1">
              
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade fz15 show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">
                        <div class="col-lg-12 wow fadeInUp" data-wow-delay="300ms">
                            <div class="property-city-slider style2 dots_none slider-dib-sm slider-6-grid vam_nav_style owl-theme owl-carousel">
                                @if(count($propertCities)>0)
                                    @foreach ($propertCities as $propertCitie)
                                        <div class="item">
                                            <a href="#">
                                                <div class="feature-style3 mb30 text-center">
                                                    <div class="feature-img rounded-circle">
                                                        <img class="w-100" src="{{ asset("uploads/cities/".$propertCitie->image) }}" alt="">
                                                    </div>
                                                    <div class="feature-content pt25">
                                                        <h6 class="title mb-1">{{$propertCitie->title}}</h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
                
              </div>
            </div>


          </div>
        </div>
        <div class="row">
          <div class="mbp_pagination text-center">
            <ul class="page_navigation">
              {{$propertCities->links()}}
              {{-- <li class="page-item">
                <a class="page-link" href="#"> <span class="fas fa-angle-left"></span></a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item active" aria-current="page">
                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
              </li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">4</a></li>
              <li class="page-item"><a class="page-link" href="#">5</a></li>
              <li class="page-item"><a class="page-link" href="#">...</a></li>
              <li class="page-item"><a class="page-link" href="#">20</a></li>
              <li class="page-item">
                <a class="page-link" href="#"><span class="fas fa-angle-right"></span></a>
              </li> --}}
            </ul>
            {{-- <p class="mt10 pagination_page_count text-center">1 – 20 of 300+ property available</p> --}}
          </div>
        </div>
      </div>
    </section>
   
  </div>


@include('front.master.include.footer')
@endsection