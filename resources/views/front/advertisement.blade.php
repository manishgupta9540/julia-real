@extends('front.master.index')

@section('title','Advertisement')

@section('content')
@include('front.master.include.common_sidebar')
<section class="breadcumb-section2 p-0">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="breadcumb-style1">
              <h2 class="title text-center text-white">{{ $data->title  ?? ''}}</h2>
              <div class="breadcumb-list text-center text-white">
                  <a class="text-white" href="{{route('home')}}">Home</a>
                  <a class="text-white" href="#">Advertisement Packages</a>
              </div>
            </div>
          </div>
        </div>
      </div>
</section>

 <section class="py-5 border-bottoms">
        
        <div class="axil-checkout-area axil-section-gap foot-pages">
            <div class="container mt-5 pt-5 advertisement-container">
                <div class="row julias-rows">
                    <div class="col-md-12 col-12 p-5 julias-cols-add">
                        
                   
            @if($data->description  ?? '')
                <p class="w-100">{!!$data->description!!}</p>
            @else
            </div>
                </div>
            <div class="row">
                <div class="no-up">
                    <div class="noenquery for-margin" style="text-align: center">
                         <img src="{{asset('front/no-data.gif')}}" alt="Girl in a jacket">
                    </div>
                    <div style="text-align:center;padding-top: 25px;">
                        <span class="noupcom">There is no post available.</span>
                    </div>
                </div>
                @endif

            </div>
        </div>
        
</section>

<section class="our-pricing pb90 bgc-f7">
      <div class="container">
       
        <div class="row wow fadeInUp" data-wow-delay="300ms" style="visibility: visible; animation-delay: 300ms; animation-name: fadeInUp;">
            @if(isset($packages))
                @foreach ($packages as $packag)
                    <div class="col-md-6 col-xl-3">
                        <div class="pricing_packages advertisement-pack">
                            <div class="heading mb60">
                                <h4 class="package_title">{{$packag->package_name}}</h4>
                                <img class="price-icon" src="images/icon/pricing-icon-2.svg" alt="">
                            </div>
                            <div class="details">
                                <p class="text mb35">{{$packag->description}}</p> 
                                <div class="list-style1 mb40 advertisement-cards">
                                
                                    <ul>
                                        <li><i class="far fa-check text-white bgc-dark fz15"></i>SRD {{$packag->price}}/maand</li>
                                    </ul>
                                </div>
                                
                                <?php 
                                    $packagePrice = $packag->price;
                                    $paymentsCounts = DB::table('payments')->where('package_name','Basic')->count();
                                    $paymentsprice = DB::table('payments')->where('package_id',$packag->id)->count();
                                ?>
                                @if ($packagePrice == 0)
                                    @if (Auth::check())
                                        @if ($paymentsCounts)
                                            <div class="d-grid">
                                                <a href="Javascript:void(0)" data-id="{{ $packag->id }}" data-package="{{$packag->package_name}}" data-price="{{ $packag->price}}" class="ud-btn btn-thm-border text-thm purchasefree">Free</a>
                                            </div>
                                        @else
                                            <div class="d-grid">
                                                <a href="Javascript:void(0)" data-id="{{ $packag->id }}" data-package="{{$packag->package_name}}" data-price="{{ $packag->price}}" class="ud-btn btn-thm-border text-thm adveritisepackage">Free</a>
                                            </div>
                                        @endif
                                        
                                    @else
                                        <div class="d-grid">
                                            <a href="Javascript:void(0)" data-id="{{ $packag->id }}" data-package="{{$packag->package_name}}" data-price="{{ $packag->price}}" class="ud-btn btn-thm-border text-thm adveritisepackage" data-bs-toggle="modal" data-bs-target="#login">Free</a>
                                        </div>
                                    @endif 
                                @elseif($packagePrice != 0)
                                    
                                    @if (Auth::check())
                                        @if ($paymentsprice)
                                            <div class="d-grid">
                                                <a href="Javascript:void(0)" data-id="{{ $packag->id }}" class="ud-btn btn-thm-border text-thm adveritisepackagebyprice">Make A Payment</a>
                                            </div>
                                        @else
                                            <div class="d-grid">
                                                <a href="{{ url('stripe_payment/'.base64_encode($packag->id)) }}" class="ud-btn btn-thm-border text-thm">Make A Payment</a>
                                            </div>
                                        @endif
                                       
                                    @else
                                        <div class="d-grid">
                                            <a href="{{ url('stripe_payment/'.base64_encode($packag->id)) }}" class="ud-btn btn-thm-border text-thm" data-bs-toggle="modal" data-bs-target="#login">Make A Payment</a>
                                        </div>
                                    @endif 
                                @endif   
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
      </div>
    </section>

    
@include('front.master.include.footer')

@endsection

@push('custom-scripts')
  <script>
    //free package 
    $(document).on('click', '.adveritisepackage', function() {
        var _this = $(this);
        var id = $(this).attr('data-id');
        var packageName = $(this).attr('data-package');
        var packageprice = $(this).attr('data-price');
    
        $.ajax({
                type:'GET',
                url: "{{route('/basicpackageby')}}",
                data: {'id':id,'packageName': packageName,'packageprice':packageprice},        
                success: function (response) {        
                if(response.success==true) {   
                    toastr.success("Advertisment Package Purchase Successfully");
                    window.setTimeout(function() {
                        window.location.href = "{{URL::to('advertisement-packages')}}"
                    }, 2000);
                }
                if(response.success1==false) {   
                    toastr.success("You Have allready purchase Plan");
                    window.setTimeout(function() {
                        window.location.href = "{{URL::to('advertisement-packages')}}"
                    }, 2000);
                }
                //show the form validates error
                if(response.success==false ) {                              
                    for (control in response.errors) {  
                        var error_text = control.replace('.',"_");
                        $('#error-'+error_text).html(response.errors[control]);
                    }
                }
            },
            error: function (xhr, textStatus, errorThrown) {
                // alert("Error: " + errorThrown);
            }
        });
    });

    // free package count allready exists
    $(document).on('click', '.purchasefree', function() {
        var _this = $(this);
        var id = $(this).attr('data-id');
        var packageName = $(this).attr('data-package');
        var packageprice = $(this).attr('data-price');
        
        var table = 'payments';
        swal({
                // icon: "warning",
                type: "warning",
                title: "Are you sure you want purchase plan for next month?",
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
                    _this.addClass('disabled-link');
                    $.ajax({
                        type: "get",
                        dataType: "json",
                        url: "{{ route('/basicpackageby') }}",
                        data: {
                            'id':id,
                            'packageName': packageName,
                            'packageprice':packageprice,
                            'table_name': table
                        },
                        success: function(response) {
                            console.log(response);
                            window.setTimeout(function() {
                                _this.removeClass('disabled-link');
                            }, 2000);

                            if (response.success==true ) {
                                window.setTimeout(function() {
                                    toastr.success("Advertisment Package Purchase Successfully");
                                   // window.location.reload();
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
            }
        );
    });
        

     //buy price package 
    $(document).on('click', '.adveritisepackagebyprice', function() {
        var _this = $(this);
        var id = $(this).attr('data-id');
        var id_decode =btoa(id);
    
        // var table = 'payments';
        swal({
                // icon: "warning",
                type: "warning",
                title: "Are you sure you want purchase plan for next month?",
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
                    window.setTimeout(function() {
                        window.location.href = "{{URL::to('stripe_payment')}}"+'/'+id_decode;
                    }, 2000);
                    swal.close();
                } else {
                    swal.close();
                }
            }
        );
    });
  </script>
@endpush