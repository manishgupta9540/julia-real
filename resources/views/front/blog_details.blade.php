@extends('front.master.index')

@section('content')

@include('front.master.include.common_sidebar')

@inject('carbon', 'Carbon\Carbon')
<div class="body_content">
    <!-- Blog Section Area -->
    <section class="our-blog pt50 bgc-f7">
      @if(!empty($blogs_details))

        <div class="container">
          <div class="row wow fadeInUp" data-wow-delay="100ms">
            <div class="col-lg-12">
              <h2 class="blog-title" style="margin-top: 6%;">{{$blogs_details->title}}</h2>
              <div class="blog-single-meta">
                <div class="post-author d-sm-flex align-items-center">
                  <img class="mr10" src="{{asset('front/images/blog/author-1.png')}}" alt=""><a class="pr15 bdrr1" href="#">Leslie
                    Alexander</a><a class="ml15 pr15 bdrr1" href="#">Home Improvement</a><a class="ml15"
                    href="#">{{ $carbon::parse($blogs_details->created_at)->format('F d, Y') }}</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="mx-auto maxw1600 mt30 wow fadeInUp" data-wow-delay="300ms">
          <div class="row">
            <div class="col-lg-12">
              <div class="large-thumb"><img class="w-100" src="{{ asset('uploads/blogs/'.$blogs_details->image) }}" alt=""></div>
            </div>
          </div>
        </div>
        <br><br>
        <div class="container">
          <div class="roww wow fadeInUp" data-wow-delay="500ms">
            <div class="col-xl-8 offset-xl-2">
              {!! $blogs_details->description!!}
            </div>
          </div>
          
          {{-- <div class="roww wow fadeInUp" data-wow-delay="500ms">
            <div class="col-xl-8 offset-xl-2">
              <div class="ui-content mt40 mb60">
                <h4 class="mb10">1. Reduce the clutter</h4>
                <p class="mb25 ff-heading">It doesn’t matter how organized you are — a surplus of toys will always
                  ensure your house is a mess waiting to happen. Fortunately, getting kids on board with the idea of
                  ditching their stuff is a lot easier than it sounds.</p>
                <p class="ff-heading">The trick is to make it an opportunity for them to define themselves and their
                  interests. Encourage kids to make a pile of ”baby toys” to donate, and have them set aside any toys
                  that no longer interest them, such as action figures from a forgotten TV show. Separating these toys
                  will help them appreciate how much they’ve grown and rediscover the toys they love.</p>
              </div>
              <div class="blockquote-style1 mb60">
                <blockquote class="blockquote">
                  <p class="fst-italic fz15 fw500 ff-heading">Aliquam hendrerit sollicitudin purus, quis rutrum mi
                    accumsan nec. Quisque bibendum orci ac nibh facilisis, at malesuada orci congue.</p>
                  <h6 class="quote-title">Luis Pickford</h6>
                </blockquote>
              </div>
              <div class="ui-content">
                <h4 class="title">2. Choose toys wisely</h4>
              </div>
              <div class="row">
                <div class="col-auto">
                  <div class="ui-content">
                    <div class="list-style1">
                      <ul>
                        <li><i class="far fa-check text-thm3 bgc-thm3-light"></i>Become a UI/UX designer.</li>
                        <li><i class="far fa-check text-thm3 bgc-thm3-light"></i>You will be able to start earning money
                          Figma skills.</li>
                        <li><i class="far fa-check text-thm3 bgc-thm3-light"></i>Build a UI project from beginning to
                          end.</li>
                        <li><i class="far fa-check text-thm3 bgc-thm3-light"></i>Work with colors & fonts.</li>
                        <li><i class="far fa-check text-thm3 bgc-thm3-light"></i>You will create your own UI Kit.</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <div class="ui-content">
                    <div class="list-style1">
                      <ul>
                        <li><i class="far fa-check text-thm3 bgc-thm3-light"></i>Build & test a complete mobile app.
                        </li>
                        <li><i class="far fa-check text-thm3 bgc-thm3-light"></i>Learn to design mobile apps & websites.
                        </li>
                        <li><i class="far fa-check text-thm3 bgc-thm3-light"></i>Design 3 different logos.</li>
                        <li><i class="far fa-check text-thm3 bgc-thm3-light"></i>Create low-fidelity wireframe.</li>
                        <li><i class="far fa-check text-thm3 bgc-thm3-light"></i>Downloadable exercise files.</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 mt40">
                <img src="{{asset('front/images/blog/blog-single-2.jpg')}}" alt="" class="bdrs12 post-img-2 w-100">
              </div>
              <div class="ui-content mt40 mb30">
                <h4 class="mb10">3.Leave some toys out of reach</h4>
                <div class="custom_bsp_grid">
                  <ul class="list-style-type-bullet p-0 ml20">
                    <li>We do not require any previous experience or pre-defined skills to take this course. A great
                      orientation would be enough to master UI/UX design.</li>
                    <li>A computer with a good internet connection.</li>
                    <li>Adobe Photoshop (OPTIONAL)</li>
                  </ul>
                </div>
              </div>
            </div>
          </div> --}}
        </div>
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
    </section>
  </div>

@include('front.master.include.footer')
@endsection