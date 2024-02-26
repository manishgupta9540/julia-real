@extends('front.master.index')
@section('title','Property edit')
@section('content')
<style>
    .remove-image{
        font-size: 27px;
    position: absolute;
    color: #f00;
    margin-top: -10px;
    /* margin-right: -38px; */
    border: 1px solid;
    /* padding: 0px 3px; */
    border-radius: 50px;
    width: 24px;
    line-height: 21px;
    height: 24px;
    text-align: center;
    }
</style>
@include('front.master.include.common_sidebar')
<div class="dashboard_content_wrapper">
    <div class="dashboard dashboard_wrapper pr30 pr0-md">
        @include('front.master.include.sidebar')

        <div class="dashboard__main pl0-md">
            <div class="dashboard__content property-page bgc-f7">
              <div class="row align-items-center pb40">
                <div class="col-lg-12">
                  <div class="dashboard_title_area">
                    <h2>Edit Property</h2>
                    <p class="text">We are glad to see you again!</p>
                  </div>
                </div>
              </div>
              <div class="row">
                <form action="{{route('front-property-update')}}" method="post" enctype="multipart/form-data" id="propertyupdated">
                    @csrf
                    <div class="col-xl-12">
                    <div class="ps-widget bgc-white bdrs12 default-box-shadow2 pt30 mb30 overflow-hidden position-relative">
                        <div class="navtab-style1">
                        <nav id="tabpanel">
                            <ul class="nav nav-tabs" id="nav-tab2" role="tablist">
                                <button class="nav-link active fw600 ms-3" id="nav-item1-tab" data-bs-toggle="tab" data-bs-target="#nav-item1" type="button" role="tab" aria-controls="nav-item1" aria-selected="true">1. Description</button>
                                <button class="nav-link fw600" id="nav-item2-tab" data-bs-toggle="tab" data-bs-target="#nav-item2" type="button" role="tab" aria-controls="nav-item2" aria-selected="false">2. Media</button>
                                <button class="nav-link fw600" id="nav-item3-tab" data-bs-toggle="tab" data-bs-target="#nav-item3" type="button" role="tab" aria-controls="nav-item3" aria-selected="false">3. Location</button>
                                <button class="nav-link fw600" id="nav-item4-tab" data-bs-toggle="tab" data-bs-target="#nav-item4" type="button" role="tab" aria-controls="nav-item4" aria-selected="false">4. Detail</button>
                                <button class="nav-link fw600" id="nav-item5-tab" data-bs-toggle="tab" data-bs-target="#nav-item5" type="button" role="tab" aria-controls="nav-item5" aria-selected="false">5. Amenities</button>
                            </ul>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            {{-- <fieldset id="step-1">   --}}
                                <div class="tab-pane fade show active" id="nav-item1" role="tabpanel" aria-labelledby="nav-item1-tab">
                                    <div class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4 class="title fz17 mb30">Property Description</h4>
                                            </div>
                                        </div>
                                        <input type="hidden" name="id" value="{{base64_encode($propertyes->id)}}">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">Title</label>
                                                    <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{$propertyes->title}}">
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Property  Type</label>
                                                <select name="rent_type" id="rent_type" class="form-control">
                                                    <option value="">Select Type</option>
                                                    <option value="1"  {{ $propertyes->is_rent_type == '1' ? 'selected' : '' }}>For Sale</option>
                                                    <option value="2"  {{ $propertyes->is_rent_type == '2' ? 'selected' : '' }}>For Rent</option>
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-rent_type">
                                                </p>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">Description</label>
                                                    <textarea class="form-control content" id="content" placeholder="Enter the Description"name="description">{!!$propertyes->discription!!}</textarea>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-description"></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">Category Name</label>
                                                    <div class="location-area">
                                                        <select class="form-control category_id" name="category_id" id="category_id">
                                                            <option value="">Select Category</option>
                                                            @foreach($categorye as $cate)
                                                                <option value="{{ $cate->id }}" {{ $cate->id == $propertyes->category_id ? 'selected' : '' }}>{{ $cate->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-category_id"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">Listed in</label>
                                                    <div class="location-area">
                                                        <select class="selectpicker" name="listing_status" id="listing_status">
                                                            <option value="">All Listing</option>
                                                            <option value="Active"  {{ $propertyes->listing_status == 'Active' ? 'selected' : '' }}>Active</option>
                                                            <option value="Sold" {{ $propertyes->listing_status == 'Sold' ? 'selected' : '' }}>Sold</option>
                                                            <option value="Processing" {{ $propertyes->listing_status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                                        </select>
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-listing_status"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">Property Status</label>
                                                    <div class="location-area">
                                                        <select class="selectpicker" name="property_status" id="property_status">
                                                            <option value="">All Cities</option>
                                                            <option value="Pending" {{ $propertyes->property_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                            <option value="Processing" {{ $propertyes->property_status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                                            <option value="Published " {{ $propertyes->property_status == 'Published' ? 'selected' : '' }}>Published</option>
                                                        </select>
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-property_status"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <div class="mb30">
                                                    <label class="heading-color ff-heading fw600 mb10">Price</label>
                                                    <input type="text" class="form-control" name="price" id="price" value="{{ $propertyes->price }}" placeholder="Price">
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-price"></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <div class="mb30">
                                                    <label class="heading-color ff-heading fw600 mb10">Yearly Tax Rate</label>
                                                    <input type="text" class="form-control" name="yearly_tax_rate" id="yearly_tax_rate" value="{{ $propertyes->yearly_tax_rate }}" placeholder="Yearly Tax Rate">
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-yearly_tax_rate"></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <div class="mb30">
                                                    <label class="heading-color ff-heading fw600 mb10">After Price Label</label>
                                                    <input type="text" class="form-control" name="price_label" value="{{ $propertyes->price_label  }}" placeholder="After Price Label">
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-price_label"></p>
                                                </div>
                                            </div>
                            
                                            <div class="col-md-12"  id="nav-tab2" role="tablist">
                                                <div class="d-sm-flex" style="float: right">
                                                    <button type="submit" name="next" class="next action-button next-1 ud-btn btn-dark">Next Step</i></button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            {{-- </fieldset>   --}}

                            {{-- <fieldset id="step-2">   --}}
                                <div class="tab-pane fade" id="nav-item2" role="tabpanel" aria-labelledby="nav-item2-tab">
                                    <div class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4 class="title fz17 mb30">Upload photos of your property <p> Image Size (500 x 500) px or Same Ratio</p></h4>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="upload-img position-relative overflow-hidden bdrs12 text-center mb30 px-2">
                                                <div class="icon mb30"><span class="flaticon-upload"></span></div>
                                                <h4 class="title fz17 mb10">Upload photos of your property  </h4>
                                                <p class="text mb25">Photos must be JPEG or PNG format and least 2048x768</p>
                                                <a class="ud-btn btn-white" href="#">Browse Files<i class="fal fa-arrow-right-long"></i></a>
                                                <div class="text-center">
                                                    <input type="file" name="attachment[]" multiple="multiple" class="browse-file" id="attachment">
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-attachment"></p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @if(count($property_attachment)>0)
                                            <label><strong>Attachments: </strong></label>
                                            <div class="row">
                                                @foreach($property_attachment as $item)
                                                    @if(stripos($item->attachment, 'pdf')!==false) 
                                                        <img src="admin/images/icon_pdf.png" class="w-100" title="file_name" alt="preview" />
                                                    @else
                                                    <div class="col-2">
                                                        <div class="image-area" style="width:110px;">
                                                            <img src="{{asset('/uploads/property/'.$item->attachment)}}" title="file_name" alt="preview" class="w-100">
                                                            <a class="remove-image" data-id="{{ $item->id }}" href="javascript:;" style="display: inline;">×</a>
                                                            <input type="hidden" name="fileID[]" value="{{ $item->id }}">
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="col-md-12" id="nav-tab1" role="tablist">
                                                <div class="d-sm-flex justify-content-between">
                                                    <input type="button" name="pre" class="pre action-button-pre ud-btn btn-dark" value="Prev" />  
                                                    <button type="submit" name="next" class="next action-button next-2 ud-btn btn-dark">Next Step</button>  
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>    
                            {{-- </fieldset> --}}

                            {{-- <fieldset class="step-3">   --}}
                                <div class="tab-pane fade" id="nav-item3" role="tabpanel" aria-labelledby="nav-item3-tab">
                                    <div class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4 class="title fz17 mb30">Listing Location</h4>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">Address</label>
                                                    <input type="hidden" id="lat" name="lat" value="">
                                                    <input type="hidden" id="lng" name="lng" value="">
                                                    <input type="text" class="form-control" id="address" name="address" value="{{ $property_locations->address }}" placeholder="Address">
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-address"></p>
                                                </div>
                                            </div>
                                            <div id="autocomplete-container"></div>
                                            <div class="col-sm-6 col-xl-4">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw600 mb10">Country</label>
                                                <input type="text" class="form-control" id="country" name="country" value="{{ $property_locations->country_id }}" placeholder="Country">
                                                {{-- <select class="form-control country" name="country_id" id="country_id">
                                                    <option value="">Select Country</option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}" @if($country->id == $propertie->country_id) selected @endif> {{ $country->name }}</option>
                                                    @endforeach
                                                </select> --}}
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-country"></p>
                                            </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">State</label>
                                                    <input type="text" class="form-control" id="state" name="state" value="{{ $property_locations->state_id }}" placeholder="State">
                                                    {{-- <select class="form-control state" name="state_id" id="state_id">
                                                        <option value="">Select State</option>
                                                        @foreach ($state as $states)
                                                            <option value="{{ $states->id }}" @if($states->id == $propertie->state_id) selected @endif>{{ $states->name }}</option>
                                                        @endforeach
                                                    </select> --}}
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-state"></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">City</label>
                                                    <input type="text" class="form-control" id="city" name="city" value="{{ $property_locations->city_id }}" placeholder="City">
                                                    {{-- <select class="form-control" name="city_id" id="city_id">
                                                        @foreach($citie as $city)
                                                        <option value="{{ $city->id }}" @if($city->id == $property_locations->city_id) selected @endif>{{ $city->name }}</option>
                                                     @endforeach
                                                    </select> --}}
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-city"></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw600 mb10">Neighborhood</label>
                                                <input type="text" class="form-control" id="neighborhood" name="landmark" value="{{ $property_locations->landmark }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-landmark"></p>
                                            </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw600 mb10">Zip</label>
                                                <input type="text" class="form-control" id="postal_code" name="zip_code" value="{{ $property_locations->zip_code}}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-zip_code"></p>
                                            </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-sm-flex justify-content-between">
                                                    <input type="button" name="pre" class="pre action-button-pre ud-btn btn-dark" value="Prev" />  
                                                    <button type="submit" name="next" class="next action-button next-3 ud-btn btn-dark">Next Step</button>   
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            {{-- </fieldset>   --}}

                            {{-- <fieldset class="step-4">  --}}
                                <div class="tab-pane fade" id="nav-item4" role="tabpanel" aria-labelledby="nav-item4-tab">
                                    <div class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4 class="title fz17 mb30">Listing Detail</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6 col-xl-4">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw600 mb10">Size in ft (only numbers)</label>
                                                <input type="text" class="form-control" name="size_in_ft" value="{{$property_details->size_in_ft }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-size_in_ft"></p>
                                            </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw600 mb10">PLot size in ft (only numbers)</label>
                                                <input type="text" class="form-control" name="lot_size_in_ft" value="{{ $property_details->lot_size_in_ft }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-lot_size_in_ft"></p>
                                            </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw600 mb10">Rooms</label>
                                                <input type="text" class="form-control" name="rooms" value="{{ $property_details->rooms }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-rooms"></p>
                                            </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw600 mb10">Bedrooms</label>
                                                <input type="text" class="form-control" name="bedrooms" value="{{ $property_details->bedrooms }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-bedrooms"></p>
                                            </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw600 mb10">Bathrooms</label>
                                                <input type="text" class="form-control" name="bathrooms" value="{{ $property_details->bathrooms }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-bathrooms"></p>
                                                
                                            </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw600 mb10">Custom ID (text)</label>
                                                <input type="text" class="form-control" name="custom_id" value="{{ $property_details->custom_id }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-custom_id"></p>
                                            </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw600 mb10">Garages</label>
                                                <input type="text" class="form-control" name="garages" value="{{ $property_details->garages }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-garages"></p>
                                            </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw600 mb10">Garage size</label>
                                                <input type="text" class="form-control" name="garage_size" value="{{ $property_details->garage_size }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-garage_size"></p>
                                            </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw600 mb10">Year built (numeric)</label>
                                                <input type="text" name="year_built" class="form-control dob commonDatepicker" value="{{ $property_details->year_built }}" placeholder=""  autocomplete="off">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-year_built"></p>
                                            </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw600 mb10">Available from (date)</label>
                                                <input type="date" class="form-control" name="available_date" value="{{ $property_details->available_date}}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-available_date"></p>
                                            </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw600 mb10">Basement</label>
                                                <input type="text" class="form-control" name="basement" value="{{ $property_details->basement }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-basement"></p>
                                            </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw600 mb10">Extra details</label>
                                                <input type="text" class="form-control" name="extra_details" value="{{ $property_details->extra_details }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-extra_details"></p>
                                            </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw600 mb10">Roofing</label>
                                                <input type="text" class="form-control" name="roofing" value="{{ $property_details->roofing }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-roofing"></p>
                                            </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">Exterior Material</label>
                                                    <input type="text" class="form-control" name="exterior_material" value="{{$property_details->exterior_material}}" placeholder="">
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-exterior_material"></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                                <div class="mb20">
                                                    <label class="heading-color ff-heading fw600 mb10">Floors no</label>
                                                    <div class="location-area">
                                                        <select class="selectpicker" name="floors_no">
                                                            <option value="">Select Floors</option>
                                                            <option value="1st" {{ $property_details->floors_no == '1st' ? 'selected' : '' }}>1st</option>
                                                            <option value="2nd" {{ $property_details->floors_no == '2nd' ? 'selected' : '' }}>2nd</option>
                                                            <option value="3rd" {{ $property_details->floors_no == '3rd' ? 'selected' : '' }}>3rd</option>
                                                            <option value="4th" {{ $property_details->floors_no == '4th' ? 'selected' : '' }}>4th</option>
                                                            <option value="5th" {{ $property_details->floors_no == '5th' ? 'selected' : '' }}>5th</option>
                                                            <option value="6th" {{ $property_details->floors_no == '6th' ? 'selected' : '' }}>6th</option>
                                                            <option value="7th" {{ $property_details->floors_no == '7th' ? 'selected' : '' }}>7th </option>
                                                        </select>
                                                        <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-floors_no"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            
                                            <div class="col-sm-12">
                                            <div class="mb20">
                                                <label class="heading-color ff-heading fw600 mb10">Owner/ Agent notes (not visible onfront end)</label>
                                                <textarea class="form-control agent_notes" id="agent_notes" placeholder="Enter the Description"name="agent_notes">{!!$property_details->agent_notes!!}</textarea>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-agent_notes"></p>
                                            </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                            <div class="mb30">
                                                <label class="heading-color ff-heading fw600 mb10">Energy Class</label>
                                                <div class="location-area">
                                                    <select class="selectpicker" name="energy_class">
                                                        <option value="">All Listing</option>
                                                        <option value="Active"  {{ $property_details->energy_class == 'Active' ? 'selected' : '' }}>Active</option>
                                                        <option value="Sold"  {{ $property_details->energy_class == 'Sold' ? 'selected' : '' }}>Sold</option>
                                                        <option value="Processing"  {{ $property_details->energy_class == 'Processing' ? 'selected' : '' }}>Processing</option>
                                                    </select>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-energy_class"></p>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-sm-6 col-xl-4">
                                            <div class="mb30">
                                                <label class="heading-color ff-heading fw600 mb10">Energy index in kWh/m2a</label>
                                                <div class="location-area">
                                                    <select class="selectpicker" name="energy_index">
                                                        <option value="">All Cities</option>
                                                        <option value="Active"   {{ $property_details->energy_index == 'Active' ? 'selected' : '' }}>Pending</option>
                                                        <option value="Processing" {{ $property_details->energy_index == 'Processing' ? 'selected' : '' }}>Processing</option>
                                                        <option value="Published"  {{ $property_details->energy_index == 'Published' ? 'selected' : '' }}>Published</option>
                                                    </select>
                                                    <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-energy_index"></p>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="d-sm-flex justify-content-between">
                                                    <input type="button" name="pre" class="pre action-button-pre ud-btn btn-dark" value="Prev" />  
                                                    <button type="submit" name="next" class="next action-button next-4 ud-btn btn-dark">Next Step</button>     
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            {{-- </fieldset> --}}

                            {{-- <fieldset class="step-5">  --}}
                                <div class="tab-pane fade" id="nav-item5" role="tabpanel" aria-labelledby="nav-item5-tab">
                                    <div class="ps-widget bgc-white bdrs12 p30 overflow-hidden position-relative">
                                        @php
                                                $values = explode(",",$property_details->amenities_id);
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-6">
                                                 <h4 class="title fz17 mb30">Select Amenities</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @if (count($aminities) > 0)
                                                @foreach ($aminities as $aminitie)
                                                    <div class="col-sm-4 col-lg-3">
                                                        <div class="checkbox-style1">
                                                            <label class="custom_checkbox">{{ $aminitie->amenities_name }}
                                                                <input type="checkbox" value="{{ $aminitie->id }}" {{ in_array($aminitie->id,$values) ? 'checked' : '' }} name="aminities_id[]">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-aminities_id"></p>
                                    
                                                <div class="col-md-12 mt30">
                                                    <div class="d-sm-flex justify-content-between">
                                                        <input type="button" name="pre" class="pre action-button-pre ud-btn btn-dark" value="Prev" />  
                                                        <button type="submit" class="ud-btn btn-thm">Submit Property<i class="fal fa-arrow-right-long"></i></button> 
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- </fieldset> --}}
                        </div>
                        </div>
                    </div>
                    </div>
                </form>
              </div>
            </div>

        @include('front.master.include.footersell')
    </div>
</div>

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
        CKEDITOR.replace('agent_notes', {
            extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
            mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
            removeButtons: 'PasteFromWord'
        });
    </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4Bec1p6cCz6VvI3oRvWAyh0VBI9FOmw4&libraries=places&callback=initAutocomplete"async defer></script>

<script>

        function initAutocomplete() {
            const locationInput = document.getElementById('address');
            const lat = document.getElementById('lat');
            const lng = document.getElementById('lng');
           
            const autocompleteContainer = document.getElementById('autocomplete-container');
            const autocomplete = new google.maps.places.Autocomplete(locationInput);
            // autocomplete.bindTo('bounds', map);
            const place = autocomplete.getPlace();
            autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                locationInput.value = place.formatted_address;

                var latitude   = place.geometry.location.lat();
                var longitude  = place.geometry.location.lng();
                var value      =    $("#neighborhood").val('');
                var latlng     = new google.maps.LatLng(latitude,longitude);
                var geocoder   = (geocoder = new google.maps.Geocoder());
                
                lat.value = latitude;
                lng.value = longitude;

                //Location details
                for (var i = 0; i < place.address_components.length; i++) {
                    if(place.address_components[i].types[0] == "country"){              
                        document.getElementById('country').value = place.address_components[i].long_name;
                    } 

                    if(place.address_components[i].types[0] == "administrative_area_level_1"){              
                        document.getElementById('state').value = place.address_components[i].long_name;
                    } 

                    if(place.address_components[i].types[0] == 'locality'){              
                        document.getElementById('city').value = place.address_components[i].long_name;
                    } 

                    if(place.address_components[i].types[0] == 'neighborhood'){              
                        document.getElementById('neighborhood').value = place.address_components[i].long_name;
                    }

                    if(place.address_components[i].types[0] == 'postal_code'){              
                        document.getElementById('postal_code').value = place.address_components[i].long_name;
                    }        
                }
            });
        }

        $(document).ready(function(){
            var current_fs, next_fs, pre_fs;   
            var opacity;  
            var current = 1;  
            var steps = $("nav-item1").length; 
        
            $(document).on('submit', 'form#propertyupdated', function (event) {
                event.preventDefault();
                //clearing the error msg
                $('p.error_container').html("");
                
                var form = $(this);
                var data = new FormData($(this)[0]);
                data.append('step',current);
                var url = form.attr("action");
               
                    $.ajax({
                        type: form.attr('method'),
                        url: url,
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,      
                        success: function (response) {
                            window.setTimeout(function(){
                                if(current==5)
                                {
                                    $('.next-'+current).html('Submit');
                                }
                                else
                                {
                                    $('.next-'+current).html('Next Step');
                                }
                            },2000);
                            // console.log(response);
                            if(response.success==true) { 
                                $('#nav-item'+(current)+'-tab').removeClass('active');
                                $('#nav-item'+(current+1)+'-tab').click();
                                
                                if (current == 5) {
                                    toastr.success("Your property updated Successfully!");
                                    window.location.href = "{{URL::to('my-property')}}"
                                }
                                current++;
                            
                            }
                            else if(response.success==false && response.error_type=='message')
                            {
                                toastr.error(response.message);
                            }
                            else if(response.success==false && response.error_type=='validation') {                              
                                for (control in response.errors) {  
                                    var error_text = control.replace('.',"_");
                                    $('#error-'+error_text).html(response.errors[control]);
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

            $(".pre").click(function() {  
                $('#nav-item'+(current)+'-tab').removeClass('active');
                $('#nav-item'+(current-1)+'-tab').click();
                current--;    
            });

        });

        //on change country
        $(document).on('change','.country',function(){ 
            var id = $('#country_id').val();
        
            $.ajax({
                    type:"post",
                    url:"{{route('/front/getstate')}}", 
                    data:{'country_id':id,"_token": "{{ csrf_token() }}"},
                    success:function(data)
                    {       
                        // console.log(data);
                        $("#state_id").empty();
                        $("#state_id").html('<option value="">Select State</option>');
                        $.each(data,function(key,value){
            
                            $("#state_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }
                });
                event.stopImmediatePropagation();
                return false;
        });

        // on change state
        $(document).on('change','.state',function(){ 
            var id = $('#state_id').val();
          
            $.ajax({
                    type:"post",
                    url:"{{route('/front/getcity')}}", 
                    data:{'state_id':id,"_token": "{{ csrf_token() }}"},
                    success:function(data)
                    {       
                        $("#city_id").empty();
                        $("#city_id").html('<option value="">Select City</option>');
                        $.each(data,function(key,value){
                        $("#city_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                        }); 
                    }

                });
                event.stopImmediatePropagation();
                return false;
        });


        //image id wise deleted
        $(document).on('click','.remove-image',function(){ 
            var current = $(this);
            var id = $(this).attr('data-id');
    
            swal({
                // icon: "warning",
                type: "warning",
                title: "Are You Want to Remove?",
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
                        var fd = new FormData();

                        fd.append('id',id);
                        fd.append('_token', '{{csrf_token()}}');

                        $.ajax({
                            type: 'POST',
                            url: "{{ route('/front/property/image/remove') }}",
                            data: fd,
                            processData: false,
                            contentType: false,
                            success: function(data) {
                                // console.log(data);
                                if (data.fail == false) {
                                //reset data
                                $('.fileupload').val("");
                                //append result
                                $(current).parent('.image-area').detach();
                                } else {
                                
                                console.log("file error!");
                                
                                }
                            },
                            error: function(error) {
                                console.log(error);
                                // $(".preview_image").attr("src","{{asset('images/file-preview.png')}}"); 
                            }
                        });
                        swal.close();
                    }
                    else
                    {
                        swal.close();
                    }
                });
        });
        

       	//image show
        $(document).on('change','#attachment',function(){
            let reader = new FileReader();
            reader.onload = (e) => { 
                $('#preview_img').attr('src', e.target.result); 
                $('.close_btn').removeClass('d-none');
            }
            reader.readAsDataURL(this.files[0]); 

        });

        
        
    </script>
    @endpush
