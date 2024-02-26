<div id='categoryes'>
    <div class="tab-pane fade show active" id="pills-house" role="tabpanel" aria-labelledby="pills-house-tab">
        <div class="row">
            @foreach ($propertyesrecomend as $propertyes)
                <?php
                    $property_attachments = DB::table('property_attachments')->where('properti_id',$propertyes->id)->first();
                ?>
            <div class="col-md-6 col-xl-4 showcategorye">
                <div class="listing-style6">
                    <div class="list-thumb">
                        <a href="{{url('details/'.base64_encode($propertyes->id))}}">
                            <img class="w-100" src="{{ asset('uploads/property/'.$property_attachments->attachment) }}" alt="">
                        </a>
                        <div class="list-tag fz12"><span class="flaticon-electricity me-2"></span>FEATURED</div>
                        @if ($propertyes->is_rent_type==1)
                            <div class="list-tag2 fz12">FOR SALE</div>
                        @elseif($propertyes->is_rent_type==2)
                            <div class="list-tag2 fz12">FOR RENT</div>
                        @endif
                        <div class="list-meta">
                            <div class="icons">
                                @php
                                    $wish = DB::table('wishlishts')
                                            ->where('product_id', $propertyes->id)
                                            ->where('user_id', Auth::id())
                                            ->get();
                                @endphp
                                @if ($wish->isNotEmpty())
                                    <a href="javascript:void(0)" data-id="{{ $propertyes->id }}"
                                        class="addTowishlisht like-icon rounded-circle">
                                        <i class="fa-solid fa-heart" style="color:red"></i>
                                    </a>
                                @else
                                    @if (Auth::check())
                                    <a href="javascript:void(0)" data-id="{{ $propertyes->id }}" class="addTowishlisht like-icon rounded-circle">
                                        <i class="fa-solid fa-heart"></i>
                                    </a>
                                    @else
                                    <a href="javascript:void(0)" data-id="{{ $propertyes->id }}" data-bs-toggle="modal" data-bs-target="#login" class="addTowishlisht like-icon rounded-circle">
                                        <i class="fa-solid fa-heart"></i>
                                    </a>
                                    @endif
                                @endif
                               
                            </div>
                        </div>
                    </div>
                    <div class="list-content">
                        <?php
                            $pricevalue  = $propertyes->price;
                            $newprice = (int)$pricevalue;
                        ?>
                                                
                        <div class="list-price mb-2">SRD {{ $newprice }}</div>
                        <h6 class="list-title"><a href="{{url('details/'.base64_encode($propertyes->id))}}">{{$propertyes->title}}</a></h6>
                         <p class="list-text">{!! Str::limit($propertyes->address, 25, ' ...') !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>