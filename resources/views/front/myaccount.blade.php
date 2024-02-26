@extends('front.master.index')
@section('title','Change password')
@section('content')
<style>
   span.show-hide-password {
          position: absolute;
          top: 46px;
          right: 3%;
          font-size: 19px;
          color: #748a9c;
          cursor: pointer;
          z-index: 6;
    }
    .wrong_error{
        color: red;
    }
</style>
@include('front.master.include.common_sidebar')

<div class="dashboard_content_wrapper">

  <div class="dashboard dashboard_wrapper pr30 pr0-md">

    @include('front.master.include.sidebar')

      <div class="dashboard__main pl0-md">

        <div class="dashboard__content property-page bgc-f7">
          <div class="row align-items-center pb40">
            <div class="col-lg-12">
              <div class="dashboard_title_area">
                <h2>Change Password</h2>
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
          
          @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
          @elseif (session('error'))
              <div class="alert alert-danger" role="alert">
                  {{ session('error') }}
              </div>
          @endif
          
           <div class="row">
            <div class="col-xl-12">
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <h4 class="title fz17 mb30">Change password</h4>
                <form class="form-style1" method="post" action="{{ url('/profile/changepassword') }}" id="userchangepasswordFrm">
                  @csrf
                  <div class="row">
                    <div class="col-sm-4 col-xl-4">
                      <div class="input-group mb-4">
                        <label class="heading-color ff-heading fw600 mb10">Old Password</label>
                        <input type="password" name="old_password" id="old_password" class="w-100 rounded-2" placeholder="Old Password">
                        <span class="show-hide-password js-show-hide has-show-hide"><i class="bi bi-eye-slash"></i></span>
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-old_password"></p>
                        <span class="wrong_error"></span>
                      </div>
                      {{-- @error('old_password')
                          <span class="text-danger">{{ $message }}</span>
                      @enderror --}}
                    </div>
                    <div class="col-sm-4 col-xl-4">
                      <div class="input-group mb-4">
                        <label class="heading-color ff-heading fw600 mb10">New Password</label>
                        <input type="password" name="new_password" id="new_password" class="w-100 rounded-2" placeholder="New Password">
                        <span class="show-hide-password js-show-hide has-show-hide"><i class="bi bi-eye-slash"></i></span>
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-new_password"></p>
                    </div>
                      {{-- @error('new_password')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror --}}
                    </div>
                    <div class="col-sm-4 col-xl-4">
                      <div class="input-group mb-4">
                        <label class="heading-color ff-heading fw600 mb10">Confirm Password</label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="w-100 rounded-2" placeholder="New Password">
                        <span class="show-hide-password js-show-hide has-show-hide"><i class="bi bi-eye-slash"></i></span>
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-new_password_confirmation"></p>
                    </div>
                      {{-- @if ($errors->has('password_confirmation'))
                      <div class="error text-danger">
                        {{ $errors->first('password_confirmation') }}
                      </div>
                    @endif --}}
                    </div>
                    <div class="col-md-12">
                      <div class="text-end">
                        <button type="submit" class="ud-btn btn-dark login_submit">Change Password<i class="fal fa-arrow-right-long"></i></button>
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

  <footer class="dashboard_footer pt30 pb10" >
    <div class="container">
       <div class="row items-center justify-content-center justify-content-md-between">
          <div class="col-auto">
             <div class="copyright-widget">
                <p class="text" style="margin-left: 163px;">© julia - All rights reserved</p>
             </div>
          </div>
          <div class="col-auto">
            <div class="social-widget text-center text-sm-end">
              <div class="social-style1 light-style">
                <a class="me-2 fw600 fz15" href="#">Follow us</a>
                <a href="https://www.facebook.com/JuliaSuriname"><i class="fab fa-facebook-f list-inline-item"></i></a>
                <a href="https://www.instagram.com/juliasuriname/"><i class="fab fa-instagram list-inline-item"></i></a>
                {{-- <a href="#"><i class="fab fa-twitter list-inline-item"></i></a> --}}
                {{-- <a href="#"><i class="fab fa-linkedin-in list-inline-item"></i></a> --}}
              </div>
            </div>
          </div>
       </div>
    </div>
  </footer>

{{-- @include('front.master.include.footersell') --}}
@endsection
@push('custom-scripts')
<script>
   //user login
   $(document).on('submit', 'form#userchangepasswordFrm', function(event) {
            event.preventDefault();
            //clearing the error msg
            $('p.error_container').html("");

            var form = $(this);
            var data = new FormData($(this)[0]);
            var url = form.attr("action");
            var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
            $('.login_submit').attr('disabled', true);
            $('.form-control').attr('readonly', true);
            $('.form-control').addClass('disabled-link');
            $('.error-control').addClass('disabled-link');
            if ($('.login_submit').html() !== loadingText) {
                $('.login_submit').html(loadingText);
            }
            $.ajax({
                type: form.attr('method'),
                url: url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    window.setTimeout(function() {
                        $('.login_submit').attr('disabled', false);
                        $('.form-control').attr('readonly', false);
                        $('.form-control').removeClass('disabled-link');
                        $('.error-control').removeClass('disabled-link');
                        $('.login_submit').html('Change Password');
                    }, 2000);
                    console.log(response);
                    if (response.success == true) {
                      toastr.success("Password updated successfully!");
                      window.setTimeout(function() {
                        window.location.href = "{{route('home')}}"

                        }, 2000);
                    }
                    if( response.error_type == 'reset-pass' ){                                                          
                        $(".wrong_error").html("");
                        $(".wrong_error").html("Old Password Doesn't match!");
                        return false;
                    }
                    //show the form validates error
                    if (response.success == false) {
                        for (control in response.errors) {
                            var error_text = control.replace('.', "_");
                            $('#error-' + error_text).html(response.errors[control]);
                        }
                        // console.log(response.errors);
                    }
                },
                error: function(response) {
                    // alert("Error: " + errorThrown);
                    console.log(response);
                }
            });
            event.stopImmediatePropagation();
            return false;
        });
</script>

@endpush