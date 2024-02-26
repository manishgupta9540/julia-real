@extends('admin.master.index')

@section('content')
<style>
    span.show-hide-password {
          position: absolute;
          top: 36px;
          right: 3%;
          font-size: 19px;
          color: #748a9c;
          cursor: pointer;
          z-index: 6;
    }
</style>
<div class="col-12">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-11">
            <form action="{{route('user.create')}}"  method="POST" id="usercreate">
                @csrf
                    <div class="form-body">
                        <div class="card radius shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                    <h4 class="card-title mb-1 mt-3">Create a New Customer </h4>
                                    <p class="pb-border"> </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="role" class="form-control-label font-weight-300">First Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name"  class="form-control" placeholder="First Name">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="role" class="form-control-label font-weight-300">Last Name<span class="text-danger">*</span></label>
                                            <input type="text" name="last_name"  class="form-control" placeholder="Last Name">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-last_name"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="role" class="form-control-label font-weight-300">Email<span class="text-danger">*</span></label>
                                            <input type="text" name="email"  class="form-control" placeholder="Email">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-email"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="role" class="form-control-label font-weight-300">Phone Number<span class="text-danger">*</span></label>
                                            <input type="text" name="phone_number" maxlength="10" class="form-control" placeholder="Phone Number" pattern="[1-9]{1}[0-9]{9}">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-phone_number"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="role" class="form-control-label font-weight-300">Address<span class="text-danger">*</span></label>
                                            <input type="text" name="address"  class="form-control" placeholder="Address">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-address"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="email" class="lab1">Password</label>
                                        <input type="password" name="password" id="password" class="form-control rounded-2" placeholder="Password">
                                        <span class="show-hide-password js-show-hide has-show-hide"><i class="bi bi-eye-slash"></i></span>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-password"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <button class="btn btn-success submit" type="submit">Save</button>
                                </div>
                                <div class="text-center">
                                    <div class="error"></div>
                                </div>
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

@endsection

@push('customjs')
    <script>
            $(document).on('submit', 'form#usercreate', function (event) {
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
                                $('.submit').html('Create');
                            },2000);
                            console.log(response);
                            if(response.success==true) {   
                                toastr.success("User Creted Successfully");
                                window.setTimeout(function() {
                                    window.location.href = "{{URL::to('admin/user-list')}}"
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

    </script>
@endpush