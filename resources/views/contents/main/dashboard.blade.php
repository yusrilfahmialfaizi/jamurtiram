@extends('parts.main.master')
@section('content')
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">

                <div class="page-body">
                    <div class="row">
                        <!-- LINE CHART start -->
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Kelembapan</h5>
                                </div>
                                <div class="card-block">
                                    <div id="line-kelembapan"></div>
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

        // suhuChart(firebaseConfig);
        kelembapanChart(firebaseConfig);

        // // Initialize Firebase
        // firebase.initializeApp(firebaseConfig);

        // firebase.database().ref('dataset').on('value', (snap) => {
        //     var totalRecord = snap.numChildren();


        //     for (let x = 0; x < totalRecord; x++) {
        //         firebase.database().ref('dataset/' + x + '/humidity').once('value', function (snapshot) {
        //             snapshot.forEach(function (childSnapshot) {
        //                 var childKey = childSnapshot.key; //this is id 
        //                 var dbRef = firebase.database();
        //                 var data = dbRef.ref().child("dataset/" + x + "/humidity/" + childKey);
        //                 data.on('value', snap => console.log(snap.val()));
        //             });
        //         });
        //         firebase.database().ref('dataset/' + x + '/temperature').once('value', function (snapshot) {
        //             snapshot.forEach(function (childSnapshot) {
        //                 var childKey = childSnapshot.key; //this is id 
        //                 var dbRef = firebase.database();
        //                 var data = dbRef.ref().child("dataset/" + x + "/temperature/" + childKey);
        //                 data.on('value', snap => console.log(snap.val()));
        //             });
        //         });

        //     }
        // });

        function kelembapanChart(firebaseConfig) {

            let dataset = [];

            // var firebaseConfig = {
            //     apiKey: "AIzaSyAfolJxQxt38Dj6sLFGVwFxUa5B2qALBuI",
            //     authDomain: "jamurtiram-a1bc2.firebaseapp.com",
            //     databaseURL: "https://jamurtiram-a1bc2-default-rtdb.firebaseio.com",
            //     projectId: "jamurtiram-a1bc2",
            //     storageBucket: "jamurtiram-a1bc2.appspot.com",
            //     messagingSenderId: "420391507616",
            //     appId: "1:420391507616:web:5c591251e33b470061dbc5",
            //     measurementId: "G-E6MV5SJJ4C"
            // };
            // Initialize Firebase
            firebase.initializeApp(firebaseConfig);

            firebase.database().ref('dataset').on('value', (snap) => {
                var totalRecord = snap.numChildren();
                var hum;
                var temp;
                var id


                for (let x =  totalRecord - 5 ; x < totalRecord; x++) {
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

        // function kelembapanChart(firebaseConfig) {
        //     window.lineChart = Morris.Line({
        //         element: "line-kelembapan",
        //         data: [{
        //             y: "2006",
        //             hum: 100,
        //             temp: 90
        //         }],
        //         xkey: "y",
        //         redraw: true,
        //         ykeys: ["hum", "temp"],
        //         hideHover: "auto",
        //         labels: ["Kelembapan", "Suhu"],
        //         lineColors: ["#B4C1D7", "#FF9F55"],
        //     });
        // }
    })
</script>
@endsection