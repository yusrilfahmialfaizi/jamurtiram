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
                                    {{-- <h4>Pengujiann</h4> --}}
                                    {{-- <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="dashboard"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a
                                            href="{{Request::segment(1)}}">{{ucwords(str_replace("-", " ", Request::segment(1)))}}</a>
                                        {{-- </li>
                                    <li class="breadcrumb-item"><a href="#!">Basic Initialization</a>
                                    </li> --}}
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
                                    <center>
                                        <h4>Analisis Data Test</h4>
                                    </center>

                                </div>
                                <div class="card-block">
                                    <form action="{{ action('AnalisaDataTestController@train')}}" method="POST"
                                        accept-charset="UTF-8">
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Learning Rate</label>
                                            <div class="col-sm-2">
                                                <select name="learning_rate" id="learning_rate" class="form-control">
                                                    <option value="0.1">default</option>
                                                    <option value="0.01">0.01</option>
                                                    <option value="0.02">0.02</option>
                                                    <option value="0.03">0.03</option>
                                                    <option value="0.04">0.04</option>
                                                    <option value="0.05">0.05</option>
                                                    <option value="0.1">0.1</option>
                                                    <option value="0.2">0.2</option>
                                                    <option value="0.3">0.3</option>
                                                    <option value="0.4">0.4</option>
                                                    <option value="0.5">0.5</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 col-form-label">Epoch</label>
                                            <div class="col-sm-2">
                                                <select name="epoch" id="epoch" class="form-control">
                                                    <option value="1000">default</option>
                                                    <option value="100">100</option>
                                                    <option value="200">200</option>
                                                    <option value="300">300</option>
                                                    <option value="400">400</option>
                                                    <option value="500">500</option>
                                                    <option value="600">600</option>
                                                    <option value="700">700</option>
                                                    <option value="800">800</option>
                                                    <option value="900">900</option>
                                                    <option value="1000">1000</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 col-form-label">Threshold Error</label>
                                            <div class="col-sm-2">
                                                <select name="error" id="error" class="form-control">
                                                    <option value="0.0001">default</option>
                                                    <option value="0.1">0.1</option>
                                                    <option value="0.01">0.01</option>
                                                    <option value="0.001">0.001</option>
                                                    <option value="0.0001">0.0001</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                {{-- <input type="submit" class="form-control" min="0" class="btn btn-primary" value="Analysis"> --}}
                                                <button class="btn btn-primary" name="analys"
                                                    id="analys">Analysis</button>
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