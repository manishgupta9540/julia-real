@extends('front.master.index')

@section('title','FAQ')

@section('content')
@include('front.master.include.common_sidebar')
<section class="breadcumb-section2 p-0">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
          <div class="breadcumb-style1">
                <h2 class="title text-center text-white">Frequently Asked Questions</h2>
                <div class="breadcumb-list text-center text-white">
                  <a class="text-white" href="{{route('home')}}">Home</a>
                  <a class="text-white" href="#">For Rent</a>
                </div>
              </div>
          </div>
        </div>
      </div>
</section>
<!-- <div class="body_content">
    <section class="breadcumb-section faq-sec-ps">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="breadcumb-style1">
                <h2 class="title">Frequently Asked Questions</h2>
                <div class="breadcumb-list">
                  <a href="{{route('home')}}">Home</a>
                  <a href="#">For Rent</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> -->
      <!-- FAQ Section Area -->
      <section class="our-faq pt-0 faq-section">
        <div class="container">
          <div class="row wow fadeInUp" data-wow-delay="300ms">
            <div class="col-lg-12">
              <div class="ui-content">
                <h4 class="title pt-5">Question About Selling</h4>
                <div class="accordion-style1 faq-page mb-4 mb-lg-5">
                  <div class="accordion" id="accordionExample">
                    @if(count($faqs)>0)
                      @foreach ($faqs as $key =>$faq)
                        <div class="accordion-item ">
                          <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$key+1}}" aria-expanded="false" aria-controls="collapseOne">{{$faq->title}}</button>
                          </h2>
                          <div id="collapseOne{{$key+1}}" class="accordion-collapse collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="accordion-body">{!! $faq->description !!}</div>
                          </div>
                        </div>
                        @endforeach
                    @endif
                  </div>
                   
                </div>
              </div>
              <div class="ui-content">
                <h4 class="title">Question About Renting</h4>
                <div class="accordion-style1 faq-page mb-4 mb-lg-5">
                  <div class="accordion" id="accordionExample2">
                    @if(count($faqsrent)>0)
                      @foreach ($faqsrent as $key =>$faqre)
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive{{$key+1}}" aria-expanded="true" aria-controls="collapseFive">{{$faqre->title}}</button>
                          </h2>
                          <div id="collapseFive{{$key+1}}" class="accordion-collapse collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
                            <div class="accordion-body">{!! $faqre->description !!}</div>
                          </div>
                        </div>
                      @endforeach
                    @endif
                   
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <!-- Our CTA --> 
      {{-- <section class="our-cta pt0 pb-0">
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