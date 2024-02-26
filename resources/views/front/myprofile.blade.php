@extends('front.master.index')
@section('title','My profile')
@section('content')
@include('front.master.include.common_sidebar')

<div class="dashboard_content_wrapper">

  <div class="dashboard dashboard_wrapper pr30 pr0-md">

    @include('front.master.include.sidebar')

      <div class="dashboard__main pl0-md">
        <div class="dashboard__content property-page bgc-f7">
         <div class="row align-items-center pb40">
            <div class="col-lg-12">
              <div class="dashboard_title_area">
                <h2>My Profile</h2>
                <p class="text">We are glad to see you again!</p>
              </div>
            </div>
          </div>

          @if ($message = Session::get('success'))
              <div class="col-md-12">   
                <div class="alert alert-success">
                <strong>{{ $message }}</strong> 
                </div>
              </div>
          @endif
           <div class="row">
            <div class="col-xl-12">
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <div class="col-xl-7">
                  {{-- <div class="profile-box position-relative d-md-flex align-items-end mb50">
                    <div class="profile-img position-relative overflow-hidden bdrs12 mb20-sm">
                      <img class="w-100" src="{{asset('front/images/listings/profile-1.jpg')}}" alt="">
                      <a href="#" class="tag-del" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Delete Image" aria-label="Delete Item"><span class="fas fa-trash-can"></span></a>
                    </div>
                    <div class="profile-content ml30 ml0-sm" style="position: relative;">
                      <a href="#" class="ud-btn btn-white2 mb30">Upload Profile Files<i class="fal fa-arrow-right-long"></i></a>
                      <input type="file" class="browse-file1">
                      <p class="text">Photos must be JPEG or PNG format and least 2048x768</p>
                    </div>
                  </div> --}}
                </div>
                <div class="col-lg-12">
                  <form class="form-style1" action="{{ url('/profile/update') }}" method="post" enctype="multipart/form-data">
                   @csrf
                    <div class="row">
                      <div class="col-sm-6 col-xl-4">
                        <div class="mb20">
                          <label class="heading-color ff-heading fw600 mb10">First Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="name" value="{{$users->name}}" placeholder="Your First Name">
                        </div>
                        @if ($errors->has('name'))
                        <div class="error text-danger">
                          {{ $errors->first('name') }}
                        </div>
                      @endif
                      </div>
                      <div class="col-sm-6 col-xl-4">
                        <div class="mb20">
                          <label class="heading-color ff-heading fw600 mb10">Last Name <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="last_name" value="{{$users->last_name}}" placeholder="Your Last Name">
                        </div>
                        @if ($errors->has('last_name'))
                          <div class="error text-danger">
                            {{ $errors->first('last_name') }}
                          </div>
                        @endif
                      </div>
                      <div class="col-sm-6 col-xl-4">
                        <div class="mb20">
                          <label class="heading-color ff-heading fw600 mb10">Email <span class="text-danger">*</span></label>
                          <input type="email" class="form-control" name="email" value="{{$users->email}}" value="{{$users->email}}" placeholder="Your Email">
                        </div>
                        @if ($errors->has('email'))
                          <div class="error text-danger">
                            {{ $errors->first('email') }}
                          </div>
                        @endif
                      </div>
                      <div class="col-sm-6 col-xl-4">
                        <div class="mb20">
                          <label class="heading-color ff-heading fw600 mb10">Phone <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" maxlength="10" name="phone_number" max="10" value="{{$users->phone_number}}" placeholder="Phone" pattern="[1-9]{1}[0-9]{9}">
                        </div>
                        @if ($errors->has('phone_number'))
                        <div class="error text-danger">
                          {{ $errors->first('phone_number') }}
                        </div>
                      @endif
                      </div>
                      <div class="col-sm-6 col-xl-4">
                        <div class="mb20">
                          <label class="heading-color ff-heading fw600 mb10">Address <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="address" value="{{$users->address}}" placeholder="Address">
                        </div>
                        @if ($errors->has('address'))
                          <div class="error text-danger">
                            {{ $errors->first('address') }}
                          </div>
                        @endif
                      </div>
                      {{-- <div class="col-md-12">
                        <div class="mb10">
                          <label class="heading-color ff-heading fw600 mb10">Description</label>
                          <textarea cols="30" rows="4" name="description" placeholder="write....">{{$users->description}}</textarea>
                        </div>
                      </div> --}}
                      <div class="col-md-12">
                        <div class="text-end">
                          <button type="submit" class="ud-btn btn-dark">Update Profile<i class="fal fa-arrow-right-long"></i></button>
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
  </div>



@include('front.master.include.footersell')
@endsection