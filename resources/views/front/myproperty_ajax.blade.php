@inject('carbon', 'Carbon\Carbon')
<table class="table-style3 table at-savesearch">
    <thead class="t-head">
      <tr>
        <th scope="col">Listing title</th>
        <th scope="col">Date Published</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody class="t-body">
      @foreach ($userPropertys as $userProperty)
        <tr>
          <?php
            $property_attachments = DB::table('property_attachments')->where('properti_id',$userProperty->id)->first();
          ?>
          <th scope="row">
            <div class="listing-style1 dashboard-style d-xxl-flex align-items-center mb-0">
              <div class="list-thumb">
                <img class="w-100" src="{{ asset('uploads/property/'.$property_attachments->attachment) }}" alt="">
              </div>
              <div class="list-content py-0 p-0 mt-2 mt-xxl-0 ps-xxl-4">
                <div class="h6 list-title"><a href="#">{{$userProperty->title}}</a></div>
                <p class="list-text mb-0">{{$userProperty->address}}</p>
                <?php  
                  $newvalue  = $userProperty->price;
                  $pricenew = (int)$newvalue;
                ?>
                <div class="list-price"><a href="#">SRD {{$pricenew}}</a></div>
              </div>
            </div>
          </th>
          <td class="vam">{{ $carbon::parse($userProperty->created_at)->format('F d,Y') }}</td>
          <td class="vam"><span class="pending-style style1">{{$userProperty->property_status}}</span></td>
          
          <td class="vam">
            <div class="d-flex">
              <a href="{{url('property/edit',['id'=>base64_encode($userProperty->id)])}}" class="icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><span class="fas fa-pen fa"></span></a>
              <a href="javascript:void(0)" class="icon deleteBtn" data-pid="{{$userProperty->id}}" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"><span class="flaticon-bin"></span></a>
            </div>
          </td>
        </tr>
      @endforeach
      
    </tbody>
</table>