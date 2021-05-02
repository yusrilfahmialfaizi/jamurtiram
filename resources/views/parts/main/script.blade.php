<script data-cfasync="false" src="..\..\..\cdn-cgi\scripts\5c5dd728\cloudflare-static\email-decode.min.js"></script>
<script type="text/javascript" src="{{asset('assets\bower_components\jquery\js\jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets\bower_components\jquery-ui\js\jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets\bower_components\popper.js\js\popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets\bower_components\bootstrap\js\bootstrap.min.js')}}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{asset('assets\bower_components\jquery-slimscroll\js\jquery.slimscroll.js')}}">
</script>
<!-- modernizr js -->
<script type="text/javascript" src="{{asset('assets\bower_components\modernizr\js\modernizr.js')}}"></script>
<!-- Chart js -->
<script type="text/javascript" src="{{asset('assets\bower_components\chart.js\js\Chart.js')}}"></script>
<!-- amchart js -->
<script src="{{asset('assets\assets\pages\widget\amchart\amcharts.js')}}"></script>
<script src="{{asset('assets\assets\pages\widget\amchart\serial.js')}}"></script>
<script src="{{asset('assets\assets\pages\widget\amchart\light.js')}}"></script>
<script src="{{asset('assets\assets\js\jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets\assets\js\SmoothScroll.js')}}"></script>
<script src="{{asset('assets\assets\js\pcoded.min.js')}}"></script>

<!-- knob js -->
<script src="{{asset('assets\assets\pages\chart\knob\jquery.knob.js')}}"></script>
<script type="text/javascript" src="{{asset('assets\assets\pages\chart\knob\knob-custom-chart.js')}}"></script>

<!-- sweet alert js -->
<script type="text/javascript" src="{{asset('assets\bower_components\sweetalert\js\sweetalert.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets\assets\js\modal.js')}}"></script>

<!-- data-table js -->
<script src="{{asset('assets\bower_components\datatables.net\js\jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets\assets\pages\data-table\js\jszip.min.js')}}"></script>
<script src="{{asset('assets\assets\pages\data-table\js\pdfmake.min.js')}}"></script>
<script src="{{asset('assets\assets\pages\data-table\js\vfs_fonts.js')}}"></script>
<script src="{{asset('assets\bower_components\datatables.net-buttons\js\buttons.print.min.js')}}"></script>
<script src="{{asset('assets\bower_components\datatables.net-buttons\js\buttons.html5.min.js')}}"></script>
<script src="{{asset('assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js')}}">
</script>
<script src="{{asset('assets\assets\pages\data-table\extensions\buttons\js\extension-btns-custom.js')}}"></script>
<script src="{{asset('assets\assets\pages\data-table\js\data-table-custom.js')}}"></script>

<!-- Morris Chart js -->
<script src="{{asset('assets\bower_components\raphael\js\raphael.min.js')}}"></script>
<script src="{{asset('assets\bower_components\morris.js\js\morris.js')}}"></script>

<!-- custom js -->
<script src="{{asset('assets\assets\js\vartical-layout.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets\assets\pages\dashboard\custom-dashboard.js')}}"></script>
<script type="text/javascript" src="{{asset('assets\assets\js\script.min.js')}}"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
</script>

{{-- <script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
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
  // firebase.analytics();

  // var dt = dbRef.ref().child("dataset");
  // dt.on('value', snp => console.log(snp.val()));

  for (let x = 20; x < 22; x++) {
    console.log(x);
    firebase.database().ref('dataset/'+x+'/humidity').once('value', function(snapshot) {
      snapshot.forEach(function(childSnapshot) {
        var childKey = childSnapshot.key;//this is id 
        var dbRef = firebase.database();
        console.log("dataset/"+x+"/humidity/"+childKey);
        var data = dbRef.ref().child("dataset/"+x+"/humidity/"+childKey);
        data.on('value', snap => console.log(snap.val()));
        console.log(data);
      });
    });

  }

</script> --}}