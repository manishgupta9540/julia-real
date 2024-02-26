@extends('admin.master.index')

@section('content')
    <div class="col-12">
        <div class="row align-items-center justify-content-center">
            <div class="col-md-11">
                <form action="{{route('roles/permission/update')}}"  method="post" >
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                             @if(count($permission)>0)
                              @foreach($permission as $data)
                                    <?php
                                      $action = DB::table('action_masters')->where(['route_group'=>'','status'=>'1','parent_id'=>$data->id])->orderBy('display_order','ASC')->get();
                                    ?>
                                    @php
                                      if($action_route_count==0){
                                        $checked = '';
                                      }else{
                                        $route_link = json_decode($action_route->permission_id);
                                        $checked = in_array($data->id,$route_link)  ? 'checked' : '';
                                      }
                                    @endphp
                                  <li style="display: block;">
                                    <input type="checkbox" name="permissions[]" id="{{$data->id}}" value="{{$data->id}}" {{$checked}} > <label for="{{ $data->id }}" > {{$data->action_title}} </label>
                                    <ul>
                                      @if(count($action)>0)
                                        @foreach($action as $premission)
                                          <?php
                                            $sub_action = DB::table('action_masters')->where(['route_group'=>'','status'=>'1','parent_id'=>$premission->id])->orderBy('display_order','ASC')->get();
                                          ?>
                                          @php
                                            if($action_route_count==0){
                                              $checked = '';
                                            }else{
                                                $route_link = json_decode($action_route->permission_id);
                                                $checked = in_array($premission->id,$route_link)  ? 'checked' : '';
                                            }
                                          @endphp
                                          <li style="display: block">
                                            <input type="checkbox"  name="permissions[]" id="{{$premission->id}}" value="{{$premission->id}}" {{$checked}} > <label for="{{$premission->id}}">{{$premission->action_title}}</label>
                                          </li>
                                        @endforeach
                                      @endif
                                    </ul>
                                  </li>
                              @endforeach
                              @endif
                              <hr>
                        </div>
                    </div>
                    <input type="hidden" name="role_id" value="{{$role_id}}">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <a href="{{route('roles.index')}}" class="btn  btn-danger" ><i class="metismenu-icon"></i>Cancel</a>
                </form>   
            </div>
        </div>
    </div>
    
@endsection

@push('customjs')
    <script>
        // $(document).on('submit', 'form#createRoleFrm', function(event) {
        //     event.preventDefault();
        //     //clearing the error msg
        //     $('p.error_container').html("");

        //     var form = $(this);
        //     var data = new FormData($(this)[0]);
        //     var url = form.attr("action");
        //     var loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
        //     $('.submit').attr('disabled', true);
        //     $('.form-control').attr('readonly', true);
        //     $('.form-control').addClass('disabled-link');
        //     $('.error-control').addClass('disabled-link');
        //     if ($('.submit').html() !== loadingText) {
        //         $('.submit').html(loadingText);
        //     }
        //     $.ajax({
        //         type: form.attr('method'),
        //         url: url,
        //         data: data,
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         success: function(response) {
        //             window.setTimeout(function() {
        //                 $('.submit').attr('disabled', false);
        //                 $('.form-control').attr('readonly', false);
        //                 $('.form-control').removeClass('disabled-link');
        //                 $('.error-control').removeClass('disabled-link');
        //                 $('.submit').html('Save');
        //             }, 2000);
        //             console.log(response);
        //             if (response.success == true) {
        //                 toastr.success("Role Creted Successfully");
        //                 window.setTimeout(function() {
        //                     window.location.href = "{{ URL::to('admin/roles-list') }}"
        //                 }, 2000);
        //             }
        //             //show the form validates error
        //             if (response.success == false) {
        //                 for (control in response.errors) {
        //                     var error_text = control.replace('.', "_");
        //                     $('#error-' + error_text).html(response.errors[control]);
        //                     // $('#error-'+error_text).html(response.errors[error_text][0]);
        //                     // console.log('#error-'+error_text);
        //                 }
        //                 // console.log(response.errors);
        //             }
        //         },
        //         error: function(response) {
        //             // alert("Error: " + errorThrown);
        //             console.log(response);
        //         }
        //     });
        //     event.stopImmediatePropagation();
        //     return false;
        // });
    </script>
    <script>
         $('input[type=checkbox]').click(function () {
            $(this).parent().find('li input[type=checkbox]').prop('checked', $(this).is(':checked'));
            var sibs = false;
            $(this).closest('ul').children('li').each(function () {
                if($('input[type=checkbox]', this).is(':checked')) sibs=true;
            })
            $(this).parents('ul').prev().prop('checked', sibs);
        });
    </script>
@endpush
