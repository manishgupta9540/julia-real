@extends('admin.master.index')

@section('title', 'Add Prperty')

@section('content')

    <style>
        .box {
            width: 800px;
            margin: 0 auto;
        }

        .active_tab1 {
            background-color: #fff;
            color: #333;
            font-weight: 600;
        }

        .inactive_tab1 {
            background-color: #f5f5f5;
            color: #333;
            cursor: not-allowed;
        }

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

    <div class="col-12">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-11">
                <div class="form-body">
                    <div class="card radius shadow-sm">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="card-title mb-1 mt-3">Create a New Property </h4>
                                    <p class="pb-border"> </p>
                                </div>
                            </div>
                            <?php
                                $newvalue = 1;
                            ?>
                            <form action="{{ route('property-update') }}" method="post" enctype="multipart/form-data" id="propertycreate">
                                @csrf
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="itme-tab1" data-toggle="tab" href="#nav-item1-tab">1.Description</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="itme-tab2" data-toggle="tab" href="#nav-item2-tab">2.Media</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="itme-tab3" data-toggle="tab"  href="#nav-item3-tab">3.Location</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="itme-tab4" data-toggle="tab" href="#nav-item4-tab">4.Detail</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="itme-tab5" data-toggle="tab" href="#nav-item5-tab">5.Amenities</a>
                                    </li>
                                </ul>

                                <!-- Tab panes -->
                                <div class="tab-content">

                                    <div id="nav-item1-tab" class="container tab-pane active"><br>
                                        <h4 class="title fz17 mb30">Property Description</h4>
                                        <div class="row">
                                            <input type="hidden" name="id" value="{{base64_encode($properties->id)}}">
                                            <div class="col-md-4">
                                                <label class="heading-color ff-heading fw600 mb10">Title</label>
                                                <input type="text" class="form-control" name="title" id="title"
                                                    placeholder="Title" value="{{ $properties->title}}">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title"></p>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="heading-color ff-heading fw600 mb10">Customer Name</label>
                                                <select name="customer_id" id="customer_id" class="form-control">
                                                    <option value="">Select Customer</option>
                                                    @foreach ($users as $user)
                                                        <option value="{{$user->id}}" {{ $user->id == $properties->customer_id ? 'selected' : '' }}>{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-title">
                                                </p>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="heading-color ff-heading fw600 mb10">Property Type</label>
                                                <select name="rent_type" id="rent_type" class="form-control">
                                                    <option value="">Select Type</option>
                                                    <option value="1" {{ $properties->is_rent_type == '1' ? 'selected' : '' }}>For Sale</option>
                                                    <option value="2" {{ $properties->is_rent_type == '2' ? 'selected' : '' }}>For Rent</option>
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-rent_type">
                                                </p>
                                            </div>
                                        </div>
                                        

                                        <label class="heading-color ff-heading fw600 mb10">Description</label>
                                        <textarea class="form-control content" id="content" placeholder="Enter the Description"name="description">{!!$properties->discription!!}</textarea>
                                        <p style="margin-bottom: 2px;" class="text-danger error_container"
                                            id="error-description"></p>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Category Name</label>
                                                <select class="form-control category_id" name="category_id"
                                                    id="category_id">
                                                    <option value="">Select Category</option>
                                                    @foreach ($categorye as $cate)
                                                        <option value="{{ $cate->id }}" {{ $cate->id == $properties->category_id ? 'selected' : '' }}>{{ $cate->name }}</option>
                                                    @endforeach
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-category_id"></p>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Listed in</label>
                                                <select class="form-control" name="listing_status" id="listing_status">
                                                    <option value="">All Listing</option>
                                                    <option value="Active" {{ $properties->listing_status == 'Active' ? 'selected' : '' }}>Active</option>
                                                    <option value="Sold"    {{ $properties->listing_status == 'Sold' ? 'selected' : '' }}> Sold</option>
                                                    <option value="Processing" {{ $properties->listing_status == 'Processing' ? 'selected' : '' }}>Processing
                                                    </option>
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-listing_status"></p>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Property Status</label>
                                                <select class="form-control" name="property_status" id="property_status">
                                                    <option value="">All Cities</option>
                                                    <option value="Pending" {{ $properties->property_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Processing"  {{ $properties->property_status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                                    <option value="Published"  {{ $properties->property_status == 'Published' ? 'selected' : '' }}>Published</option>
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-property_status"></p>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Price</label>
                                                <input type="text" class="form-control" name="price" id="price" value="{{ $properties->price }}" placeholder="Price">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-price"></p>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Yearly Tax Rate</label>
                                                <input type="text" class="form-control" name="yearly_tax_rate" id="yearly_tax_rate" value="{{ $properties->yearly_tax_rate }}"
                                                    placeholder="Yearly Tax Rate">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-yearly_tax_rate"></p>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">After Price Label</label>
                                                <input type="text" class="form-control" name="price_label" value="{{ $properties->price_label  }}" placeholder="After Price Label">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-price_label"></p>
                                            </div>

                                            <div class="col-md-12" id="nav-tab2" role="tablist"
                                                style="margin-top: 19px;">
                                                <div class="d-sm-flex" style="float: right">
                                                    <button type="submit" name="next" class="next action-button next-1 btn btn-success">Next Step</i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="nav-item2-tab" class="container tab-pane fade"><br>
                                        <h4 class="title fz17 mb30">Upload photos of your property <p> Image Size (500 x 500) px or Same Ratio</p></h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="">Attachments:</label>
                                                <input type="file" name="attachment[]" multiple="multiple" class="form-control" id="attachment">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-attachment"></p>
                                            </div>
                                        </div>

                                        @if(count($property_attachment)>0)
                                            <label><strong>Attachments: </strong></label>
                                            <div class="row">
                                                @foreach($property_attachment as $item)
                                                    @if(stripos($item->attachment, 'pdf')!==false) 
                                                        <img src="admin/images/icon_pdf.png" title="file_name" alt="preview"/>
                                                    @else
                                                    <div class="col-2">
                                                        <div class="image-area" style="width:110px;">
                                                            <img src="{{asset('/uploads/property/'.$item->attachment)}}" title="file_name" alt="preview" class="w-100"/>
                                                            <a class="remove-image" data-id="{{ $item->id }}" href="javascript:;" style="display: inline;">×</a>
                                                            <input type="hidden" name="fileID[]" value="{{ $item->id }}">
                                                        </div>
                                                    </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="d-sm-flex justify-content-between">
                                                    <input type="button" name="pre"
                                                        class="pre action-button-pre btn btn-primary" value="Prev" />
                                                    <button type="submit" name="next"
                                                        class="next action-button next-3 btn btn-primary">Next
                                                        Step</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="nav-item3-tab" class="container tab-pane fade"><br>
                                        <h4 class="title fz17 mb30">Listing Location</h4>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="heading-color ff-heading fw600 mb10">Address</label>
                                                <input type="hidden" id="lat" name="lat" value="{{ $property_locations->latitude}}">
                                                <input type="hidden" id="lng" name="lng" value="{{ $property_locations->longitude }}">
                                                <input type="text" class="form-control" id="address" name="address" value="{{ $property_locations->address }}" placeholder="Address">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-address"></p>
                                            </div>
                                            <div id="autocomplete-container"></div>
                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Country</label>
                                                <input type="text" class="form-control" id="country" name="country" value="{{ $property_locations->country_id}}" placeholder="Country">
                        
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-country"></p>

                                            </div>

                                            <div class="col-md-6">
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

                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">City</label>
                                                <input type="text" class="form-control" id="city" name="city" value="{{ $property_locations->city_id}}" placeholder="City">
                                                {{-- <select class="form-control" name="city_id" id="city_id">
                                                    @foreach($citie as $city)
                                                    <option value="{{ $city->id }}" @if($city->id == $property_locations->city_id) selected @endif>{{ $city->name }}</option>
                                                 @endforeach
                                                </select> --}}
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-city"></p>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Neighborhood</label>
                                                <input type="text" class="form-control" id="neighborhood" name="landmark" value="{{ $property_locations->landmark }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-landmark"></p>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Zip Code</label>
                                                <input type="text" class="form-control" id="postal_code" name="zip_code" value="{{ $property_locations->zip_code}}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-zip_code"></p>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="d-sm-flex justify-content-between">
                                                        <input type="button" name="pre" class="pre action-button-pre btn btn-primary" value="Prev" />
                                                        <button type="submit" name="next" class="next action-button next-3 btn btn-primary">Next
                                                            Step</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div id="nav-item4-tab" class="container tab-pane fade"><br>
                                        <h4 class="title fz17 mb30">Listing Detail</h4>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Size in ft (only numbers)</label>
                                                <input type="text" class="form-control" name="size_in_ft" value="{{$property_details->size_in_ft }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-size_in_ft"></p>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Plot size in ft (only numbers)</label>
                                                <input type="text" class="form-control" name="lot_size_in_ft" value="{{ $property_details->lot_size_in_ft }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-lot_size_in_ft"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Rooms</label>
                                                <input type="text" class="form-control" name="rooms" value="{{ $property_details->rooms }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-rooms"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Bedrooms</label>
                                                <input type="text" class="form-control" name="bedrooms" value="{{ $property_details->bedrooms }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-bedrooms"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Bathrooms</label>
                                                <input type="text" class="form-control" name="bathrooms" value="{{ $property_details->bathrooms }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-bathrooms"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Custom ID (text)</label>
                                                <input type="text" class="form-control" name="custom_id" value="{{ $property_details->custom_id }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"id="error-custom_id"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Garages</label>
                                                <input type="text" class="form-control" name="garages" value="{{ $property_details->garages }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-garages"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Garage size</label>
                                                <input type="text" class="form-control" name="garage_size" value="{{ $property_details->garage_size }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-garage_size"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Year built (numeric)</label>
                                                <input type="text" name="year_built" class="form-control commonDatepicker"  placeholder="" value="{{ $property_details->year_built }}" autocomplete="off">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-year_built"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Available from (date)</label>
                                                <input type="date" class="form-control" name="available_date" value="{{ $property_details->available_date}}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-available_date"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Basement</label>
                                                <input type="text" class="form-control" name="basement" value="{{ $property_details->basement }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-basement"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Extra details</label>
                                                <input type="text" class="form-control" name="extra_details" value="{{ $property_details->extra_details }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-extra_details"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Roofing</label>
                                                <input type="text" class="form-control" name="roofing" value="{{ $property_details->roofing }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"
                                                    id="error-roofing"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Floors no</label>
                                                <select class="form-control" name="floors_no">
                                                    <option value="">Select Floors</option>
                                                    <option value="1st" {{ $property_details->floors_no == '1st' ? 'selected' : '' }}>1st</option>
                                                    <option value="2nd" {{ $property_details->floors_no == '2nd' ? 'selected' : '' }}>2nd</option>
                                                    <option value="3rd"  {{ $property_details->floors_no == '3rd' ? 'selected' : '' }}>3rd</option>
                                                    <option value="4th"  {{ $property_details->floors_no == '4th' ? 'selected' : '' }}>4th</option>
                                                    <option value="5th"  {{ $property_details->floors_no == '5th' ? 'selected' : '' }}>5th</option>
                                                    <option value="6th"  {{ $property_details->floors_no == '6th' ? 'selected' : '' }}>6th</option>
                                                    <option value="7th"  {{ $property_details->floors_no == '7th' ? 'selected' : '' }}>7th </option>
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-floors_no"></p>

                                            </div>

                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Energy Class</label>
                                                <select class="form-control" name="energy_class">
                                                    <option value="">All Listing</option>
                                                    <option value="Active"  {{ $property_details->energy_class == 'Active' ? 'selected' : '' }}>Active</option>
                                                    <option value="Sold" {{ $property_details->energy_class == 'Sold' ? 'selected' : '' }}>Sold</option>
                                                    <option value="Processing" {{ $property_details->energy_class == 'Processing' ? 'selected' : '' }}> Processing</option>
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container"id="error-energy_class"></p>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Energy index in kWh/m2a</label>
                                                <select class="form-control" name="energy_index">
                                                    <option value="">All Index</option>
                                                    <option value="Pending" {{ $property_details->energy_index == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Processing" {{ $property_details->energy_index == 'Processing' ? 'selected' : '' }}> Processing</option>
                                                    <option value="Published" {{ $property_details->energy_index == 'Published' ? 'selected' : '' }}>Published</option>
                                                </select>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-energy_index"></p>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="heading-color ff-heading fw600 mb10">Exterior Material</label>
                                                <input type="text" class="form-control" name="exterior_material" value="{{ $property_details->exterior_material }}" placeholder="">
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-exterior_material"></p>
                                            </div>

                                            <div class="col-md-12">
                                                <label class="heading-color ff-heading fw600 mb10">Owner/ Agent notes (not visible onfront end)</label>
                                                <textarea class="form-control content1" id="content1" placeholder="Enter the Description"name="agent_notes">{!!$property_details->agent_notes!!}</textarea>
                                                <p style="margin-bottom: 2px;" class="text-danger error_container" id="error-agent_notes"></p>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="d-sm-flex justify-content-between">
                                                    <input type="button" name="pre" class="pre action-button-pre btn btn-primary" value="Prev" />
                                                    <button type="submit" name="next"class="next action-button next-4 btn btn-primary">Next Step</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                        @php
                                            $values = explode(",",$property_details->amenities_id);
                                        @endphp
                                    
                                    <div id="nav-item5-tab" class="container tab-pane fade"><br>
                                        <h4 class="title fz17 mb30">Select Amenities</h4>
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
                                                    <input type="button" name="pre"
                                                        class="pre action-button-pre btn btn-primary" value="Prev" />
                                                    <button type="submit" class="btn btn-primary">Submit
                                                        Property</button>
                                                </div>
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

    </div>
    </div>
    </div>

@endsection

@push('customjs')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>  
    <script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>

    <script>
        CKEDITOR.replace('content', {
            extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
            mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
            removeButtons: 'PasteFromWord'
        });
    </script>

    <script>
        CKEDITOR.replace('content1', {
            extraPlugins: 'youtube,mathjax,codesnippet,html5audio,html5video',
            mathJaxLib: 'https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.4/MathJax.js?config=TeX-AMS_HTML', // Add the MathJax plugin
            removeButtons: 'PasteFromWord'
        });
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4Bec1p6cCz6VvI3oRvWAyh0VBI9FOmw4&libraries=places&callback=initAutocomplete" async defer></script>
   
   <script>
        //on change country
        $(document).on('change', '.country', function() {
            var id = $('#country_id').val();
           
            $.ajax({
                type: "post",
                url: "{{ route('/customers/getstate') }}",
                data: {
                    'country_id': id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    // console.log(data);
                    $("#state_id").empty();
                    $("#state_id").html('<option value="">Select State</option>');
                    $.each(data, function(key, value) {
                        $("#state_id").append('<option value="' + value.id + '">' + value.name +'</option>');
                    });
                }
            });
            event.stopImmediatePropagation();
            return false;
        });

        // on change state
        $(document).on('change', '.state', function() {
            var id = $('#state_id').val();

            $.ajax({
                type: "post",
                url: "{{ route('/customers/getcity') }}",
                data: {
                    'state_id': id,
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {
                    $("#city_id").empty();
                    $("#city_id").html('<option value="">Select City</option>');
                    $.each(data, function(key, value) {
                        $("#city_id").append('<option value="' + value.id + '">' + value.name +'</option>');
                    });
                }

            });
            event.stopImmediatePropagation();
            return false;
        });

        // address location
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

        //add step form js 
        $(document).ready(function() {
            var current_fs, next_fs, pre_fs;
            var opacity;
            var current = 1;
            var steps = $("nav-item").length;

            $(document).on('submit', 'form#propertycreate', function(event) {
                event.preventDefault();
                
                //clearing the error msg
                $('p.error_container').html("");
                // var current_fs = $('.next-'+current).parent(); 
                // var next_fs = $('.next-'+current).parent().next();  

                var form = $(this);
                var data = new FormData($(this)[0]);
                data.append('step', current);
                var url = form.attr("action");
                //var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
                $('.next-' + current).attr('disabled', true);

                $('.form-control').attr('readonly', true);
                $('.form-control').addClass('disabled-link');
                $('.error-control').addClass('disabled-link');
                // if ($('.next-'+current).html() !== loadingText) {
                //     $('.next-'+current).html(loadingText);
                // }
                $.ajax({
                    type: form.attr('method'),
                    url: url,
                    data: data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        window.setTimeout(function() {
                            $('.next-' + current).attr('disabled', false);
                            $('.form-control').attr('readonly', false);
                            $('.form-control').removeClass('disabled-link');
                            $('.error-control').removeClass('disabled-link');

                            if(current==5)
                            {
                                $('.next-'+current).html('Submit');
                            }
                            else
                            {
                                $('.next-'+current).html('Next Step');
                            }
                        }, 2000);
                        // console.log(response);
                        if (response.success == true) {
                            
                            $('#itme-tab'+current).removeClass('active');
                            $('#itme-tab'+(current+1)).addClass('active');

                            $('#nav-item'+current+'-tab').removeClass('active')
                            $('#nav-item'+(current+1)+'-tab').addClass('active show')

                            if (current == 5) {
                                toastr.success("Your property updated Successfully!");
                                window.location.href = "{{URL::to('admin/property')}}"
                            }
                            current++;
                           
                        } else if (response.success == false && response.error_type == 'message') {
                            toastr.error(response.message);
                        } else if (response.success == false && response.error_type == 'validation') {
                            for (control in response.errors) {
                                var error_text = control.replace('.', "_");
                                $('#error-' + error_text).html(response.errors[control]);
                                // $('#error-'+error_text).html(response.errors[error_text][0]);
                                // console.log('#error-'+error_text);
                            }
                            // console.log(response.errors);
                        }
                       

                        // $('#propertycreate')[0].reset();
                        // toastr.success("Your property created successfully");
                    },
                    error: function(response) {
                        // alert("Error: " + errorThrown);
                        console.log(response);
                    }
                });

                event.stopImmediatePropagation();
                return false;
            });

            $(".pre").click(function() {
                $('#itme-tab'+current).removeClass('active');
                $('#itme-tab'+(current-1)).addClass('active');

                $('#nav-item'+current+'-tab').removeClass('active')
                
                $('#nav-item'+(current-1)+'-tab').addClass('active show')
                current--;

            });

        });

        //remove image id wise

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
                            url: "{{ route('/property/image/remove') }}",
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
    </script>
@endpush
