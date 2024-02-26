@extends('front.master.index')
@section('title','Help and contacts')
@section('content')
@include('front.master.include.common_sidebar')
<section class="p-0 helpcumb">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcumb-style1 help-heading">
              <h2 class="title text-white text-center">{{$data->title ?? ''}}</h2>
            </div>
          </div>
        </div>
      </div>
</section>
<section class="py-5 border-bottoms">
        <!-- Start Checkout Area  -->
        <div class="axil-checkout-area axil-section-gap">
            <div class="container">
                <div class="row julias-rows">
                    <div class="col-md-12 col-12 p-5 help-pages">
                        @if($data->title  ?? '')
                        <!-- <h2 class="text-center" style="margin: 30px;">{{$data->title}}</h2> -->
                        @endif
                    

            @if($data->description  ?? '')
                <p class="w-100">{!!$data->description!!}</p>
            @else
            </div>
                </div>
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
        <!-- End Checkout Area  -->
</section>


@include('front.master.include.footer')

@endsection