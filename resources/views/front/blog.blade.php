@extends('front.master.index')

@section('title','Blog')

@section('content')

@include('front.master.include.common_sidebar')

@inject('carbon', 'Carbon\Carbon')
<div class="body_content">
    <!-- Blog Section Area -->
    <!-- UI Elements Sections -->
    <section class="breadcumb-section2 p-0">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
          <div class="breadcumb-style1">
                <h2 class="title text-center text-white">Blog</h2>
                <div class="breadcumb-list text-center text-white">
                  <a class="text-white" href="{{route('home')}}">Home</a>
                  <a class="text-white" href="#">Blog</a>
                </div>
              </div>
          </div>
        </div>
      </div>
</section>

    <!-- <section class="breadcumb-section b-sec bgc-f7">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcumb-style1">
              <h2 class="title">Blog</h2>
              <div class="breadcumb-list">
                <a href="{{route('home')}}">Home</a>
                <a href="#">Blog</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> -->
<!-- Blog Section Area -->
    <section class="our-blog pt-0 bgc-f7 julia-blog">
      <div class="container">
        {{-- <div class="main-title text-start text-md-center">
          <h2 class="title pt-5">From Our Blog</h2>
          <p class="paragraph">Aliquam lacinia diam quis lacus euismod</p>
        </div> --}}
        
        <div class="row wow fadeInUp" data-wow-delay="300ms">
          <div class="col-xl-12">
            <div class="navpill-style1">
              
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade fz15 show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                  <div class="row">
                    @if(count($blogs)>0)
                      @foreach ($blogs as $blog)
                          <div class="col-sm-6 col-lg-4">
                              <a href="{{url('blog-details/'.$blog->slug)}}">
                                  <div class="blog-style1">
                                      <div class="blog-img"><img class="w-100" src="{{ asset('uploads/blogs/'.$blog->image) }}" alt=""></div>
                                      <div class="blog-content">
                                      {{-- <div class="date">
                                          <span class="month">{{ $carbon::parse($blog->created_at)->format('M') }}</span>    
                                          <span class="day">{{ $carbon::parse($blog->created_at)->format('d') }}</span>
                                      </div> --}}
                                      <a class="tag" href="#">{{$blog->small_title}}</a>
                                      <h6 class="title mt-1">
                                          <a href="{{url('blog-details/'.$blog->slug)}}">{{$blog->title}}</a>
                                      </h6>
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
        <div class="row">
          <div class="mbp_pagination text-center">
            <ul class="page_navigation">
              {{$blogs->links()}}
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