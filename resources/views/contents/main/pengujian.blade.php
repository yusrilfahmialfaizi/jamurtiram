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
                                            href="{{Request::segment(1)}}">{{ucfirst(Request::segment(1))}}</a>
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
                                        <h4>Pengujian Data</h4>
                                    </center>

                                </div>
                                <div class="card-block">
                                    {{-- <form action="{{ action('PerhitunganController@training')}}" method="POST"
                                    accept-charset="UTF-8"> --}}
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <div class="col-sm-1"></div>
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
                                        <div class="col-sm-2"></div>
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
                                        <div class="col-sm-1"></div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            {{-- <input type="submit" class="form-control" min="0" class="btn btn-primary" value="Analysis"> --}}
                                            <button class="btn btn-primary" name="analys" id="analys">Uji Data</button>
                                        </div>
                                    </div>
                                    <hr id="1">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" id="label_hasil1">Hasil MAPE 1</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="output1" id="output1" class="form-control"
                                                readonly>
                                        </div>
                                        <label class="col-sm-2 col-form-label" id="label_akurasi1">Akurasi 1</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="akurasi1" id="akurasi1" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" id="label_hasil2">Hasil MAPE 2</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="output2" id="output2" class="form-control"
                                                readonly>
                                        </div>
                                        <label class="col-sm-2 col-form-label" id="label_akurasi2">Akurasi 2</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="akurasi2" id="akurasi2" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" id="label_hasil3">Hasil MAPE 3</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="output3" id="output3" class="form-control"
                                                readonly>
                                        </div>
                                        <label class="col-sm-2 col-form-label" id="label_akurasi3">Akurasi 3</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="akurasi3" id="akurasi3" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" id="label_hasil4">Hasil MAPE 4</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="output4" id="output4" class="form-control"
                                                readonly>
                                        </div>
                                        <label class="col-sm-2 col-form-label" id="label_akurasi4">Akurasi 4</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="akurasi4" id="akurasi4" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" id="label_hasil5">Hasil MAPE 5</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="output5" id="output5" class="form-control"
                                                readonly>
                                        </div>
                                        <label class="col-sm-2 col-form-label" id="label_akurasi5">Akurasi 5</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="akurasi5" id="akurasi5" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" id="label_hasil6">Hasil MAPE 6</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="output6" id="output6" class="form-control"
                                                readonly>
                                        </div>
                                        <label class="col-sm-2 col-form-label" id="label_akurasi6">Akurasi 6</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="akurasi6" id="akurasi6" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" id="label_hasil7">Hasil MAPE 7</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="output7" id="output7" class="form-control"
                                                readonly>
                                        </div>
                                        <label class="col-sm-2 col-form-label" id="label_akurasi7">Akurasi 7</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="akurasi7" id="akurasi7" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" id="label_hasil8">Hasil MAPE 8</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="output8" id="output8" class="form-control"
                                                readonly>
                                        </div>
                                        <label class="col-sm-2 col-form-label" id="label_akurasi8">Akurasi 8</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="akurasi8" id="akurasi8" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" id="label_hasil9">Hasil MAPE 9</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="output9" id="output9" class="form-control"
                                                readonly>
                                        </div>
                                        <label class="col-sm-2 col-form-label" id="label_akurasi9">Akurasi 9</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="akurasi9" id="akurasi9" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" id="label_hasil10">Hasil MAPE 10</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="output10" id="output10" class="form-control"
                                                readonly>
                                        </div>
                                        <label class="col-sm-2 col-form-label" id="label_akurasi10">Akurasi 10</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="akurasi10" id="akurasi10" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                    <hr id="2">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" id="label_rata2mape">Rata - Rata MAPE
                                            :</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="rata2mape" id="rata2mape" class="form-control"
                                                readonly>
                                        </div>
                                        <label class="col-sm-2 col-form-label" id="label_rata2akurasi">Rata - Rata
                                            Akurasi :</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="rata2akurasi" id="rata2akurasi"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                    <hr id="3">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-md-2 col-form-label" id="hasil_uji">Hasil
                                                Pengujian</label>
                                            <div class="col-md-4">
                                                <select name="pengujian" id="pengujian" class="form-control">
                                                    <option value="&nbsp">-- Pilih --</option>
                                                    <option value="0">Pengujian 1</option>
                                                    <option value="1">Pengujian 2</option>
                                                    <option value="2">Pengujian 3</option>
                                                    <option value="3">Pengujian 4</option>
                                                    <option value="4">Pengujian 5</option>
                                                    <option value="5">Pengujian 6</option>
                                                    <option value="6">Pengujian 7</option>
                                                    <option value="7">Pengujian 8</option>
                                                    <option value="8">Pengujian 9</option>
                                                    <option value="9">Pengujian 10</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" id="label_bx0z1">bX0Z1</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="bx0z1" id="bx0z1" class="form-control"
                                                    readonly>
                                            </div>
                                            <label class="col-sm-2 col-form-label" id="label_bx0z2">bX0Z2</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="bx0z2" id="bx0z2" class="form-control"
                                                    readonly>
                                            </div>
                                            <label class="col-sm-2 col-form-label" id="label_bx0z3">bX0Z3</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="bx0z3" id="bx0z3" class="form-control"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" id="label_bx1z1">bX1Z1</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="bx1z1" id="bx1z1" class="form-control"
                                                    readonly>
                                            </div>
                                            <label class="col-sm-2 col-form-label" id="label_bx2z1">bX2Z1</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="bx2z1" id="bx2z1" class="form-control"
                                                    readonly>
                                            </div>
                                            <label class="col-sm-2 col-form-label" id="label_bx1z2">bX1Z2</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="bx1z2" id="bx1z2" class="form-control"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" id="label_bx2z2">bX2Z2</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="bx2z2" id="bx2z2" class="form-control"
                                                    readonly>
                                            </div>
                                            <label class="col-sm-2 col-form-label" id="label_bx1z3">bX1Z3</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="bx1z3" id="bx1z3" class="form-control"
                                                    readonly>
                                            </div>
                                            <label class="col-sm-2 col-form-label" id="label_bx2z3">bX2Z3</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="bx2z3" id="bx2z3" class="form-control"
                                                    readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" id="label_bz0y">bZ0Y</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="bz0y" id="bz0y" class="form-control" readonly>
                                            </div>
                                            <label class="col-sm-2 col-form-label" id="label_bz1y">bZ1Y</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="bz1y" id="bz1y" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label" id="label_bz2y">bZ2Y</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="bz2y" id="bz2y" class="form-control" readonly>
                                            </div>
                                            <label class="col-sm-2 col-form-label" id="label_bz3y">bZ3Y</label>
                                            <div class="col-sm-2">
                                                <input type="text" name="bz3y" id="bz3y" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <!-- LINE CHART start -->
                                            <div class="col-md-12 col-lg-12">
                                                <div class="card" id="chart">
                                                    <div class="card-header">
                                                        <h5>Statistik Data Hasil Pengujian</h5>
                                                        <br>
                                                        <br>
                                                        <h10>5 data terakhir</h10>
                                                    </div>
                                                    <div class="card-block">
                                                        <div id="hasil-data"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- LINE CHART Ends -->
                                        </div>
                                    </div>
                                    {{-- </form> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        var morrisLine;
        initMorris();
        //getMorris();
        // setMorris(data);
        //getMorrisOffline();

        function initMorris() {
            morrisLine = Morris.Line({
                element: 'hasil-data',
                xkey: 'period',
                ykeys: ['a', 'b'],
                labels: ['Target', 'Hasil Pengujian'],
                xLabelAngle: 60,
                parseTime: false,
                resize: true,
                lineColors: ['#32c5d2', '#c03e26']
            });
        }

        function setMorris(data) {
            morrisLine.setData(data);
        }

        // function getMorris() {
        // $.get('@Url.Action("GetData")', function (result) {
        // setMorris(result);
        // });
        // }

        // function getMorrisOffline() {
        // var lineData = [
        // { period: '1', a: 100, b: 90 },
        // { period: '2', a: 75, b: 65 },
        // { period: '3', a: 50, b: 40 },
        // { period: '4', a: 75, b: 65 },
        // { period: '5', a: 50, b: 40 },
        // { period: '6', a: 75, b: 65 },
        // { period: '7', a: 100, b: 90 }
        // ];
        // setMorris(lineData);
        // }

        document.getElementById("label_hasil1").style.display = 'none';
        document.getElementById("label_hasil2").style.display = 'none';
        document.getElementById("label_hasil3").style.display = 'none';
        document.getElementById("label_hasil4").style.display = 'none';
        document.getElementById("label_hasil5").style.display = 'none';
        document.getElementById("label_hasil6").style.display = 'none';
        document.getElementById("label_hasil7").style.display = 'none';
        document.getElementById("label_hasil8").style.display = 'none';
        document.getElementById("label_hasil9").style.display = 'none';
        document.getElementById("label_hasil10").style.display = 'none';
        document.getElementById("label_akurasi1").style.display = 'none';
        document.getElementById("label_akurasi2").style.display = 'none';
        document.getElementById("label_akurasi3").style.display = 'none';
        document.getElementById("label_akurasi4").style.display = 'none';
        document.getElementById("label_akurasi5").style.display = 'none';
        document.getElementById("label_akurasi6").style.display = 'none';
        document.getElementById("label_akurasi7").style.display = 'none';
        document.getElementById("label_akurasi8").style.display = 'none';
        document.getElementById("label_akurasi9").style.display = 'none';
        document.getElementById("label_akurasi10").style.display = 'none';
        document.getElementById("label_rata2mape").style.display = 'none';
        document.getElementById("label_rata2akurasi").style.display = 'none';
        document.getElementById("output1").style.display = 'none';
        document.getElementById("output2").style.display = 'none';
        document.getElementById("output3").style.display = 'none';
        document.getElementById("output4").style.display = 'none';
        document.getElementById("output5").style.display = 'none';
        document.getElementById("output6").style.display = 'none';
        document.getElementById("output7").style.display = 'none';
        document.getElementById("output8").style.display = 'none';
        document.getElementById("output9").style.display = 'none';
        document.getElementById("output10").style.display = 'none';
        document.getElementById("akurasi1").style.display = 'none';
        document.getElementById("akurasi2").style.display = 'none';
        document.getElementById("akurasi3").style.display = 'none';
        document.getElementById("akurasi4").style.display = 'none';
        document.getElementById("akurasi5").style.display = 'none';
        document.getElementById("akurasi6").style.display = 'none';
        document.getElementById("akurasi7").style.display = 'none';
        document.getElementById("akurasi8").style.display = 'none';
        document.getElementById("akurasi9").style.display = 'none';
        document.getElementById("akurasi10").style.display = 'none';
        document.getElementById("rata2mape").style.display = 'none';
        document.getElementById("rata2akurasi").style.display = 'none';

        document.getElementById("hasil_uji").style.display = 'none';
        document.getElementById("pengujian").style.display = 'none';

        document.getElementById("label_bx0z1").style.display = 'none';
        document.getElementById("label_bx0z2").style.display = 'none';
        document.getElementById("label_bx0z3").style.display = 'none';
        document.getElementById("label_bx1z1").style.display = 'none';
        document.getElementById("label_bx1z2").style.display = 'none';
        document.getElementById("label_bx1z3").style.display = 'none';
        document.getElementById("label_bx2z1").style.display = 'none';
        document.getElementById("label_bx2z2").style.display = 'none';
        document.getElementById("label_bx2z3").style.display = 'none';
        document.getElementById("label_bz0y").style.display = 'none';
        document.getElementById("label_bz1y").style.display = 'none';
        document.getElementById("label_bz2y").style.display = 'none';
        document.getElementById("label_bz3y").style.display = 'none';

        document.getElementById("bx0z1").style.display = 'none';
        document.getElementById("bx0z2").style.display = 'none';
        document.getElementById("bx0z3").style.display = 'none';
        document.getElementById("bx1z1").style.display = 'none';
        document.getElementById("bx1z2").style.display = 'none';
        document.getElementById("bx1z3").style.display = 'none';
        document.getElementById("bx2z1").style.display = 'none';
        document.getElementById("bx2z2").style.display = 'none';
        document.getElementById("bx2z3").style.display = 'none';
        document.getElementById("bz0y").style.display = 'none';
        document.getElementById("bz1y").style.display = 'none';
        document.getElementById("bz2y").style.display = 'none';
        document.getElementById("bz3y").style.display = 'none';

        document.getElementById("chart").style.display = 'none';
        document.getElementById("1").style.display = 'none';
        document.getElementById("2").style.display = 'none';
        document.getElementById("3").style.display = 'none';

        $('#analys').on('click', function () {
            swal({
                title: "Pengujian Data",
                text: "Epoch Maksimum",
                type: "info",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {
                var learning_rate = $('#learning_rate').val();
                var epoch = $('#epoch').val();
                var error = $('#error').val();

                $.ajax({
                    url: "{{URL::to('perhitungan/train')}}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                            .attr('content')
                    },
                    // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
                    dataType: 'json',
                    async: true,
                    data: {
                        learning_rate: learning_rate,
                        epoch: epoch
                    },
                    cache: false,
                    success: function (data) {

                        var rata2mape = (parseFloat(data[0].mape) +
                            parseFloat(data[1].mape) + parseFloat(data[2]
                            .mape) +
                            parseFloat(data[3].mape) + parseFloat(data[4]
                            .mape) +
                            parseFloat(data[5].mape) + parseFloat(data[6]
                                .mape) + parseFloat(data[7].mape) + parseFloat(
                                data[8].mape) +
                            parseFloat(data[9].mape)) / 10;
                        var rata2akurasi = (parseFloat(data[0].akurasi) +
                            parseFloat(data[1].akurasi) + parseFloat(data[2]
                                .akurasi) +
                            parseFloat(data[3].akurasi) + parseFloat(data[4]
                                .akurasi) +
                            parseFloat(data[
                                5].akurasi) + parseFloat(data[6].akurasi) +
                            parseFloat(data[7].akurasi) + parseFloat(data[8]
                                .akurasi) +
                            parseFloat(data[9].akurasi)) / 10;
                        document.getElementById("label_hasil1").style.display =
                            'block';
                        document.getElementById("label_hasil2").style.display =
                            'block';
                        document.getElementById("label_hasil3").style.display =
                            'block';
                        document.getElementById("label_hasil4").style.display =
                            'block';
                        document.getElementById("label_hasil5").style.display =
                            'block';
                        document.getElementById("label_hasil6").style.display =
                            'block';
                        document.getElementById("label_hasil7").style.display =
                            'block';
                        document.getElementById("label_hasil8").style.display =
                            'block';
                        document.getElementById("label_hasil9").style.display =
                            'block';
                        document.getElementById("label_hasil10").style.display =
                            'block';
                        document.getElementById("label_akurasi1").style.display =
                            'block';
                        document.getElementById("label_akurasi2").style.display =
                            'block';
                        document.getElementById("label_akurasi3").style.display =
                            'block';
                        document.getElementById("label_akurasi4").style.display =
                            'block';
                        document.getElementById("label_akurasi5").style.display =
                            'block';
                        document.getElementById("label_akurasi6").style.display =
                            'block';
                        document.getElementById("label_akurasi7").style.display =
                            'block';
                        document.getElementById("label_akurasi8").style.display =
                            'block';
                        document.getElementById("label_akurasi9").style.display =
                            'block';
                        document.getElementById("label_akurasi10").style.display =
                            'block';
                        document.getElementById("label_rata2mape").style.display =
                            'block';
                        document.getElementById("label_rata2akurasi").style
                            .display = 'block';
                        document.getElementById("output1").style.display = 'block';
                        document.getElementById("output2").style.display = 'block';
                        document.getElementById("output3").style.display = 'block';
                        document.getElementById("output4").style.display = 'block';
                        document.getElementById("output5").style.display = 'block';
                        document.getElementById("output6").style.display = 'block';
                        document.getElementById("output7").style.display = 'block';
                        document.getElementById("output8").style.display = 'block';
                        document.getElementById("output9").style.display = 'block';
                        document.getElementById("output10").style.display = 'block';
                        document.getElementById("akurasi1").style.display = 'block';
                        document.getElementById("akurasi2").style.display = 'block';
                        document.getElementById("akurasi3").style.display = 'block';
                        document.getElementById("akurasi4").style.display = 'block';
                        document.getElementById("akurasi5").style.display = 'block';
                        document.getElementById("akurasi6").style.display = 'block';
                        document.getElementById("akurasi7").style.display = 'block';
                        document.getElementById("akurasi8").style.display = 'block';
                        document.getElementById("akurasi9").style.display = 'block';
                        document.getElementById("akurasi10").style.display =
                        'block';
                        document.getElementById("rata2mape").style.display =
                        'block';
                        document.getElementById("rata2akurasi").style.display =
                            'block';

                        document.getElementById("hasil_uji").style.display =
                        'block';
                        document.getElementById("pengujian").style.display =
                        'block';

                        document.getElementById("1").style.display = 'block';
                        document.getElementById("2").style.display = 'block';
                        document.getElementById("3").style.display = 'block';

                        document.getElementById("output1").value = data[0].mape;
                        document.getElementById("output2").value = data[1].mape;
                        document.getElementById("output3").value = data[2].mape;
                        document.getElementById("output4").value = data[3].mape;
                        document.getElementById("output5").value = data[4].mape;
                        document.getElementById("output6").value = data[5].mape;
                        document.getElementById("output7").value = data[6].mape;
                        document.getElementById("output8").value = data[7].mape;
                        document.getElementById("output9").value = data[8].mape;
                        document.getElementById("output10").value = data[9].mape;
                        document.getElementById("akurasi1").value = data[0].akurasi;
                        document.getElementById("akurasi2").value = data[1].akurasi;
                        document.getElementById("akurasi3").value = data[2].akurasi;
                        document.getElementById("akurasi4").value = data[3].akurasi;
                        document.getElementById("akurasi5").value = data[4].akurasi;
                        document.getElementById("akurasi6").value = data[5].akurasi;
                        document.getElementById("akurasi7").value = data[6].akurasi;
                        document.getElementById("akurasi8").value = data[7].akurasi;
                        document.getElementById("akurasi9").value = data[8].akurasi;
                        document.getElementById("akurasi10").value = data[9]
                        .akurasi;

                        document.getElementById("rata2mape").value = rata2mape +
                        "%";
                        document.getElementById("rata2akurasi").value =
                            rata2akurasi + "%";
                        bobot(data);
                    },
                    complete: function () {
                        // Code to hide spinner.
                        swal("Pengujian Data Selesai!");
                    },
                    fail: function () {
                        swal({
                            text: "500 Internal Server Error, Silahkan Dicoba Kembali !",
                            type: "danger"
                        });
                    }

                })
            });
        });

        function bobot(data) {
            $("#pengujian").on("change", function () {
                var ke = $("#pengujian").val();

                document.getElementById("label_bx0z1").style.display = 'block';
                document.getElementById("label_bx0z2").style.display = 'block';
                document.getElementById("label_bx0z3").style.display = 'block';
                document.getElementById("label_bx1z1").style.display = 'block';
                document.getElementById("label_bx1z2").style.display = 'block';
                document.getElementById("label_bx1z3").style.display = 'block';
                document.getElementById("label_bx2z1").style.display = 'block';
                document.getElementById("label_bx2z2").style.display = 'block';
                document.getElementById("label_bx2z3").style.display = 'block';
                document.getElementById("label_bz0y").style.display = 'block';
                document.getElementById("label_bz1y").style.display = 'block';
                document.getElementById("label_bz2y").style.display = 'block';
                document.getElementById("label_bz3y").style.display = 'block';

                document.getElementById("bx0z1").style.display = 'block';
                document.getElementById("bx0z2").style.display = 'block';
                document.getElementById("bx0z3").style.display = 'block';
                document.getElementById("bx1z1").style.display = 'block';
                document.getElementById("bx1z2").style.display = 'block';
                document.getElementById("bx1z3").style.display = 'block';
                document.getElementById("bx2z1").style.display = 'block';
                document.getElementById("bx2z2").style.display = 'block';
                document.getElementById("bx2z3").style.display = 'block';
                document.getElementById("bz0y").style.display = 'block';
                document.getElementById("bz1y").style.display = 'block';
                document.getElementById("bz2y").style.display = 'block';
                document.getElementById("bz3y").style.display = 'block';

                document.getElementById("chart").style.display = 'block';

                document.getElementById("bx0z1").value = data[ke].bobot_awal.bX0Z1t0;
                document.getElementById("bx0z2").value = data[ke].bobot_awal.bX0Z2t0;
                document.getElementById("bx0z3").value = data[ke].bobot_awal.bX0Z3t0;
                document.getElementById("bx1z1").value = data[ke].bobot_awal.bX1Z1t0;
                document.getElementById("bx1z2").value = data[ke].bobot_awal.bX1Z2t0;
                document.getElementById("bx1z3").value = data[ke].bobot_awal.bX1Z3t0;
                document.getElementById("bx2z1").value = data[ke].bobot_awal.bX2Z1t0;
                document.getElementById("bx2z2").value = data[ke].bobot_awal.bX2Z2t0;
                document.getElementById("bx2z3").value = data[ke].bobot_awal.bX2Z3t0;
                document.getElementById("bz0y").value = data[ke].bobot_awal.bZ0Yt0;
                document.getElementById("bz1y").value = data[ke].bobot_awal.bZ1Yt0;
                document.getElementById("bz2y").value = data[ke].bobot_awal.bZ2Yt0;
                document.getElementById("bz3y").value = data[ke].bobot_awal.bZ3Yt0;

                setMorris(data[ke].chart);

            });
        }
    });
</script>
@endsection