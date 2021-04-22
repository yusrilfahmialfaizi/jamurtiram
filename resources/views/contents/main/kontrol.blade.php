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
                                            href="{{Request::segment(1)}}">{{Request::segment(1)}}</a>
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
                                    <center>
                                        <h4>Kontrol </h4>
                                    </center>

                                </div>
                                <div class="card-block">
                                    {{-- <form action="{{ action('PerhitunganController@training')}}" method="POST"
                                    accept-charset="UTF-8"> --}}
                                    {{ csrf_field() }}
                                    <div class="form-group row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="checkbox-zoom zoom-primary">
                                                <label>
                                                    <input type="checkbox" id="otomatis" value="">
                                                    <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                    <span class="col-sm-2 col-form-label">Otomatis</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="checkbox-zoom zoom-primary">
                                                <label>
                                                    <input type="checkbox" id="manual" value="">
                                                    <span class="cr">
                                                        <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                                    </span>
                                                    <span class="col-sm-2 col-form-label">Manual</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Lama Siram</label>
                                        <div class="col-sm-4">
                                            <select name="lama_siram" id="lama_siram" class="form-control">
                                                <option value="&nbsp">--pilih--</option>
                                                <option value="3">3 menit</option>
                                                <option value="5">5 menit</option>
                                                <option value="10">10 menit</option>
                                                <option value="15">15 menit</option>
                                            </select>
                                        </div>
                                        <label class="col-sm-2 col-form-label">Suhu Batas Siram</label>
                                        <div class="col-sm-4">
                                            <input type="number" name="batas_suhu" step=any id="batas_suhu" class="form-control"
                                                min="0" required>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-2">
                                            <button class="btn btn-primary" name="set" id="set">SET</button>
                                        </div>
                                        <div class="col-sm-2">
                                            <button class="btn btn-danger" name="reset" id="reset">RESET</button>
                                        </div>
                                    </div>
                                    {{-- </form> --}}

                                </div>
                            </div>
                            <script type="text/javascript">
                                $(document).ready(function () {

                                    var firebaseConfig = {
                                        apiKey: "AIzaSyAfolJxQxt38Dj6sLFGVwFxUa5B2qALBuI",
                                        authDomain: "jamurtiram-a1bc2.firebaseapp.com",
                                        databaseURL: "https://jamurtiram-a1bc2-default-rtdb.firebaseio.com",
                                        projectId: "jamurtiram-a1bc2",
                                        storageBucket: "jamurtiram-a1bc2.appspot.com",
                                        messagingSenderId: "420391507616",
                                        appId: "1:420391507616:web:5c591251e33b470061dbc5",
                                        measurementId: "G-E6MV5SJJ4C"
                                    };
                                    // Initialize Firebase
                                    firebase.initializeApp(firebaseConfig);

                                    firebase.database().ref('auto').on('value', (snap) => {
                                        // console.log(snap.val());
                                        if (snap.val() == 99) {
                                            document.getElementById("otomatis").checked = true;
                                            document.getElementById("manual").disabled = true;
                                            document.getElementById("lama_siram").disabled = false;
                                            document.getElementById("batas_suhu").disabled = false;
                                            document.getElementById("set").disabled = false;
                                            document.getElementById("reset").disabled = false;


                                        } else if (snap.val() == 98) {
                                        
                                            document.getElementById("otomatis").checked = false;
                                            document.getElementById("manual").disabled = false;
                                            document.getElementById("lama_siram").disabled = true;
                                            document.getElementById("batas_suhu").disabled = true;
                                            document.getElementById("set").disabled = true;
                                            document.getElementById("reset").disabled = true;

                                        }
                                        // document.getElementById("suhu_nilai").innerHTML = snap.val() +
                                        //     " &#8451";
                                        // $('#suhu').val(snap.val()).trigger('change');
                                    });

                                    // Add Data
                                    $('#otomatis').on('click', function () {
                                        if (document.getElementById("otomatis").checked == true) {
                                            firebase.database().ref().child("auto").set(99);
                                        }else if (document.getElementById("otomatis").checked == false) {
                                            firebase.database().ref().child("auto").set(98);
                                        }
                                    });
                                    $('#manual').on('click', function () {
                                        if (document.getElementById("manual").checked == true) {
                                            document.getElementById("otomatis").checked = false;
                                            firebase.database().ref().child("auto").set(98);
                                            firebase.database().ref().child("pompa_dc").set(255);
                                            firebase.database().ref().child("relay_ac").set(1);
                                        }else if (document.getElementById("manual").checked == false) {
                                            firebase.database().ref().child("pompa_dc").set(0);
                                            firebase.database().ref().child("relay_ac").set(0);
                                        }
                                    });
                                    $('#set').on('click', function () {

                                        var lama_siram = $('#lama_siram').val();
                                        var batas_suhu = $('#batas_suhu').val();

                                        console.log(lama_siram);
                                        console.log(batas_suhu);

                                        firebase.database().ref().child("auto").set(99);
                                        firebase.database().ref().child("bs").set(batas_suhu);
                                        firebase.database().ref().child("sr").set(lama_siram);

                                    });
                                });
                            </script>
                            @endsection