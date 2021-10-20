@extends('layout.master')
@section('title') Dashboard @endsection

@section('contain')
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="row">
                <div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
                    <div class="card overflow-hidden">
                        <div class="card-body pb-0 px-4 pt-4">
                            <div class="row">
                                <div class="col">
                                    <h5 class="mb-1">2000</h5>
                                    <span class="text-success">Total Sale</span>
                                </div>
                            </div>
                        </div>
                        <div class="chart-wrapper"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas id="areaChart_2" class="chartjs-render-monitor" height="77" width="258" style="display: block; width: 258px; height: 77px;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
                    <div class="card bg-success	overflow-hidden">
                        <div class="card-body pb-0 px-4 pt-4">
                            <div class="row">
                                <div class="col">
                                    <h5 class="text-white mb-1">$14000</h5>
                                    <span class="text-white">Total Eraning</span>
                                </div>
                            </div>
                        </div>
                        <div class="chart-wrapper" style="width:100%">
                            <span class="peity-line" data-width="100%" style="display: none;">6,2,8,4,3,8,4,3,6,5,9,2</span><svg class="peity" height="100" width="400"><polygon fill="rgba(32, 222, 166, 1)" points="0 99.5 0 33.5 36.36363636363637 77.5 72.72727272727273 11.5 109.0909090909091 55.5 145.45454545454547 66.5 181.81818181818184 11.5 218.1818181818182 55.5 254.54545454545456 66.5 290.90909090909093 33.5 327.2727272727273 44.5 363.6363636363637 0.5 400.00000000000006 77.5 400 99.5"></polygon><polyline fill="none" points="0 33.5 36.36363636363637 77.5 72.72727272727273 11.5 109.0909090909091 55.5 145.45454545454547 66.5 181.81818181818184 11.5 218.1818181818182 55.5 254.54545454545456 66.5 290.90909090909093 33.5 327.2727272727273 44.5 363.6363636363637 0.5 400.00000000000006 77.5" stroke="rgb(70, 255, 200)" stroke-width="1" stroke-linecap="square"></polyline></svg>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
                    <div class="card bg-primary overflow-hidden">
                        <div class="card-body pb-0 px-4 pt-4">
                            <div class="row">
                                <div class="col text-white">
                                    <h5 class="text-white mb-1">570</h5>
                                    <span>VIEWS OF YOUR PROJECT</span>
                                </div>
                            </div>
                        </div>
                        <div class="chart-wrapper px-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas id="chart_widget_2" height="100" width="242" style="display: block; width: 242px; height: 100px;" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-xxl-3 col-lg-6 col-sm-6">
                    <div class="card overflow-hidden">
                        <div class="card-body px-4 py-4">
                            <h5 class="mb-3">1700 / <small class="text-primary">Sales Status</small></h5>
                            <div class="chart-point">
                                <div class="check-point-area"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                    <canvas id="ShareProfit2" width="100" height="100" style="display: block; width: 100px; height: 100px;" class="chartjs-render-monitor"></canvas>
                                </div>
                                <ul class="chart-point-list">
                                    <li><i class="fa fa-circle text-primary mr-1"></i> 40% Tickets</li>
                                    <li><i class="fa fa-circle text-success mr-1"></i> 35% Events</li>
                                    <li><i class="fa fa-circle text-warning mr-1"></i> 25% Other</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
        <a href="/add/product" class="btn btn-primary mb-3">Add New Product</a>
    <div class="row">
        <div class="col-xl-12 col-xxl-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header border-0 pb-0">
                    <h4 class="card-title">Product</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-sm mb-0">
                            <thead>
                            <tr>
                                <th><strong>ID</strong></th>
                                <th><strong>NAME</strong></th>
                                <th><strong>CATEGORY</strong></th>
                                <th><strong>PRICE</strong></th>
                                <th><strong>QUANTITY</strong></th>
                                <th><strong>CREATE AT</strong></th>
                                <th style="width:85px;"><strong>DELETE</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                                @if($data)
                                    @foreach($data as $item)
                                        <tr>
                                            <td><b>{{ $item->id }}</b></td>
                                            <td><b>{{ $item->name }}</b></td>
                                            <td>{{ $item->category }}</td>
                                            <td>{{ $item->price }}</td>
                                            <td>{{ $item->qnt }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <a href="/delete/product/{{ $item->id }}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="text-center">
                                        <td colspan="7">No Data Found!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
