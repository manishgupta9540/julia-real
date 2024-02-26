@extends('front.master.index')
@section('title','Contact')
@section('content')

@include('front.master.include.common_sidebar')

    <div class="body_content">
        <!-- UI Elements Sections -->
        <section class="breadcumb-section2 p-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="breadcumb-style1">
                            <h2 class="title text-white">Contact Us</h2>
                            <div class="breadcumb-list">
                                <a class="text-white" href="{{route('home')}}">Home</a>
                                <a class="text-white" href="#">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-5 position-relative">
                        <div class="home8-contact-form default-box-shadow1 bdrs12 bdr1 p30 mb30-md bgc-white">
                            <h4 class="form-title mb25">Have questions? Get in touch!</h4>
                            <form action="{{route('get-in-touch')}}" method="post" id="frmContact" enctype="multipart/form-data">
                              @csrf  
                              <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw600 mb10">Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Your Name">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name"></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw600 mb10">Phone Number</label>
                                            <input type="text" name="phone_number" class="form-control" maxlength="10" placeholder="Phone Number" pattern="[1-9]{1}[0-9]{9}">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-phone_number"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb20">
                                            <label class="heading-color ff-heading fw600 mb10">Email</label>
                                            <input type="email" name="email" class="form-control" placeholder="Your Email">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-email"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb10">
                                            <label class="heading-color ff-heading fw600 mb10">Description</label>
                                            <textarea cols="30" rows="4" placeholder="Your Message" name="description"></textarea>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-description"></p>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-grid">
                                            <button type="submit" class="ud-btn btn-thm" >Submit<i class="fal fa-arrow-right-long"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5 offset-lg-2">
                        <h2 class="mb30 text-capitalize">We’d love to hear <br class="d-none d-lg-block">from you.</h2>
                        <p class="text">We are here to answer any question you may have. As a partner of corporates,
                            realton has more than 9,000 offices of all sizes and all potential of session.</p>
                        <p class="text">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been
                            the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley
                            of type and scrambled it to make a type specimen book. It has survived not only five centuries,
                            but also the leap into electronic typesetting, remaining essentially unchanged. It was
                            popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,
                            and more recently with desktop publishing software like Aldus PageMaker including versions of
                            Lorem Ipsum.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Our CTA -->
        {{-- <section class="our-cta pb-0 pt-0">
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
                                <a href="{{route('contact')}}" class="ud-btn btn-transparent mr30 mr0-xs">Contact Us<i
                                        class="fal fa-arrow-right-long"></i></a>
                                <a href="#" class="ud-btn btn-dark"><span class="flaticon-call vam pe-2"></span>920
                                    851 9087</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
        
        <a class="scrollToHome" href="#"><i class="fas fa-angle-up"></i></a>
    </div>
    </div>
    @include('front.master.include.footer')
@endsection

@push('custom-scripts')
    <script>

        $(document).ready(function(){
            //user contact
            $(document).on('submit', 'form#frmContact', function (event) {
                event.preventDefault();
                //clearing the error msg
                $('p.error_container').html("");
                
                var form = $(this);
                var data = new FormData($(this)[0]);
                var url = form.attr("action");
                var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
                $('.submit').attr('disabled',true);
                $('.form-control').attr('readonly',true);
                $('.form-control').addClass('disabled-link');
                $('.error-control').addClass('disabled-link');
                if ($('.submit').html() !== loadingText) {
                    $('.submit').html(loadingText);
                }
                    $.ajax({
                        type: form.attr('method'),
                        url: url,
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,      
                        success: function (response) {
                            window.setTimeout(function(){
                                $('.submit').attr('disabled',false);
                                $('.form-control').attr('readonly',false);
                                $('.form-control').removeClass('disabled-link');
                                $('.error-control').removeClass('disabled-link');
                                $('.submit').html('Submit');
                            },2000);
                            console.log(response);
                            if(response.success==true) {   
                                toastr.success("Admin Contact as soon as possible");
                                window.setTimeout(function() {
                                    $("#frmContact")[0].reset();
                                }, 2000);
                            }
                            //show the form validates error
                            if(response.success==false ) {                              
                                for (control in response.errors) {  
                                var error_text = control.replace('.',"_");
                                $('#error-'+error_text).html(response.errors[control]);
                                // $('#error-'+error_text).html(response.errors[error_text][0]);
                                // console.log('#error-'+error_text);
                                }
                                // console.log(response.errors);
                            }
                        },
                        error: function (response) {
                            // alert("Error: " + errorThrown);
                            console.log(response);
                        }
                    });
                    event.stopImmediatePropagation();
                    return false;
            });

          });
    </script>    
@endpush

