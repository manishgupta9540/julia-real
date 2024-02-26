<style>
    .wrong_error{
        color: red;
    }
    .wrong_error_email{
        color: red;
    }
    span.show-hide-password {
          position: absolute;
          top: 36px;
          right: 3%;
          font-size: 19px;
          color: #748a9c;
          cursor: pointer;
          z-index: 6;
    }
    .modal-body input{
        height: 36px;
    }
</style>

{{-- login modal --}}
<div class="modal" id="login">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Login Modal Header -->
            <div class="modal-header">
                <h2 class="modal-title">To Login</h2>
                <button type="button" class="btn-close" id="loginClose" data-bs-dismiss="modal"></button>
            </div>

            @if ($message = Session::get('success'))
                <div class="col-md-12">
                    <div class="alert alert-danger">
                        <strong>{{ $message }}</strong>
                    </div>
                </div>
            @endif

            <!--Login Modal body -->
            <div class="modal-body">
                <form action="{{ route('user_login') }}" method="post" id="userloginFrm">
                    @csrf
                    <label for="email" class="lab1">Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" class="w-100 rounded-2">
                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-email"></p>

                    <div class="input-group mb-3">
                        <label for="email" class="lab1">Password</label>
                        <input type="password" name="password" id="password" class="w-100 rounded-2" placeholder="Password">
                        <span class="show-hide-password js-show-hide has-show-hide"><i class="bi bi-eye-slash"></i></span>
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-password"></p>
                    </div>
                    <div class="d-flex align-items-center">
                        <input type="checkbox" name="checkbox" id="checkbox" class="rounded-2">
                        <label for="checkbox" class="keep ms-1">Keep me login</label>
                    </div>
                
                    <span style="" class="text-left text-danger error_container" id="wrong-credential"> </span>
                    <a href="javascript:void(0)" class="float-end text-decoration-none anc1" data-bs-toggle="modal" data-bs-target="#foregt-password">Forget password?</a>
                    <button type="submit" class="btn w-100 rounded-4 mt-3 login_submit"><b>Login</b></button>
                    {{-- <span style="" class="text-left text-danger error_container" id="wrong-credential"> </span> --}}
                </form>

                <p class="text-center or fortest mt-3">Or</p>
                <a href="">
                    <button class="btn w-100 rounded-pill bt1"><i class="fa-brands fa-google float-start"></i><b>Login With Gmail</b></button>
                </a>
                <a href="">
                    <button class="btn w-100 mt-3 mb-2 rounded-pill bt2"><i class="fa-brands fa-facebook-f float-start"></i><b>Login with Facebook</b></button></a>
            </div>
            <div class="modal-footer justify-content-center pt-1 pb-0">
                <p class="text-center p1">Not signed up?<a href="javascript:void(0)" class="anc1" id="loginfrm" data-bs-toggle="modal" data-bs-target="#register"><b> Create an account.</b></a>
                </p>
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
                <button type="button" class="btn-close" id="loginClose" data-bs-dismiss="modal"></button>
            </div>

            <!-- Register Modal body -->
            <div class="modal-body pt-1">
                <p class="para">Create your account so that you can log in to House for Sale in business and manage
                    your data.</p>
                <form action="{{ route('user_register') }}" method="post" id="userregisterfrm">
                    @csrf
                    <label for="name" class="lab1">First Name</label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" class="w-100 rounded-2" placeholder="First Name">
                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-first_name"></p>

                    <label for="lname" class="lab1 mt-3">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" class="w-100 rounded-2" placeholder="Last Name">
                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-last_name"></p>

                    <label for="email" class="lab1 mt-3">E-mail Address</label>
                    <input type="text" name="user_email" id="user_email" value="{{ old('user_email') }}" class="w-100 rounded-2" placeholder="Email">
                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-user_email"></p>
                    <p style="margin-bottom: 2px;" class="text-danger" id="user_allready"></p>
                    <div class="input-group mb-3">
                        <label for="email" class="lab1">Phone Number</label>
                        <input type="text" maxlength="10" name="phone_number" id="phone_number" value="{{old('phone_number')}}" class="w-100 rounded-2" placeholder="Phone number" pattern="[1-9]{1}[0-9]{9}">
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-phone_number"></p>
                    </div>
                    <div class="input-group mb-3">
                        <label for="email" class="lab1">Address</label>
                        <input type="text" name="address" id="address" value="{{old('address')}}" class="w-100 rounded-2" placeholder="address">
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-address"></p>
                    </div>
                    <div class="input-group mb-3">
                        <label for="email" class="lab1">Password</label>
                        <input type="password" name="user_password" id="user_password" class="w-100 rounded-2" placeholder="Password">
                        <span class="show-hide-password js-show-hide has-show-hide"><i class="bi bi-eye-slash"></i></span>
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-user_password"></p>
                    </div>

                    <div class="input-group mb-3">
                        <label for="email" class="lab1">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="w-100 rounded-2" placeholder="Password">
                        <span class="show-hide-password js-show-hide has-show-hide"><i class="bi bi-eye-slash"></i></span>
                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-password_confirmation"></p>
                    </div>

                    <div class="d-flex df">
                        <input type="checkbox" name="checkbox" id="checkbox" class="rounded-2 align-self-start m-1">
                        <label for="" class="para"> I want to register for news and inspiration from House for Sale, partly based on my profile</label>
                    </div>
                    <a href="#"><button type="submit" class="btn w-100 rounded-4 mt-3 submit"><b>To Register</b></button></a>
                </form>
                <p class="para m-0">By signing up you agree to our <a href="" class="text-decoration-none">Terms of Use</a>.
                    Our <a href="" class="text-decoration-none">Privacy Policy</a> applies.</p>
            </div>
            <div class="modal-footer justify-content-center pt-1 pb-0">
                <p class="para1 text-center">Already registered with Julia? <a href="javascript:void(0)"
                        class="text-decoration-none" id="registerfrm" data-bs-toggle="modal" data-bs-target="#login"><b>Log in here.</b></a></p>
            </div>
        </div>
    </div>
</div>

{{-- forget password  --}}
<div class="modal" id="foregt-password">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Login Modal Header -->
            <div class="modal-header">
                <h2 class="modal-title">Forget Password</h2>
                <button type="button" class="btn-close" id="loginClose" data-bs-dismiss="modal"></button>
            </div>
            <!--Login Modal body -->
            <div class="modal-body">
                <form action="{{route('foregt-password')}}" method="post" id="forgetpasswordfrm">
                    @csrf
                    <label for="email" class="lab1">Email</label>
                    <input type="email" name="useremail" id="useremail" placeholder="Email" class="w-100 rounded-2">
                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-useremail"></p>
                    <span class="wrong_error_email"></span>
                    <button type="submit" class="btn w-100 rounded-4 mt-3 submit"><b>Forget Password</b></button>
                    <span style="" class="text-left text-danger error_container" id="wrong-credential"> </span>
                </form>
            </div>
            
        </div>
    </div>
</div>

<script src="{{ asset('front/js/jquery-3.6.4.min.js') }}"></script>
<script src="{{ asset('front/js/jquery-migrate-3.0.0.min.js') }}"></script>
<script src="{{ asset('front/js/popper.min.js') }}"></script>
<script src="{{ asset('front/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('front/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('front/js/jquery.mmenu.all.js') }}"></script>
<script src="{{ asset('front/js/ace-responsive-menu.js') }}"></script>
<script src="{{ asset('front/js/jquery-scrolltofixed-min.js') }}"></script>
<script src="{{ asset('front/js/wow.min.js') }}"></script>
<script src="{{ asset('front/js/isotop.js') }}"></script>
<script src="{{ asset('front/js/owl.js') }}"></script>
<script src="{{ asset('front/js/parallax.js') }}"></script>
<script src="{{ asset('front/js/pricing-slider.js') }}"></script>
<script src="{{ asset('front/js/scrollbalance.js') }}"></script>
<!-- Custom script for all pages -->
<script src="{{ asset('front/js/script.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!--toaster js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
 
<!-- sweet alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.min.js"></script>

<!-- date picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
                includedLanguages: 'en,nl'
            }, 'google_translate_element');
        }
    </script>   
    
    <script>
        //  Fixed sidebar Custom Script For That 
        $(function() {
            var cols = $('.wrap .column');
            var enabled = true;
            var scrollbalance = new ScrollBalance(cols, {
                minwidth: 0
            });
            // bind to scroll and resize events
            scrollbalance.bind();
        });

    </script>

<script>
    $(document).ready(function() {
        //user register

        $(document).on('submit', 'form#userregisterfrm', function(event) {
            event.preventDefault();
            //clearing the error msg
            $('p.error_container').html("");

            var form = $(this);
            var data = new FormData($(this)[0]);
            var url = form.attr("action");
            var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
            $('.submit').attr('disabled', true);
            $('.form-control').attr('readonly', true);
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
                success: function(response) {
                    window.setTimeout(function() {
                        $('.submit').attr('disabled', false);
                        $('.form-control').attr('readonly', false);
                        $('.form-control').removeClass('disabled-link');
                        $('.error-control').removeClass('disabled-link');
                        $('.submit').html('To Register');
                    }, 2000);
                    console.log(response);
                    if (response.success == true) {
                        toastr.success("User Registered Successfully");
                        window.setTimeout(function() {
                            $("#userregisterfrm")[0].reset();
                            $('#register').modal('hide');
                        }, 2000);
                    }
                    //show the form validates error
                    if (response.success == false) {
                        $('#user_allready').html('Email id has already been taken');
                        for (control in response.errors) {
                            var error_text = control.replace('.', "_");
                            $('#error-' + error_text).html(response.errors[control]);
                            // $('#error-'+error_text).html(response.errors[error_text][0]);
                            // console.log('#error-'+error_text);
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

        //user login
        $(document).on('submit', 'form#userloginFrm', function(event) {
            event.preventDefault();
            //clearing the error msg
            $("#wrong-credential").html(""); 
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
                        $('.login_submit').html('Login');
                    }, 2000);
                    console.log(response);
                    if (response.success == true) {
                        toastr.success("You have Login Successfully");
                        window.setTimeout(function() {
                            window.location.href = "{{route('home')}}"
                            $("#userloginFrm")[0].reset();
                            $('#login').modal('hide');
                        }, 2000);
                    }
                    //show the form validates error
                    if(response.success==false  ) {
                        if (response.error_type == 'validation') {
                            for (control in response.errors) {
                                var error_text = control.replace('.', "_");
                                $('#error-' + error_text).html(response.errors[control]);
                            }
                            return false;
                        }

                        if( response.error_type == 'wrong_email_or_password' ){
                            console.log(response);                                                           
                            $("#wrong-credential").html("");
                            $("#wrong-credential").html("Enter a valid email or password!");
                            return false;
                        }
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

        //forget password 
        $(document).on('submit', 'form#forgetpasswordfrm', function(event) {
            event.preventDefault();
            //clearing the error msg
            $('p.error_container').html("");

            var form = $(this);
            var data = new FormData($(this)[0]);
            var url = form.attr("action");
            var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
            $('.submit').attr('disabled', true);
            $('.form-control').attr('readonly', true);
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
                success: function(response) {
                    window.setTimeout(function() {
                        $('.submit').attr('disabled', false);
                        $('.form-control').attr('readonly', false);
                        $('.form-control').removeClass('disabled-link');
                        $('.error-control').removeClass('disabled-link');
                        $('.submit').html('Forget Password');
                    }, 2000);
                    console.log(response);
                    if (response.success == true) {
                        toastr.success("Mail has been sent successfully!");
                        window.setTimeout(function() {
                            window.location.reload();
                            $("#forgetpasswordfrm")[0].reset();
                            $('#foregt-password').modal('hide');
                        }, 2000);
                    }
                    //show the form validates error
                    if (response.success == false) {
                        for (control in response.errors) {
                            var error_text = control.replace('.', "_");
                            $('#error-' + error_text).html(response.errors[control]);
                        }
                        // console.log(response.errors);
                    }
                    if (response.success1 == false) {
                        $('.wrong_error_email').html('Please enter your correct email');
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


        //password hide and show
        $(document).on('click','.js-show-hide',function (e) {
            e.preventDefault();
            var _this = $(this);

            if (_this.hasClass('has-show-hide'))
            {
                _this.parent().find('input').attr('type','text');
                _this.html('<i class="fa fa-eye" aria-hidden="true"></i>');
                _this.removeClass('has-show-hide');
            }
            else
            {
                _this.addClass('has-show-hide');
                _this.parent().find('input').attr('type','password');
                _this.html('<i class="bi bi-eye-slash"></i>');
            }


        });

        $(".commonDatepicker").datepicker({
            endDate: new Date(),
            changeMonth: true,
            changeYear: true,
            firstDay: 1,
            autoclose:true,
            todayHighlight: true,
            format: 'dd-mm-yyyy',
            
        });

        // $(document).on('click', '#loginfrm', function(event) {
        //         $('#login').hide();
        //         $('#register').show();
               
        // });

        // // addedd login
        // $(document).on('click', '#registerfrm', function(event) {
        //     $('#login').show();
        //    $('#register').hide();
        // });
    });
    
    window.setTimeout(function(){ 
        $('.goog-te-gadget-simple').click(function() {
            $('.VIpgJd-ZVi9od-vH1Gmf').css('border', '1px solid #6b90da00');
        }); 
                                
    },5000);
</script>

@stack('custom-scripts')
