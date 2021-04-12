@extends('parts.main.master')
@section('content')
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                <div class="page-body">
                    <div class="row">
                        <!-- ANGLE OFFSET AND ARC start -->
                        <div class="col-lg-6 col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>KELEMBAPAN</h5>
                                    <span></span>
                                </div>
                                <div class="card-block text-center">
                                    <input type="text" class="dial" id="lembap" data-width="200" data-height="200"
                                        data-fgcolor="#4ECDC4" data-angleoffset="-125" data-anglearc="250"
                                        data-linecap="round" data-rotation="clockwise" data-readonly="true"
                                        data-displayinput="false" />
                                    <h2 style="color:#4ECDC4;" id="lembap_nilai"></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>SUHU </h5>
                                    <span></span>
                                </div>
                                <div class="card-block text-center">
                                    <input type="any" class="dial" id="suhu" data-width="200" data-height="200"
                                        data-fgcolor="#ff6347" data-angleoffset="-125" data-anglearc="250"
                                        data-linecap="round" data-rotation="clockwise" data-readonly="true"
                                        data-displayinput="false" />
                                    <h2 style="color:Tomato;" id="suhu_nilai"></h2>
                                </div>
                            </div>
                        </div>
                        <!-- ANGLE OFFSET AND ARC Ends -->
                        <!-- LINE CHART start -->
                        <div class="col-md-12 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>DATA</h5>
                                </div>
                                <div class="card-block">
                                    {{-- <div id="line-kelembapan"></div> --}}
                                    {{-- <div class="ct-chart2 ct-perfect-fourth"></div> --}}
                                    <div id="chartHumidity" style="height: 250px; width: 100%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>DATA</h5>
                                </div>
                                <div class="card-block">
                                    {{-- <div id="line-kelembapan"></div> --}}
                                    <div id="chartTemp" style="height: 250px; width: 100%"></div>
                                </div>
                            </div>
                        </div>
                        <!-- LINE CHART Ends -->
                        <!-- LINE CHART start -->
                        {{-- <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Suhu</h5>
                                </div>
                                <div class="card-block">
                                    <div id="line-suhu"></div>
                                </div>
                            </div>
                        </div> --}}
                        <!-- LINE CHART Ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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

        firebase.database().ref('temp').on('value', (snap) => {
            console.log(snap.val());
            document.getElementById("suhu_nilai").innerHTML = snap.val() + " &#8451";
            $('#suhu').val(snap.val()).trigger('change');
        });
        firebase.database().ref('hum').on('value', (snap) => {
            console.log(snap.val());
            document.getElementById("lembap_nilai").innerHTML = snap.val() + " %";
            $('#lembap').val(snap.val()).trigger('change');
        });

        kelembapanChart();

        function kelembapanChart(firebaseConfig) {

            let dataset = [];
            var dataLength = 20;

            firebase.database().ref('dataset').on('value', (snap) => {
                var totalRecord = snap.numChildren();
                var hum;
                var temp;
                var id


                for (let x = totalRecord - 20; x < totalRecord; x++) {
                    id = x;
                    firebase.database().ref('dataset/' + x + '/humidity').once('value', function (
                        snapshot) {
                        snapshot.forEach(function (childSnapshot) {
                            var childKey = childSnapshot.key; //this is id 
                            var dbRef = firebase.database();
                            var data = dbRef.ref().child("dataset/" + x + "/humidity/" +
                                childKey);
                            data.on('value', snap => hum = snap.val());
                        });
                    });
                    firebase.database().ref('dataset/' + x + '/temperature').once('value', function (
                        snapshot) {
                        snapshot.forEach(function (childSnapshot) {
                            var childKey = childSnapshot.key; //this is id 
                            var dbRef = firebase.database();
                            var data = dbRef.ref().child("dataset/" + x +
                                "/temperature/" + childKey);
                            data.on('value', snap => temp = snap.val());
                        });
                    });
                    let data = {
                        "y": id,
                        "hum": hum,
                        "temp": temp
                    }
                    dataset.push(data);
                }
                if (dataset.length > dataLength) {
                    dataset.shift();
                }
                window.lineChart = Morris.Line({
                    element: "line-kelembapan",
                    data: dataset,
                    xkey: "y",
                    redraw: true,
                    ykeys: ["hum", "temp"],
                    hideHover: "auto",
                    labels: ["Kelembapan", "Suhu"],
                    lineColors: ["#B4C1D7", "#FF9F55"],
                });
            });
        }
        window.onload = function () {
            var dps1 = []; // dataPoints
            var dps2 = []; // dataPoints
            var chart1 = new CanvasJS.Chart("chartHumidity", {
                title: {
                    text: "Kelembapan",
                },
                data: [{
                    type: "spline",
                    markerSize: 0,
                    dataPoints: dps1,
                }, ],
            });
            var chart2 = new CanvasJS.Chart("chartTemp", {
                title: {
                    text: "Suhu",
                },
                data: [{
                    type: "spline",
                    markerSize: 0,
                    dataPoints: dps2,
                }, ],
            });

            var updateInterval = 5000;
            var dataLength = 20; // number of dataPoints visible at any point

            var updateChart1 = function (count) {
                count = count || 1;

                firebase.database().ref('dataset').on('value', (snap) => {
                    var totalRecord = snap.numChildren();
                    var hum;
                    var temp;
                    var id


                    for (let x = totalRecord - 10; x < totalRecord; x++) {
                        id = x;
                        firebase.database().ref('dataset/' + x + '/humidity').once('value',
                            function (
                                snapshot) {
                                snapshot.forEach(function (childSnapshot) {
                                    var childKey = childSnapshot.key; //this is id 
                                    var dbRef = firebase.database();
                                    var data = dbRef.ref().child("dataset/" + x +
                                        "/humidity/" +
                                        childKey);
                                    data.on('value', snap => hum = snap.val());
                                });
                            });
                        dps1.push({
                            x: id,
                            y: hum,
                        });
                    }
                });

                if (dps1.length > dataLength) {
                    dps1.shift();
                }

                chart1.render();
            };

            var updateChart2 = function (count) {
                count = count || 1;

                firebase.database().ref('dataset').on('value', (snap) => {
                    var totalRecord = snap.numChildren();
                    var hum;
                    var temp;
                    var id


                    for (let x = totalRecord - 10; x < totalRecord; x++) {
                        id = x;
                        
                        firebase.database().ref('dataset/' + x + '/temperature').once('value',
                            function (
                                snapshot) {
                                snapshot.forEach(function (childSnapshot) {
                                    var childKey = childSnapshot.key; //this is id 
                                    var dbRef = firebase.database();
                                    var data = dbRef.ref().child("dataset/" + x +
                                        "/temperature/" + childKey);
                                    data.on('value', snap => temp = snap.val());
                                });
                            });
                        dps2.push({
                            x: id,
                            y: temp,
                        });
                    }
                });

                if (dps2.length > dataLength) {
                    dps2.shift();
                }

                chart2.render();
            };

            updateChart1(dataLength);
            setInterval(function () {
                updateChart1();
            }, updateInterval);

            updateChart2(dataLength);
            setInterval(function () {
                updateChart2();
            }, updateInterval);
        };
        
    })
</script>

@endsection