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
            <div class="col-xxl-3">
              <div class="dashboard_title_area">
                <h2>My Properties</h2>
                <p class="text">We are glad to see you again!</p>
              </div>
            </div>
            <div class="col-xxl-9">
              <div class="dashboard_search_meta d-md-flex align-items-center justify-content-xxl-end">
                <div class="item1 mb15-sm">
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
                </div>
                <a href="{{route('sell')}}" class="ud-btn btn-thm">Add New Property<i class="fal fa-arrow-right-long"></i></a>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-12">
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <div class="packages_table table-responsive">
                  
                  <div class="tab-content site-data-search" id="pills-tabContent"> 
                    @include('front.myproperty_ajax') 
                  </div>

                  <div class="mbp_pagination text-center mt30">
                    {!! $userPropertys->links() !!}
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
<!-- The Login Modal -->
<div class="modal" id="login">
  <div class="modal-dialog">
    <div class="modal-content">

      <!--Login Modal Header -->
      <div class="modal-header">
        <h2 class="modal-title">To Login</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!--Login Modal body -->
      <div class="modal-body">
          <label for="email" class="lab1">Email</label>
          <input type="email" name="email" id="email" class="w-100 rounded-2">
          <label for="password" class="lab1 mt-3">Password</label><br>
          <input type="password" name="password" id="password" class="w-100 rounded-2">
          <input type="checkbox" name="checkbox" id="checkbox" class="rounded-2">
          <label for="checkbox">Keep me login</label>
          <a href="" class="float-end text-decoration-none anc1">Lost your password?</a>
          <a href=""><button class="btn w-100 rounded-4 mt-3"><b>Login</b></button></a>
          <p class="text-center or fortest mt-3">Or</p>
          <a href=""><button class="btn w-100 rounded-pill bt1"><i class="fa-brands fa-google float-start"></i><b>Continue Google</b></button></a>
          <a href=""><button class="btn w-100 mt-3 mb-2 rounded-pill bt2"><i class="fa-brands fa-facebook-f float-start"></i><b>Continue Facebook</b></button></a>
      </div>
      <div class="modal-footer justify-content-center pt-1 pb-0">
          <p class="text-center p1">Not signed up?<a href="" class="anc1"><b> Create an account.</b></a></p>   
      </div>
    </div>
  </div>
</div>

<!-- The Register Modal -->
{{-- <div class="modal" id="register">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Register Modal Header -->
      <div class="modal-header">
        <h2 class="modal-title">To Register</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Register Modal body -->
      <div class="modal-body">
          <p class="para">Create your account so that you can log in to House for Sale in business and manage your data.</p>
          <label for="name" class="lab1">First Name</label>
          <input type="text" name="name" id="name" class="w-100 rounded-2">
          <label for="lname" class="lab1 mt-3">Last Name</label><br>
          <input type="text" name="lname" id="lname" class="w-100 rounded-2">
          <label for="email" class="lab1 mt-3">E-mail Address</label><br>
          <input type="email" name="email" id="email" class="w-100 rounded-2">
          <div class="d-flex df">
          <input type="checkbox" name="checkbox" id="checkbox" class="rounded-2 align-self-start m-1"> 
          <label for="" class="para"> I want to register for news and inspiration from House for Sale, partly based on my profile</label>
        </div>
          <a href=""><button class="btn w-100 rounded-4 mt-3"><b>To Register</b></button></a>
          <p class="para m-0">By signing up you agree to our <a href="" class="text-decoration-none">Terms of Use</a>. 
            Our <a href="" class="text-decoration-none">Privacy Policy</a> applies.</p>
      </div>
      <div class="modal-footer justify-content-center pt-1 pb-0">
           <p class="para1 text-center">Already registered with Julia? <a href="" class="text-decoration-none"><b>Log in here.</b></a></p>
      </div>
    </div>
  </div>
</div> --}}

@include('front.master.include.footersell')
@endsection

@push('custom-scripts')
  <script>
    
       // delete button 
      $(document).on('click', '.deleteBtn', function() {
        var _this = $(this);
        var id = $(this).attr('data-pid');
        
            //var table = 'properties';
            swal({
                    // icon: "warning",
                    type: "warning",
                    title: "Are You Sure You Want to Delete?",
                    text: "",
                    dangerMode: true,
                    showCancelButton: true,
                    confirmButtonColor: "#007358",
                    confirmButtonText: "YES",
                    cancelButtonText: "CANCEL",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(e) {
                    if (e == true) {
                        //_this.addClass('disabled-link');
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "{{ route('property-delete-user') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'id': id,
                               // 'table_name': table
                            },
                            success: function(response) {
                                console.log(response);
                                // window.setTimeout(function() {
                                //     _this.removeClass('disabled-link');
                                // }, 2000);

                                if (response.success==true ) {
                                    window.setTimeout(function() {
                                        window.location.reload();
                                    }, 2000);
                                }
                            },
                            error: function(response) {
                                console.log(response);
                            }
                        });
                        swal.close();
                    } else {
                        swal.close();
                    }
                });
      });

      
      $(document).on('keyup', '#user_search', function(e) {
          e.preventDefault();
          getData(0);
      });

      $(document).on('change','.sort_by_price', function (e){    
        e.preventDefault();
          getData(0);
      });

      function getData(page)
      {
          var user_search = $('#user_search').val() != undefined ? $('#user_search').val() : '';
          var sort_by     = $(".sort_by_price option:selected").val()==undefined?'':$(".sort_by_price option:selected").val();
       
          var loaderPath = "{{asset('icon/spinner.gif')}}";

          $('.site-data-search').html("<div style='background-color:#ddd; min-height:450px; line-height:450px; vertical-align:middle; text-align:center'><img alt='' src='" +
                    loaderPath + "' /></div>").fadeIn(300);
            $.ajax({
              url: '?page='+page+'&user_search='+user_search+'&sort_by='+sort_by,
              type: "get",
              datatype: "html",
            }).done(function(data) {
              $(".site-data-search").empty().html(data);
              $("#overlay").fadeOut(300);
              //debug to check page number
              location.hash = page;
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
              alert('No response from server');
            });
      }

     
  
  </script>
@endpush