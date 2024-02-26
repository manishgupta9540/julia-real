<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script type="text/javascript">
        var loaderPath = "https://f52.in/admin/assets/images/preload.gif";
    </script>

    <style>
        span.show-hide-password {
            position: relative;
            top: -37px;
            right: -93%;
            font-size: 16px;
            color: #748a9c;
            cursor: pointer;
            z-index: 1;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-lg-6 login">
            <div class="card1 pb-5">
                <form method="Post" action="{{url('/forget/password/update')}}" id="forgetPasswordForm">
                    @csrf 
                        <input type="hidden" name="token_no" value="{{$token_no}}"> 
                        <input type="hidden" name="id" value="{{$id}}">
                        <div class="card2 card border-0 px-4 py-5">
                            <div class="row"> 
                                <div class="col-md-12 text-left">
                                    <h4>Reset Your Password</h4>
                                </div>
                            </div>
                            <p style="margin-bottom: 2px;font-size:12px;" class="text-left text-success error_container" id="error-all"> </p>
                            <div class="row px-3"> 
                                <label class="mb-1"><h6 class="mb-0 text-sm">New Password <span class="text-danger">*</span></h6></label> 
                                <input class="form-control new_password" type="password" name="new_password">
                                <span class="show-hide-password js-show-hide has-show-hide"><i class="fa fa-eye-slash"></i></span> 
                                <p style="margin-left:-15px;" class="mb-3 text-danger error_container" id="error-new_password"></p> 
                            </div>
                            <div class="row px-3"> 
                                <label class="mb-1"><h6 class="mb-0 text-sm">Confirm Password <span class="text-danger">*</span></h6></label> 
                                <input class="form-control confirm_password" type="password" name="confirm_password"> 
                                <span class="show-hide-password js-show-hide has-show-hide"><i class="fa fa-eye-slash"></i></span>
                                <p style="margin-left:-15px;" class="mb-3 text-danger error_container" id="error-confirm_password"></p> 
                            </div>
                            <p style="" class="text-left text-danger error_container" id="wrong-credential"> </p>
                            <div class="row mb-3 px-3"> 
                                <button type="submit" class="btn btn-info forgot_submit">Submit</button> 
                            </div>
                        </div>
                </form>
            </div>
        </div>  
    </div>

    
    
    <script>
        $(document).on('submit', 'form#forgetPasswordForm', function (event) {
            event.preventDefault();
            //clearing the error msg
            $('p.error_container').html("");
            $('.forgot_submit').attr('disabled',true);
            $('.error-control').attr('readonly',true);
            var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
            var form = $(this);
            var data = new FormData($(this)[0]);
            var url = form.attr("action");
            if ($('.forgot_submit').html() !== loadingText) {
                $('.forgot_submit').html(loadingText);
            }

            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                cache: false,
                contentType: false,
                processData: false,      
                success: function (response) {
                    console.log(response);
                    window.setTimeout(function(){
                        $('.forgot_submit').attr('disabled',false);
                        $('.forgot_submit').html('Submit');
                        $('.error-control').attr('readonly',false);
                    },2000);
                    if(response.success==true  ) {          
                        toastr.success("Password has been changed successfully");
                            window.setTimeout(function() {
                                window.location="{{url('/')}}";
                            }, 2000);
                    }
                    if (response.success == false) {
                        for (control in response.errors) {
                            var error_text = control.replace('.', "_");
                            $('#error-' + error_text).html(response.errors[control]);
                        }
                    }
                },
                error: function (xhr, textStatus, errorThrown) {
                    // alert("Error: " + errorThrown);
                }
            });
            return false;
        });


        $(document).on('click','.js-show-hide',function (e) {
            e.preventDefault();
            var _this = $(this);

            if (_this.hasClass('has-show-hide'))
            {
                _this.parent().find('input').attr('type','text');
                _this.html('<i class="fa fa-eye"></i>');
                _this.removeClass('has-show-hide');
            }
            else
            {
                _this.addClass('has-show-hide');
                _this.parent().find('input').attr('type','password');
                _this.html('<i class="fa fa-eye-slash"></i>');
            }
        });
    </script>
</body>
</html>