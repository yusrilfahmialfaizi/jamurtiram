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
                                    <center>
                                        <h4>Pengujian Data</h4>
                                    </center>

                                </div>
                                <div class="card-block">
                                    <form action="{{ action('PerhitunganController@training')}}" method="POST" accept-charset="UTF-8">
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Learning Rate</label>
                                            <div class="col-sm-2">
                                                <select name="learning_rate" class="form-control">
                                                    <option value="0.1">default</option>
                                                    <option value="0.1">0.1</option>
                                                    <option value="0.2">0.2</option>
                                                    <option value="0.3">0.3</option>
                                                    <option value="0.4">0.4</option>
                                                    <option value="0.5">0.5</option>
                                                    <option value="0.6">0.6</option>
                                                    <option value="0.7">0.7</option>
                                                    <option value="0.8">0.8</option>
                                                    <option value="0.9">0.9</option>
                                                </select>
                                            </div>
                                            <label class="col-sm-2 col-form-label">Epoch</label>
                                            <div class="col-sm-2">
                                                <select name="epoch" class="form-control">
                                                    <option value="1000">default</option>
                                                    <option value="500">500</option>
                                                    <option value="1000">1000</option>
                                                    <option value="1500">1500</option>
                                                    <option value="2000">2000</option>
                                                    <option value="2500">2500</option>
                                                    <option value="3000">3000</option>
                                                    <option value="4000">4000</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label">Temperatur</label>
                                            <div class="col-sm-4">
                                                <input type="number" name="suhu"class="form-control" min="0">
                                            </div>
                                            {{-- </div>
                                        <div class="form-group row"> --}}
                                            <label class="col-sm-2 col-form-label">Kelembapan</label>
                                            <div class="col-sm-4">
                                                <input type="number" min="0" name="kelembapan" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                {{-- <input type="submit" class="form-control" min="0" class="btn btn-primary" value="Analysis"> --}}
                                                <button class="btn btn-primary">Analysis</button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            @endsection