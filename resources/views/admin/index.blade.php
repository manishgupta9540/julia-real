@extends('admin.master.index')

@section('content')

    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="card mb-4 text-white bg-primary">
                        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div>Total Users ( {{$Activeusers}} )</div>
                                
                                <div class="fs-4 fw-semibold">
                                    <span class="fs-6 fw-normal">
                                        ( Active : {{ $Activeusers }}, In Active : {{ $Inactiveusers }})
                                    </span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                            <canvas class="chart" id="card-chart1" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card mb-4 text-white bg-info">
                        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div>Total Contact</div>
                                <div class="fs-4 fw-semibold">
                                    <span class="fs-6 fw-normal">( {{$contacts}} )</span>
                                </div>
                            </div>
                        </div>
                        <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                            <canvas class="chart" id="card-chart2" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card mb-4 text-white bg-warning">
                        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div>Total Property</div>
                                <div class="fs-4 fw-semibold"> 
                                    <span class="fs-6 fw-normal">
                                        ( Active : {{ $activeProperty }}, In Active : {{ $InactiveProperty }})
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="c-chart-wrapper mt-3" style="height:70px;">
                            <canvas class="chart" id="card-chart3" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card mb-4 text-white bg-danger">
                        <div class="card-body pb-0 d-flex justify-content-between align-items-start">
                            <div>
                                <div>Total Customers</div>
                                <div class="fs-4 fw-semibold">
                                    <span class="fs-6 fw-normal">
                                        ( {{$customers}} )
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;">
                            <canvas class="chart" id="card-chart4" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!-- /.col-->
            </div>
            
           
            <!-- /.row-->
        </div>
    </div>

@endsection