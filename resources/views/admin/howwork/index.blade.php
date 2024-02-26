@extends('admin.master.index')

@section('title','How We Work Listing')

@section('content')
<style>
    .badge-danger {
    color: #fff;
    background-color: #dc3545;
    }
    .badge-success {
        color: #fff;
        background-color: #28a745;
    }
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <br>
                    <?php
                        $allreadyexist = DB::table('how_we_works')->count();
                    ?>

                    <div class="table-responsive">
                        @if($allreadyexist == null)
                            <a href="{{route('how-work-create')}}" class="btn btn-primary btn-sm ">Add How We Work</a>
                        @else

                        @endif
                        <br>
                        <table class="table border  user_datatable">
                            <thead class="table-light fw-semibold">
                                <tr class="align-middle">
                                    <th>Id</th>
                                    <th>Title</th>
                                    {{-- <th>Description</th> --}}
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('customjs')
        <script>
        $(document).ready(function(){
            //datatable show

            if ($(".user_datatable").length > 0) {
                /*Checkbox Add*/
                var tdCnt=0;
                var targetDt = $('.user_datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{route('howwork.index')}}",
    
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'title', name: 'title'},
                        // {data: 'description', name: 'description'},
                        {
                            data: 'created_at',
                            type: 'num',
                            render: {
                                _: 'display',
                                sort: 'timestamp'
                            }
                        },
                        {data: 'status', name: 'status'},
                        {data: 'action', name: 'action'},
                        
                        ],
    
                    "dom": '<"row"<"col-7 mb-3"<"contact-toolbar-left">><"col-5 mb-3"<"contact-toolbar-right"f>>><"row"<"col-sm-12"t>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
    
                    "ordering": true,
    
                    "columnDefs": [ {
                        "searchable": false,
                        "orderable": false,
                        "targets": [0,2]
                    } ],
    
                   
                });
            
            }
        

        //delete button 
        $(document).on('click', '.deleteBtn', function() {
            var _this = $(this);
            var id = $(this).data('id');
            
            var table = 'how_we_works';
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
                        _this.addClass('disabled-link');
                        $.ajax({
                            type: "POST",
                            dataType: "json",
                            url: "{{ route('howWork-delete') }}",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'id': id,
                                'table_name': table
                            },
                            success: function(response) {
                                console.log(response);
                                window.setTimeout(function() {
                                    _this.removeClass('disabled-link');
                                }, 2000);

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
                }
            );
            });
        });

        //status active and deactive
        $(document).on('click', '.status', function (event) {
    
            var id = $(this).attr('data-id');
            
            var type =$(this).attr('data-type');
            
            var action = '';
            var type_decode =atob(type);
                //   alert(type_decode);
            if (type_decode== 'enable') {
                var action = 'activate';
            }
            if (type_decode== 'disable') {
                var action = 'deactivate';
            }
            swal({
            // icon: "warning",
            type: "warning",
            title: 'Are you want to '+ action +' account for '+name+'?',
            text: "",
            dangerMode: true,
            showCancelButton: true,
            confirmButtonColor: "#007358",
            confirmButtonText: "YES",
            cancelButtonText: "CANCEL",
            closeOnConfirm: false,
            closeOnCancel: false
            },
            function(e){
                if(e==true)
                {
                    $.ajax({
                        type:'POST',
                        url: "{{url('admin/how-work-status')}}",
                        data: {"_token" : "{{ csrf_token() }}",'id':id,'type':type},        
                        success: function (response) {        
                
                            if (response.success) { 
                                window.setTimeout(function(){
                                   location.reload();
                                },2000);
                                toastr.success("Status Changed Successfully");
                            } 
                            else {
                                
                            }

                            swal.close();
                            
                        },
                        error: function (xhr, textStatus, errorThrown) {
                            // alert("Error: " + errorThrown);
                        }
                        
                    });
                }
                else
                {
                    swal.close();
                }
            });

        });
        
    </script>
    @endpush

    
