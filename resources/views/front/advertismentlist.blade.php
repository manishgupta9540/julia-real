@extends('front.master.index')
@section('title','My advertisement')
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
                <h2>My Advertisement</h2>
                
              </div>
            </div>
            <div class="col-xxl-6">
              <div class="dashboard_search_meta d-md-flex align-items-center justify-content-xxl-end">
                <?php 
                  $packagePlan = DB::table('payments')->where('user_id',Auth::user()->id)->count(); 
                ?>
                @if($packagePlan == 0)
                  <a href="javascript:void(0)" class="ud-btn btn-thm packageplan">Add Advertisement<i class="fal fa-arrow-right-long"></i></a>  
                @else
                  <a href="{{route('add-addvertisement')}}" class="ud-btn btn-thm">Add Advertisement<i class="fal fa-arrow-right-long"></i></a>
                @endif

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-xl-12">
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 mb30 overflow-hidden position-relative">
                <div class="packages_table table-responsive">
                  
                  <div class="tab-content site-data-search" id="pills-tabContent"> 
                    <table class="table-style3 table at-savesearch">
                        <thead class="t-head">
                        <tr>
                            <th scope="col">Image</th>
                            <th scope="col">Url</th>
                            <th scope="col">Package Name</th>
                            {{-- <th scope="col">Action</th> --}}
                        </tr>
                        </thead>
                        <tbody class="t-body">
                        @foreach ($addLists as $addList)
                            <tr>
                                <th scope="row">
                                    <div class="listing-style1 dashboard-style d-xxl-flex align-items-center mb-0">
                                        <div class="list-thumb">
                                            <img class="w-100" src="{{ asset('uploads/package/'.$addList->image) }}" alt="">
                                        </div>
                                    </div>
                                </th>
                                <td class="vam">{{ $addList->url }}</td>
                                <td class="vam"><span class="pending-style style1">{{$addList->package_name}}</span></td>
                            </tr>
                        @endforeach
                        
                        </tbody>
                    </table>
                  </div>

                  <div class="mbp_pagination text-center mt30">
                      {{$addLists->links()}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>




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

      //alert toaster
      $(document).on('click', '.packageplan', function(event) {
          toastr.success("You don't have an active package. Please purchase a package to post.");
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