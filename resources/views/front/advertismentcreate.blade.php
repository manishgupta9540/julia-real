@extends('front.master.index')
@section('title','My property')
@section('content')
@include('front.master.include.common_sidebar')
@inject('carbon', 'Carbon\Carbon')
<div class="dashboard_content_wrapper">
  @include('front.master.include.sidebar')
</div>
<div class="dashboard__main pl0-md">
        <div class="dashboard__content property-page bgc-f7">
          <div class="row align-items-center pb40">
            <div class="col-xxl-6">
              <div class="dashboard_title_area">
                <h2>Create Advertisement</h2>
              </div>
            </div>
            <div class="col-xxl-6">
              <div class="dashboard_search_meta d-md-flex align-items-center justify-content-xxl-end">
                {{-- <div class="item1 mb15-sm">
                  <div class="search_area">
                    <input type="text" class="form-control bdrs12" id="user_search" name="user_search"  placeholder="Search">
                    <label><span class="flaticon-search"></span></label>
                  </div>
                </div>
                <div class="page_control_shorting bdr1 bdrs12 py-2 ps-3 pe-2 mx-1 mx-xxl-3 bgc-white mb15-sm ">
                  <div class="pcs_dropdown d-flex align-items-center"><span class="title-color">Sort by:</span>
                    <select name="sort_by" id="sort_by" class="selectpicker show-tick sort_by_price">
                      <option value="">New</option>
                      <option value="lowest_price">Low To High</option>
                      <option value="highest_price">High To Low</option>
                    </select>
                  </div>
                </div> --}}
               
              </div>
            </div>
          </div>
          <?php 
              $userPackages = DB::table('payments')
                          ->where('user_id', Auth::user()->id)
                          ->select('package_id', 'package_name')
                          ->groupBy('package_id', 'package_name')
                          ->get(); 
          ?>
          <div class="row">
            <div class="col-xl-12">
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <div class="packages_table table-responsive">
                    <form action="{{route('save-addvertisement')}}" method="post" id="addveritsementadd">
                        @csrf
                        <div class="tab-content site-data-search" id="pills-tabContent"> 
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw600 mb10">URL</label>
                                        <input type="text" class="form-control" name="url" value="{{old('old')}}" placeholder="URL">
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-url"></p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw600 mb10">Image</label>
                                        <input type="file" class="form-control" name="image" value="{{old('old')}}" placeholder="Image">
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-image"></p>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw600 mb10">Package Name</label>
                                        <select name="package_id" id="package_id" class="form-control">
                                            <option value="">--Select--</option>
                                            @foreach ($userPackages as $userPackage)
                                                <option value="{{ $userPackage->package_id}}">{{$userPackage->package_name}}</option>
                                            
                                              @endforeach
                                        </select>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-package_id"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="mb20">
                                        <label class="heading-color ff-heading fw600 mb10">Description</label>
                                        <textarea class="form-control content" id="content" placeholder="Enter the Description" name="description"></textarea>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-description"></p>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="ud-btn btn-dark submit">Submit</i></button>
                        </div>
                    </form>
                    
                  <div class="mbp_pagination text-center mt30">
                   
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>



@include('front.master.include.footersell')
@endsection

@push('custom-scripts')
<script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>

<script>
    CKEDITOR.replace('content', {
        extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
        mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
        removeButtons: 'PasteFromWord'
    });
</script>

  <script>
    
    $(document).on('submit', 'form#addveritsementadd', function (event) {
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
                            toastr.success("Addvertisement Added Successfully");
                            window.setTimeout(function() {
                                window.location.href = "{{URL::to('advertisment-list')}}"
                            }, 2000);
                        }
                        if(response.success2==false) {   
                            toastr.success("You don't have an active package. Please purchase a package to post.");
                            window.setTimeout(function() {
                                window.location.href = "{{URL::to('advertisment-list')}}"
                            }, 2000);
                        }
                        if(response.success3==false) {   
                            toastr.success("You have reached your free post limit for this month.");
                            window.setTimeout(function() {
                                window.location.href = "{{URL::to('advertisment-list')}}"
                            }, 2000);
                        }
                       
                        if(response.success==false ) {                              
                            for (control in response.errors) {  
                                var error_text = control.replace('.',"_");
                                $('#error-'+error_text).html(response.errors[control]);
                            
                            }
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

       // delete button 
    //   $(document).on('click', '.deleteBtn', function() {
    //     var _this = $(this);
    //     var id = $(this).attr('data-pid');
        
    //         //var table = 'properties';
    //         swal({
    //                 // icon: "warning",
    //                 type: "warning",
    //                 title: "Are You Sure You Want to Delete?",
    //                 text: "",
    //                 dangerMode: true,
    //                 showCancelButton: true,
    //                 confirmButtonColor: "#007358",
    //                 confirmButtonText: "YES",
    //                 cancelButtonText: "CANCEL",
    //                 closeOnConfirm: false,
    //                 closeOnCancel: false
    //             },
    //             function(e) {
    //                 if (e == true) {
    //                     //_this.addClass('disabled-link');
    //                     $.ajax({
    //                         type: "POST",
    //                         dataType: "json",
    //                         url: "{{ route('property-delete-user') }}",
    //                         data: {
    //                             "_token": "{{ csrf_token() }}",
    //                             'id': id,
    //                            // 'table_name': table
    //                         },
    //                         success: function(response) {
    //                             console.log(response);
    //                             // window.setTimeout(function() {
    //                             //     _this.removeClass('disabled-link');
    //                             // }, 2000);

    //                             if (response.success==true ) {
    //                                 window.setTimeout(function() {
    //                                     window.location.reload();
    //                                 }, 2000);
    //                             }
    //                         },
    //                         error: function(response) {
    //                             console.log(response);
    //                         }
    //                     });
    //                     swal.close();
    //                 } else {
    //                     swal.close();
    //                 }
    //             });
    //   });

      
     

     
  
  </script>
@endpush