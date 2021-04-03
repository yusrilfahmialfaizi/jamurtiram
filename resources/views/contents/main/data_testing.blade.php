@extends('parts.main.master')
@section('content')
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Data Testing</h4>
                                    {{-- <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#!">Bootstrap Table</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#!">Basic Initialization</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->

                <!-- Page-body start -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-header">
                                    {{-- <h5>Zero Configuration</h5> --}}
                                    {{-- <span>DataTables has most features enabled by default, so all you need to do to use
                                        it with your own ables is to call the construction function:
                                        $().DataTable();.</span> --}}

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>Entry Id</th>
                                                    <th>Humidity</th>
                                                    <th>Temperature</th>
                                                    <th>Target</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($dataset as $data)
                                                <tr>
                                                    <td>{{$data->entry_id}}</td>
                                                    <td>{{$data->humidity}}</td>
                                                    <td>{{$data->temperature}}</td>
                                                    <td>{{$data->target}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Entry Id</th>
                                                    <th>Humidity</th>
                                                    <th>Temperature</th>
                                                    <th>Target</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Zero config.table end -->
                            @endsection