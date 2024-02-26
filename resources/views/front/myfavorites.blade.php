@extends('front.master.index')
@section('title','My favorites')
@section('content')

@include('front.master.include.common_sidebar')
<style>
  footer.dashboard_footer {
    margin-left: 20%;
  }
</style>
<div class="dashboard_content_wrapper">

  <div class="dashboard dashboard_wrapper pr30 pr0-md">

    @include('front.master.include.sidebar')
    
      <div class="dashboard__main pl0-md">
        <div class="dashboard__content property-page bgc-f7">

          <div class="row align-items-center pb40">
            <div class="col-lg-12">
              <div class="dashboard_title_area">
                <h2>My Favorites</h2>
                <p class="text">We are glad to see you again!</p>
              </div>
            </div>
          </div>

           <div class="row">
            <div class="col-xl-12">
              <div class="ps-widget bgc-white bdrs12 default-box-shadow2 p30 p20-xs mb30 overflow-hidden position-relative">

                <div class="row">
                  @if (count($wishlishts)>0)
                    @foreach ($wishlishts as $wishlisht)
                      <div class="col-sm-6 col-xl-3">
                        <?php  
                              $property_attachments = DB::table('property_attachments')->where('properti_id',$wishlisht->id)->first();
                              // dd($property_attachments);
                        ?>
                        <div class="listing-style1 style2">
                          <div class="list-thumb">

                            <a href="javascript:void(0)" class="tag-del wishlishtdeleted" data-id="{{$wishlisht->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Item"><span class="fas fa-trash-can"></span></a>

                            <img class="w-100" src="{{ asset('uploads/property/'.$property_attachments->attachment) }}" alt="">
                            @if ($wishlisht->is_featured == 1)
                              <div class="list-tag fz12"><span class="flaticon-electricity me-2"></span>FEATURED</div>
                            @endif
                            <?php  
                              $newvalue  = $wishlisht->price;
                              $pricenew = (int)$newvalue;
                            ?>
                            <div class="list-price">SRD {{$pricenew}}</div>
                          </div>
                          <div class="list-content">
                            <h6 class="list-title"><a href="#">{{$wishlisht->title}}</a></h6>
                            <p class="list-text">{{$wishlisht->address}}</p>

                            <div class="list-meta d-flex align-items-center">
                              <a href="#"><span class="flaticon-bed"></span>{{$wishlisht->bedrooms}} bed  </a>
                              <a href="#"><span class="flaticon-shower"></span>{{$wishlisht->bathrooms}} bath</a>
                              <a href="#"><span class="flaticon-expand"></span>{{$wishlisht->size_in_ft}} </a>
                            </div>

                            <hr class="mt-2 mb-2">
                            <div class="list-meta2 d-flex justify-content-between align-items-center">
                              <span class="for-what">For Rent</span>
                              <div class="icons d-flex align-items-center">
                                {{-- <a href="#"><span class="flaticon-like"></span></a> --}}
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  @else
                    <div class="row">
                      <div class="no-up">
                          <div style="text-align:center;padding-top: 25px;">
                              <h2 class="noupcom">There is No Product available.</h2>
                          </div>
                      </div>
                    </div>
                  @endif 
                </div>
                <div class="row">
                  <div class="mbp_pagination text-center">
                    <ul class="page_navigation">
                      {!!$wishlishts->links()!!}
                      {{-- <li class="page-item">
                        <a class="page-link" href="#"> <span class="fas fa-angle-left"></span></a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">4</a></li>
                      <li class="page-item"><a class="page-link" href="#">5</a></li>
                      <li class="page-item"><a class="page-link" href="#">...</a></li>
                      <li class="page-item"><a class="page-link" href="#">20</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#"><span class="fas fa-angle-right"></span></a>
                      </li> --}}
                    </ul>
                    {{-- <p class="mt10 pagination_page_count text-center">1 – 20 of 300+ property available</p> --}}
                  </div>
                </div>
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
    $(document).ready(function(){
        $(document).on('click', '.wishlishtdeleted', function (event) {
            var product_id = $(this).attr('data-id');
           
          $.ajax({
              method: 'get',
              url: "{{ url('/delete-to-wishlisht') }}",
              data: {
                  'product_id':product_id,
              },
          
              success: function(response) {
                   window.location.reload();
                
                  Swal.fire('',response.status,"success");
              }
          });
        }); 
    });
</script>

@endpush