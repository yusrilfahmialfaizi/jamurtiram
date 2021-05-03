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
                                        <h4>Simulasi Analisis Data Mandiri</h4>
                                    </center>

                                </div>
                                <div class="card-block">
                                    {{-- <form action="{{ action('PerhitunganController@training')}}" method="POST"
                                    accept-charset="UTF-8"> --}}
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Learning Rate</label>
                                        <div class="col-sm-2">
                                            <select name="learning_rate" id="learning_rate" class="form-control">
                                                <option value="0.2">default</option>
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
                                                <option value="600">default</option>
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
                                                <option value="0.0000001">default</option>
                                                <option value="0.1">0.1</option>
                                                <option value="0.01">0.01</option>
                                                <option value="0.001">0.001</option>
                                                <option value="0.0001">0.0001</option>
                                                <option value="0.00001">0.00001</option>
                                                <option value="0.000001">0.000001</option>
                                                <option value="0.0000001">0.0000001</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Temperatur</label>
                                        <div class="col-sm-4">
                                            <input type="number" name="suhu" step=any id="suhu" class="form-control"
                                                min="0" required>
                                        </div>
                                        {{-- </div>
                                        <div class="form-group row"> --}}
                                        <label class="col-sm-2 col-form-label">Kelembapan</label>
                                        <div class="col-sm-4">
                                            <input type="number" min="0" step=any name="kelembapan" id="kelembapan"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            {{-- <input type="submit" class="form-control" min="0" class="btn btn-primary" value="Analysis"> --}}
                                            <button class="btn btn-primary" name="analys" id="analys">Analysis</button>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" id="label_hasil">Hasil</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="output" id="output" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" id="label_T">Target</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="target" id="target" class="form-control" readonly>
                                        </div>
                                        <label class="col-sm-2 col-form-label" id="label_Ta">Target Akhir</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="hasil" id="hasil" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label" id="label_NF">Nilai Fuzzy</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="nilai_fuzzy" id="nilai_fuzzy" class="form-control"
                                                readonly>
                                        </div>
                                        <label class="col-sm-2 col-form-label" id="label_HF">Hasil Fuzzy</label>
                                        <div class="col-sm-4">
                                            <input type="text" name="hasil_fuzzy" id="hasil_fuzzy" class="form-control"
                                                readonly>
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
        document.getElementById("label_hasil").style.display = 'none';
        document.getElementById("output").style.display = 'none';
        document.getElementById("label_Ta").style.display = 'none';
        document.getElementById("hasil").style.display = 'none';
        document.getElementById("label_T").style.display = 'none';
        document.getElementById("target").style.display = 'none';
        document.getElementById("label_NF").style.display = 'none';
        document.getElementById("nilai_fuzzy").style.display = 'none';
        document.getElementById("label_HF").style.display = 'none';
        document.getElementById("hasil_fuzzy").style.display = 'none';

        $("#analys").on('click', function () {
            var learning_rate = $('#learning_rate').val();
            var epoch = $('#epoch').val();
            var error = $('#error').val();
            var suhu = $('#suhu').val();
            var kelembapan = $('#kelembapan').val();

            $.ajax({
                url: "{{URL::to('perhitungan/training')}}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                        .attr('content')
                },
                // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
                dataType: 'json',
                data: {
                    learning_rate: learning_rate,
                    epoch: epoch,
                    error: error,
                    suhu: suhu,
                    kelembapan: kelembapan
                },
                cache: false,
                success: function (data) {
                    console.log(data);
                    document.getElementById("label_hasil").style.display = 'block';
                    document.getElementById("output").style.display = 'block';
                    document.getElementById("label_Ta").style.display = 'block';
                    document.getElementById("hasil").style.display = 'block';
                    document.getElementById("label_T").style.display = 'block';
                    document.getElementById("target").style.display = 'block';
                    document.getElementById("label_NF").style.display = 'block';
                    document.getElementById("nilai_fuzzy").style.display = 'block';
                    document.getElementById("label_HF").style.display = 'block';
                    document.getElementById("hasil_fuzzy").style.display = 'block';
                    document.getElementById("output").value = data.hasil;
                    document.getElementById("target").value = data.target;
                    document.getElementById("hasil").value = data.hasil_akhir;
                    document.getElementById("nilai_fuzzy").value = data.nilai_fuzzy;
                    document.getElementById("hasil_fuzzy").value = data.fuzzy_output;
                }
            })
        })
    });
</script>
@endsection