@extends('admin.master.index')

@section('title','Why Choose Edit')

@section('content')

<div class="col-12">
    <div class="row align-items-center justify-content-center">
        <div class="col-md-11">
            <form action="{{route('find-sell-update')}}"  method="POST" id="blogscreate" enctype="multipart/form-data">
                @csrf
                    <div class="form-body">
                        <div class="card radius shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                    <h4 class="card-title mb-1 mt-3">Edit Find Sell </h4>
                                    <p class="pb-border"> </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="role" class="form-control-label font-weight-300">Title</label>
                                            <input type="text" name="title"  class="form-control" placeholder="Title" value="{{$choose->title}}">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="hidden" name="id" value="{{base64_encode($choose->id)}}">
                                            <label for="role" class="form-control-label font-weight-300">Why Choose Image<span class="text-danger">*</span></label>
                                            <input type="file" name="image"  class="form-control" placeholder="Image">
                                            <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-image"></p>
                                        </div>
                                    </div>
                                    @if($choose->image!=NULL && file_exists(public_path('uploads/why/'.$choose->image)))
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <a href="{{asset('uploads/why/'.$choose->image)}}" target="_blank">
                                                <img src="{{asset('uploads/why/'.$choose->image)}}" width="100px" height="100px">
                                            </a>
                                        </div>
                                    </div>
                                @endif
                                    
                                </div>

                                <a href="javascript:;" class="add_chose"><i class="fa fa-plus mb-3"></i> Add chose Point</a>
                                <span class="addSpokeDiv">
                                    @if($choose->property_types!=NULL)
                                        @php
                                            $input_item_data = $choose->property_types;

                                            $input_item_data_array =  json_decode($input_item_data, true);
                                         
                                        @endphp

                                        @if($input_item_data_array != null)
                                            @foreach ($input_item_data_array as $key => $input)
                                                <?php 
                                                    $key_val = array_keys($input);
                                                    $input_val = array_values($input);
                                                ?>

                                                <div class='spokeReport' row-id='1'>
                                                    <div class='form-group'>
                                                        <div class="row">
                                                        <div class="col-md-5">
                                                            <label style='font-size: 16px;'> Headlines Title </label>
                                                            <input class='form-control' type='text' name='property_types[]' value="{{$key_val[0]}}">
                                                            <p style='margin-bottom: 2px;' class='text-danger error_container error-spoke_name' id="error-spoke_name"></p>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <label style='font-size: 16px;'> Headlines Description <span class="text-danger">*</span></label>
                                                            <input class='form-control' type='text' name='property_description[]' value="{{$input_val[0]}}">
                                                            <p style='margin-bottom: 2px;' class='text-danger error_container error-spoke_name' id="error-spoke_name"></p>
                                                        </div>
                                                        <div class="col-md-2 mt-4">
                                                            <span class="btn btn-link text-danger delete_spokeman" data-id="{{base64_encode($key)}}" data-business="{{base64_encode($choosesibgle->id)}}" style="font-size:20px;"><i class="far fa-times-circle"></i></span>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    @endif    
                                </span><br>
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
<script src="{{asset('admin/ckeditor/ckeditor.js')}}"></script>

<script>
    CKEDITOR.replace('description', {
        extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
        mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
        removeButtons: 'PasteFromWord'
    });
</script>
    <script>
        $(document).on('submit', 'form#blogscreate', function (event) {
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
                            toastr.success("Find Sell updated Successfully");
                            window.setTimeout(function() {
                                window.location.href = "{{URL::to('admin/find-sell-list')}}"
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

        $(document).on('click','.add_chose',function(){ 
            var s_len = $('.chooseinput').length;
            if(s_len + 1 > 5)
            {

                swal({
                        title: "You Can Include Maximum 5 Input !!",
                        text: '',
                        type: 'warning',
                        buttons: true,
                        dangerMode: true,
                        confirmButtonColor:'#003473'
                    });
            }
            else
            {
                $(".addSpokeDiv").append(
                `<div class='chooseinput' row-id='1'>
                    <div class='form-group'>
                    <div class="row">
                    <div class="col-md-5">
                    <label style='font-size: 16px;'> Headlines Title <span class="text-danger">*</span></label>
                    <input class='form-control' type='text' name='property_types[]' value=''>
                    <p style='margin-bottom: 2px;' class='text-danger error_container error-spoke_name' id="error-spoke_name"></p>
                    </div>
                    <div class="col-md-5">
                    <label style='font-size: 16px;'> Headlines Description<span class="text-danger">*</span></label>
                    <input class='form-control' type='text' name='property_description[]' value=''>
                    <p style='margin-bottom: 2px;' class='text-danger error_container error-spoke_name' id="error-spoke_name"></p>
                    </div>
                    <div class="col-md-2 mt-4">
                    <span class="btn btn-link text-danger close_spoke_div" style="font-size:20px;"><i class="far fa-times-circle"></i></span>
                    </div>
                    </div>
                    </div>
                </div>`
                );
            }
                var i=0;
                $('.error-spoke_name').each(function(){
                    $(this).attr('id','error-spoke_name_'+i);
                    i++;
                });
                
        });

        $(document).on('click','.close_spoke_div',function(){
            var _this=$(this);
            
            _this.parent().parent().parent().parent().fadeOut("slow", function(){ 
                _this.parent().parent().parent().parent().remove();
                    var i=0;
                    $('.error-spoke_name').each(function(){
                    $(this).attr('id','error-spoke_name_'+i);
                    i++;
                    });
            });  
        });

        $(document).on('click','.delete_spokeman',function(){
            var id = $(this).attr('data-id');
            var customer_id = $(this).attr('data-business');
            var _this=$(this);

            swal({
               // icon: "warning",
               type: "warning",
               title: "Are You Sure Want To Delete?",
               text: "",
               dangerMode: true,
               showCancelButton: true,
               confirmButtonColor: "#DD6B55",
               confirmButtonText: "YES",
               cancelButtonText: "CANCEL",
               closeOnConfirm: false,
               closeOnCancel: false
               },
               function(e){
                  if(e==true)
                  {
                     $.ajax({
                           type:'POST',
                           url: "{{route('deleted_find_sell')}}",
                           data: {"_token": "{{ csrf_token() }}",'id':id,'customer_id':customer_id},        
                           success: function (response) {        
                           console.log(response);
                           
                              if (response.status=='ok') {    

                                 _this.parent().parent().parent().parent().fadeOut("slow", function(){ 
                                    _this.parent().parent().parent().parent().remove();
                                       var i=0;
                                       $('.error-spoke_name').each(function(){
                                          $(this).attr('id','error-spoke_name_'+i);
                                          i++;
                                       });

                                    });
                                    
                              } else {

                                 toastr.error("Something Went Wrong !!");
                                    
                              }
                           },
                           error: function (response) {
                              console.log(response);
                           }
                        });

                        swal.close();
                  }
                  else
                  {
                     swal.close();
                  }
               }
            );
        });

    </script>
    

            
@endpush