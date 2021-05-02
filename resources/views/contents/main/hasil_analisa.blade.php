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
                                    <h4>Hasil Analisa </h4>
                                    <span>Data Testing</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="dashboard"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="/{{Request::segment(1)}}">
                                            {{ucwords(str_replace("-", " ", Request::segment(1)))}}</a>
                                    </li>
                                    @if (Request::segment(2) != null)
                                    <li class="breadcrumb-item"><a
                                            href="/{{Request::segment(1)}}/{{Request::segment(2)}}">
                                            {{ucwords(str_replace("-", " ", Request::segment(2)))}}</a>
                                    </li>

                                    @endif
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
                            @php
                            $data = session()->get( 'data' );
                            @endphp
                            <!-- Zero config.table start -->
                            <div class="card">
                                <div class="card-header">
                                    {{-- <h5>Zero Configuration</h5> --}}
                                    {{-- <span>DataTables has most features enabled by default, so all you need to do to use
                                        it with your own ables is to call the construction function:
                                        $().DataTable();.</span> --}}

                                </div>
                                <div class="card-block">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" id="label_hasil1">Hasil MAPE </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="output" id="output" class="form-control"
                                                value="{{$data['mape']}}" readonly>
                                        </div>
                                        <label class="col-sm-2 col-form-label" id="label_akurasi1">Akurasi </label>
                                        <div class="col-sm-4">
                                            <input type="text" name="akurasi" id="akurasi" class="form-control"
                                                value="{{$data['akurasi']}}" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    {{-- <h5>Zero Configuration</h5> --}}
                                    {{-- <span>DataTables has most features enabled by default, so all you need to do to use
                                        it with your own ables is to call the construction function:
                                        $().DataTable();.</span> --}}

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="basic-btn" class="table table-striped table-bordered nowrap">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Temperature</th>
                                                    <th>Humidity</th>
                                                    <th>Target</th>
                                                    <th>Output</th>
                                                    <th>Output Target</th>
                                                    <th>Nilai Fuzzy</th>
                                                    <th>Hasil Fuzzy</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($data['output'] as $dt)
                                                <tr>
                                                    <td>{{$dt['entry']}}</td>
                                                    <td>{{$dt['temperature']}}</td>
                                                    <td>{{$dt['humidity']}}</td>
                                                    <td>{{$dt['target']}}</td>
                                                    <td>{{$dt['output']}}</td>
                                                    <td>{{$dt['output-target']}}</td>
                                                    <td>{{$dt['nilai-fuzzy']}}</td>
                                                    <td>{{$dt['hasil-fuzzy']}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Temperature</th>
                                                    <th>Humidity</th>
                                                    <th>Target</th>
                                                    <th>Output</th>
                                                    <th>Output Target</th>
                                                    <th>Nilai Fuzzy</th>
                                                    <th>Hasil Fuzzy</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Zero config.table end -->
@endsection