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
                        <div class="col-md-12 col-lg-12">
                            <div class="card">
                                <div class="card-header"></div>
                                <div class="card-block">
                                    <div class="table-responsive">
                                        <table id="data-8-sensor" class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Entry Id</th>
                                                    <th>Day</th>
                                                    <th>Humidity 1</th>
                                                    <th>Temperature 1</th>
                                                    <th>Humidity 2</th>
                                                    <th>Temperature 2</th>
                                                    <th>Humidity 3</th>
                                                    <th>Temperature 3</th>
                                                    <th>Humidity 4</th>
                                                    <th>Temperature 4</th>
                                                    <th>Humidity 5</th>
                                                    <th>Temperature 5</th>
                                                    <th>Humidity 6</th>
                                                    <th>Temperature 6</th>
                                                    <th>Humidity 7</th>
                                                    <th>Temperature 7</th>
                                                    <th>Humidity 8</th>
                                                    <th>Temperature 8</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody"></tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Entry Id</th>
                                                    <th>Day</th>
                                                    <th>Humidity 1</th>
                                                    <th>Temperature 1</th>
                                                    <th>Humidity 2</th>
                                                    <th>Temperature 2</th>
                                                    <th>Humidity 3</th>
                                                    <th>Temperature 3</th>
                                                    <th>Humidity 4</th>
                                                    <th>Temperature 4</th>
                                                    <th>Humidity 5</th>
                                                    <th>Temperature 5</th>
                                                    <th>Humidity 6</th>
                                                    <th>Temperature 6</th>
                                                    <th>Humidity 7</th>
                                                    <th>Temperature 7</th>
                                                    <th>Humidity 8</th>
                                                    <th>Temperature 8</th>
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
            <div id="styleSelector"></div>
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

        var morrisLine;
        initMorris();
        getMorris();
        // setMorris(data);
        // getMorrisOffline();

        function initMorris() {
            morrisLine = Morris.Line({
                element: 'line-kelembapan',
                xkey: 'period',
                ykeys: ['a', 'b'],
                labels: ['Humidity', 'Temperature'],
                xLabelAngle: 10,
                parseTime: false,
                resize: true,
                lineColors: ['#32c5d2', '#c03e26']
            });
        }

        function setMorris(data) {
            morrisLine.setData(data);
        }

        function getMorris() {
            // $.get('@Url.Action("GetData")', function (result) {
            // setMorris(result);
            // });
            var dataLength = 7;
            let dataset = [];
            var dataLength = 3;

            firebase.database().ref('dataset').on('value', (snap) => {
                var totalRecord = snap.numChildren();
                var hum;
                var temp;
                var id = 0;
                var day;

                for (let x = 1; x < totalRecord; x++) {
                    // id = x;
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
                    firebase.database().ref('dataset/' + x + '/day').once('value',
                        function (
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
                        "a": hum,
                        "b": temp
                    }
                    if (dataset.length > dataLength) {
                        dataset.shift();
                        dataset.push(data);
                    } else {
                        dataset.push(data);
                    }
                }
                if (dataset.length != 0) {
                    setMorris(dataset);
                } else {
                    var lineData = [{
                            period: '2021-04-20 14:14:24',
                            a: 76.86,
                            b: 28.9
                        },
                        {
                            period: '2021-04-20 14:14:34',
                            a: 76.71,
                            b: 28.91
                        },
                        {
                            period: '2021-04-20 14:14:45',
                            a: 76.57,
                            b: 28.89
                        },
                        {
                            period: '2021-04-20 14:14:55',
                            a: 76.71,
                            b: 28.9
                        },
                        {
                            period: '2021-04-20 14:15:05',
                            a: 77,
                            b: 28.91
                        },
                        {
                            period: '2021-04-20 14:15:15',
                            a: 76.71,
                            b: 28.93
                        },
                        {
                            period: '2021-04-20 14:15:26',
                            a: 76.71,
                            b: 28.91
                        }
                    ];
                    setMorris(lineData);
                }

            });
        }

        function getMorrisOffline() {

        }
        var x = 0
        $('#data-8-sensor').on("draw.dt", function () {
            $(this).find(".dataTables_empty").parents('tbody').empty();
        }).DataTable({
            "searching": false,
            "tFilter"   : false,
            "bPaginate": false,
            "bLengthChange": false
        });
        function selectAllData() {    
            firebase.database().ref('data_sensor').on('value',
            function (
                snapshot) {
                snapshot.forEach(
                    function (childSnapshot) {
                        x++;
                        console.log(x);
                        var childKey = childSnapshot.key; //this is id 
                        // var dbRef = firebase.database();
                        var data1 = firebase.database().ref().child("data_sensor/" + x +
                            "/sensor_1/humidity").on('value', snap => hum1 = snap.val());
                        var data2 = firebase.database().ref().child("data_sensor/" + x +
                            "/sensor_1/temperature").on('value', snap => temp1 = snap.val());
                        var data3 = firebase.database().ref().child("data_sensor/" + x +
                            "/sensor_2/humidity").on('value', snap => hum2 = snap.val());
                        var data4 = firebase.database().ref().child("data_sensor/" + x +
                            "/sensor_2/temperature").on('value', snap => temp2 = snap.val());
                        var data5 = firebase.database().ref().child("data_sensor/" + x +
                            "/sensor_3/humidity").on('value', snap => hum3 = snap.val());
                        var data6 = firebase.database().ref().child("data_sensor/" + x +
                            "/sensor_3/temperature").on('value', snap => temp3 = snap.val());
                        var data7 = firebase.database().ref().child("data_sensor/" + x +
                            "/sensor_4/humidity").on('value', snap => hum4 = snap.val());
                        var data8 = firebase.database().ref().child("data_sensor/" + x +
                            "/sensor_4/temperature").on('value', snap => temp4 = snap.val());
                        var data9 = firebase.database().ref().child("data_sensor/" + x +
                            "/sensor_5/humidity").on('value', snap => hum5 = snap.val());
                        var data10 = firebase.database().ref().child("data_sensor/" + x +
                            "/sensor_5/temperature").on('value', snap => temp5 = snap.val());
                        var data11 = firebase.database().ref().child("data_sensor/" + x +
                            "/sensor_6/humidity").on('value', snap => hum6 = snap.val());
                        var data12 = firebase.database().ref().child("data_sensor/" + x +
                            "/sensor_6/temperature").on('value', snap => temp6 = snap.val());
                        var data13 = firebase.database().ref().child("data_sensor/" + x +
                            "/sensor_7/humidity").on('value', snap => hum7 = snap.val());
                        var data14 = firebase.database().ref().child("data_sensor/" + x +
                            "/sensor_7/temperature").on('value', snap => temp7 = snap.val());
                        var data15 = firebase.database().ref().child("data_sensor/" + x +
                            "/sensor_8/humidity").on('value', snap => hum8 = snap.val());
                        var data16 = firebase.database().ref().child("data_sensor/" + x +
                            "/sensor_8/temperature").on('value', snap => temp8 = snap.val());
                        var day         = childSnapshot.val().day;
                        var humidity1   = hum1;
                        var humidity2   = hum2;
                        var humidity3   = hum3;
                        var humidity4   = hum4;
                        var humidity5   = hum5;
                        var humidity6   = hum6;
                        var humidity7   = hum7;
                        var humidity8   = hum8;
                        var temperature1   = temp1;
                        var temperature2   = temp2;
                        var temperature3   = temp3;
                        var temperature4   = temp4;
                        var temperature5   = temp5;
                        var temperature6   = temp6;
                        var temperature7   = temp7;
                        var temperature8   = temp8;
                        AddItems(day,humidity1,humidity2,humidity3,humidity4,humidity5,humidity6,humidity7,humidity8,temperature1,temperature2,temperature3,temperature4,temperature5,temperature6,temperature7,temperature8);
                    }
                );
            });
        }
        window.onload = selectAllData();
        var no = 1;
        function AddItems(day,humidity1,humidity2,humidity3,humidity4,humidity5,humidity6,humidity7,humidity8,temperature1,temperature2,temperature3,temperature4,temperature5,temperature6,temperature7,temperature8) {
            var tbody = document.getElementById('tbody');
            var trow = document.createElement('tr');
            var td1 = document.createElement('td');
            var td2 = document.createElement('td');
            var td3 = document.createElement('td');
            var td4 = document.createElement('td');
            var td5 = document.createElement('td');
            var td6 = document.createElement('td');
            var td7 = document.createElement('td');
            var td8 = document.createElement('td');
            var td9 = document.createElement('td');
            var td10 = document.createElement('td');
            var td11 = document.createElement('td');
            var td12 = document.createElement('td');
            var td13 = document.createElement('td');
            var td14 = document.createElement('td');
            var td15 = document.createElement('td');
            var td16 = document.createElement('td');
            var td17 = document.createElement('td');
            var td18 = document.createElement('td');
            td1.innerHTML= no++;
            td2.innerHTML= day;
            td3.innerHTML= humidity1;
            td4.innerHTML= temperature1;
            td5.innerHTML= humidity2;
            td6.innerHTML= temperature2;
            td7.innerHTML= humidity3;
            td8.innerHTML= temperature3;
            td9.innerHTML= humidity4;
            td10.innerHTML= temperature4;
            td11.innerHTML= humidity5;
            td12.innerHTML= temperature5;
            td13.innerHTML= humidity6;
            td14.innerHTML= temperature6;
            td15.innerHTML= humidity7;
            td16.innerHTML= temperature7;
            td17.innerHTML= humidity8;
            td18.innerHTML= temperature8;
            trow.appendChild(td1);
            trow.appendChild(td2);
            trow.appendChild(td3);
            trow.appendChild(td4);
            trow.appendChild(td5);
            trow.appendChild(td6);
            trow.appendChild(td7);
            trow.appendChild(td8);
            trow.appendChild(td9);
            trow.appendChild(td10);
            trow.appendChild(td11);
            trow.appendChild(td12);
            trow.appendChild(td13);
            trow.appendChild(td14);
            trow.appendChild(td15);
            trow.appendChild(td16);
            trow.appendChild(td17);
            trow.appendChild(td18);
            tbody.appendChild(trow);
        }

        // var humidity1 = firebase.database().ref("data_sensor").child("1/" + "sensor_1/humidity").on('value', snapshot => {
        //     console.log(snapshot.val());
        // });
        // var humidity2 = firebase.database().ref("data_sensor").child("1/" + "sensor_2/humidity").on('value', snapshot => {
        //     console.log(snapshot.val());
        // });
        // var humidity3 = firebase.database().ref("data_sensor").child("1/" + "sensor_3/humidity").on('value', snapshot => {
        //     console.log(snapshot.val());
        // });
        // var humidity4 = firebase.database().ref("data_sensor").child("1/" + "sensor_4/humidity").on('value', snapshot => {
        //     console.log(snapshot.val());
        // });
        // var humidity5 = firebase.database().ref("data_sensor").child("1/" + "sensor_5/humidity").on('value', snapshot => {
        //     console.log(snapshot.val());
        // });
        // var humidity6 = firebase.database().ref("data_sensor").child("1/" + "sensor_6/humidity").on('value', snapshot => {
        //     console.log(snapshot.val());
        // });
        // var humidity7 = firebase.database().ref("data_sensor").child("1/" + "sensor_7/humidity").on('value', snapshot => {
        //     console.log(snapshot.val());
        // });
        // var humidity8 = firebase.database().ref("data_sensor").child("1/" + "sensor_8/humidity").on('value', snapshot => {
        //     console.log(snapshot.val());
        // });
        
        // var temperature1 = firebase.database().ref("data_sensor").child("1/" + "sensor_1/temperature").on('value', snapshot => {
        //     console.log(snapshot.val());
        // });
        // var temperature2 = firebase.database().ref("data_sensor").child("1/" + "sensor_2/temperature").on('value', snapshot => {
        //     console.log(snapshot.val());
        // });
        // var temperature3 = firebase.database().ref("data_sensor").child("1/" + "sensor_3/temperature").on('value', snapshot => {
        //     console.log(snapshot.val());
        // });
        // var temperature4 = firebase.database().ref("data_sensor").child("1/" + "sensor_4/temperature").on('value', snapshot => {
        //     console.log(snapshot.val());
        // });
        // var temperature5 = firebase.database().ref("data_sensor").child("1/" + "sensor_5/temperature").on('value', snapshot => {
        //     console.log(snapshot.val());
        // });
        // var temperature6 = firebase.database().ref("data_sensor").child("1/" + "sensor_6/temperature").on('value', snapshot => {
        //     console.log(snapshot.val());
        // });
        // var temperature7 = firebase.database().ref("data_sensor").child("1/" + "sensor_7/temperature").on('value', snapshot => {
        //     console.log(snapshot.val());
        // });
        // var temperature8 = firebase.database().ref("data_sensor").child("1/" + "sensor_8/temperature").on('value', snapshot => {
        //     console.log(snapshot.val());
        // });

        // console.log(sensor);
 
        // // Dapatkan referensi table
        // var tabel_sensor = document.getElementsByName("tabel-data-sensor").getElementsByTagName('tbody')[0];
        
        // // Memuat Data
        // tabel_sensor.on("child_added", function(data, prevChildKey) {
        //     var newstatusAlat = data.val();
            
        //     var row = tabel_sensor.insertRow(table.rows.length);
            
        //     var cell1 = row.insertCell(0);
        //     var cell2 = row.insertCell(1);
        //     var cell3 = row.insertCell(2);
        //     var cell4 = row.insertCell(3);
            
        //     cell1.innerHTML = temperature1;
        //     cell2.innerHTML = newstatusAlat.status_alat;
        //     cell3.innerHTML = newstatusAlat.tanggal_alat;
        //     cell4.innerHTML = newstatusAlat.jam_alat;
        // });
        
    });
</script>

@endsection