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
                    // console.log(day);
                    // console.log(tanggal);
                    // console.log(clock);
                    // console.log(dateObject);
                    let data = {
                        "period": tanggal + " " + clock,
                        "park1": hum,
                        "park2": temp
                    }
                    console.log(dataset.length);
                    // console.log(dataLength);
                    if (dataset.length > dataLength) {
                        dataset.shift();
                        dataset.push(data);
                    } else {
                        dataset.push(data);
                    }
                }
                // console.log(id);
                window.lineChart = Morris.Line({
                    element: 'line-kelembapan',
                    // data: [{
                    //         period: '2015-05-10 03:02:49',
                    //         park1: 200,
                    //         park2: 200,
                    //     },
                    //     {
                    //         period: '2015-05-10 04:46:30',
                    //         park1: 15,
                    //         park2: 275,
                    //     },
                    //     {
                    //         period: '2015-05-10 05:46:30',
                    //         park1: 15,
                    //         park2: 275,
                    //     },
                    //     {
                    //         period: '2015-05-10 06:46:30',
                    //         park1: 15,
                    //         park2: 275,
                    //     }
                    // ],
                    data: dataset,
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
<script>
    var rata2mape = (parseFloat(data[0].mape) + parseFloat(data[1].mape) + parseFloat(data[2].mape) + parseFloat(data[3].mape) + parseFloat(data[4].mape) + parseFloat(data[5].mape) + parseFloat(data[6]
        .mape) + parseFloat(data[7].mape) + parseFloat(data[8].mape) + parseFloat(data[9].mape)) / 10;
    var rata2akurasi = (parseFloat(data[0].akurasi) + parseFloat(data[1].akurasi) + parseFloat(data[2].akurasi) + parseFloat(data[3].akurasi) + parseFloat(data[4].akurasi) + parseFloat(data[
        5].)akurasi + parseFloat(data[6].akurasi) + parseFloat(data[7].akurasi) + parseFloat(data[8].akurasi) + parseFloat(data[9].akurasi)) / 10;
</script>