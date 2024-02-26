@extends('admin.master.index')

@section('title','Aminities Add')

@section('content')

<div class="col-12">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-10">
            <form action="{{route('aminities-create')}}"  method="POST" id="aminitiescreate" enctype="multipart/form-data">
                @csrf
                    <div class="form-body">
                        <div class="card radius shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                    <h4 class="card-title mb-1 mt-3">Create a New Aminities </h4>
                                    <p class="pb-border"> </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="role" class="form-control-label font-weight-300">Amenities Name<span class="text-danger">*</span></label>
                                            <input type="text" name="amenities_name"  class="form-control" placeholder="Amenities Name">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-amenities_name"></p>
                                        </div>
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
        $(document).on('submit', 'form#aminitiescreate', function (event) {
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
                            toastr.success("Aminities created Successfully");
                            window.setTimeout(function() {
                                window.location.href = "{{URL::to('admin/aminities')}}"
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