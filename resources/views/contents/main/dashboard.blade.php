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
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>DATA</h5>
                                </div>
                                <div class="card-block">
                                    <div id="line-kelembapan"></div>
                                </div>
                            </div>
                        </div>
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
            // console.log(snap.val());
            document.getElementById("suhu_nilai").innerHTML = snap.val() + " &#8451";
            $('#suhu').val(snap.val()).trigger('change');
        });
        firebase.database().ref('hum').on('value', (snap) => {
            // console.log(snap.val());
            document.getElementById("lembap_nilai").innerHTML = snap.val() + " %";
            $('#lembap').val(snap.val()).trigger('change');
        });

        kelembapanChart();

        function kelembapanChart(firebaseConfig) {

            let dataset = [];
            var dataLength = 3;

            firebase.database().ref('dataset').on('value', (snap) => {
                var totalRecord = snap.numChildren();
                var hum;
                var temp;
                var id = 0;
                var day;


                // for (let x = totalRecord - 20; x < totalRecord; x++) {
                for (let x = 1; x < totalRecord; x++) {
                    // id = x;
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
                    firebase.database().ref('dataset/' + x + '/day').once('value', function (
                        snapshot) {
                        snapshot.forEach(function (childSnapshot) {
                            var childKey = childSnapshot.key; //this is id 
                            var dbRef = firebase.database();
                            var data = dbRef.ref().child("dataset/" + x +
                                "/day/" + childKey);
                            data.on('value', snap => day = snap.val());
                        });
                    });
                    var date = day.substring(0, 9);
                    var clock = day.substring(10, 18);
                    var newDate = date.replaceAll("/", "-")
                    var tanggal = newDate.split("-").reverse().join("-");
                    var dateObject = new Date(newDate);
                    let data = {
                        "period": tanggal + " " + clock,
                        "park1": hum,
                        "park2": temp
                    }
                    if (dataset.length > dataLength) {
                        dataset.shift();
                        dataset.push(data);
                    }else{
                        dataset.push(data);
                    }
                }
                console.log(dataset);
                window.lineChart = Morris.Line({
                    element: 'line-kelembapan',
                    data: [{
                            period: '2015-05-10 03:02:49',
                            park1: 200,
                            park2: 200,
                        },
                        {
                            period: '2015-05-10 04:46:30',
                            park1: 15,
                            park2: 275,
                        },
                        {
                            period: '2015-05-10 05:46:30',
                            park1: 15,
                            park2: 275,
                        },
                        {
                            period: '2015-05-10 06:46:30',
                            park1: 15,
                            park2: 275,
                        }
                    ],
                    // data: dataset,
                    lineColors: ['#819C79', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
                    xkey: 'period',
                    ykeys: ['park1', 'park2'],
                    labels: ['Kelembapan', 'Suhu'],
                    xLabels: 'period',
                    xLabelAngle: 45,
                    resize: true
                });
            });
        }
    });
</script>

@endsection