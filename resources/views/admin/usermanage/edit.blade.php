@extends('admin.master.index')

@section('content')

<div class="col-12">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-10">
            <form action="{{route('user-role-update')}}"  method="POST" id="userroleupdate">
                @csrf
                    <div class="form-body">
                        <div class="card radius shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                    <h4 class="card-title mb-1 mt-3">Edit User </h4>
                                    <p class="pb-border"> </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="{{base64_encode($rolesadmin->id)}}">
                                            <label for="role" class="form-control-label font-weight-300">First Name<span class="text-danger">*</span></label>
                                            <input type="text" name="name"  class="form-control" value="{{$rolesadmin->name}}" placeholder="First Name">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-name"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="role" class="form-control-label font-weight-300">Last Name<span class="text-danger">*</span></label>
                                            <input type="text" name="last_name"  class="form-control" value="{{$rolesadmin->last_name}}" placeholder="Last Name">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-last_name"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="role" class="form-control-label font-weight-300">Email<span class="text-danger">*</span></label>
                                            <input type="text" name="email"  class="form-control" value="{{$rolesadmin->email}}" placeholder="Email">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-email"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="role" class="form-control-label font-weight-300">Contact Number<span class="text-danger">*</span></label>
                                            <input type="text" name="contact_number"  class="form-control" value="{{$rolesadmin->phone_number}}" placeholder="Contact Number">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-contact_number"></p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="role" class="form-control-label font-weight-300">Role1<span class="text-danger">*</span></label>
                                            <select name="role_id" class="form-control" id="role_id">
                                                <option value="">Select Role</option>
                                                @foreach ($role_master as $role)
                                                    <option value="{{$role->id}}"  {{ $role->id == $rolesadmin->role_id ? 'selected' : '' }}>{{$role->role}}</option>
                                                @endforeach
                                             
                                            </select>
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-role_id"></p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="text-right">
                                    <button class="btn btn-success submit" type="submit">Update</button>
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
          $(document).on('submit', 'form#userroleupdate', function (event) {
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
                                $('.submit').html('Update');
                            },2000);
                            console.log(response);
                            if(response.success==true) {   
                                toastr.success("User Creted Successfully");
                                window.setTimeout(function() {
                                    window.location.href = "{{URL::to('admin/user-roles-list')}}"
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

    </script>
@endpush