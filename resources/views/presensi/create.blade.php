@extends('layouts/presensi')
@section('header')
<style>
    .webcam-capture, .webcam-capture video {
        display: inline-block;
        width: 100% !important;
        margin: auto;
        height: auto !important;
        border-radius: 15px;
    }
    #map { height: 180px; }
</style>
    <!-- App Header -->
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">Blank Page</div>
        <div class="right"></div>
    </div>
    <!-- * App Header -->
@endsection
@section('content')
    <div class="row" style="margin-top: 70px;">
    <div class="col">
        <input type="hidden" id="lat">
        <input type="hidden" id="long">
        <div class="webcam-capture"></div>
    </div>
    </div>
    <div class="row">
        <div class="col">
            <button id="takeabsen" class="btn btn-primary btn-block"><ion-icon name="camera-outline"></ion-icon> Absen Masuk</button>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col">
            <div id="map"></div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        Webcam.set({
            height:480,
            width:648,
            image_format:'jpeg',
            jpeg_quality: 80
        });
        Webcam.attach('.webcam-capture');

        var lat = document.getElementById('lat');
        var long = document.getElementById('long');
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(successCallback, errorCalback);
        }

        function successCallback(position){
            lat.value = position.coords.latitude;
            long.value = position.coords.longitude;
            var map = L.map('map').setView([position.coords.latitude, position.coords.longitude], 13);
            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);
            var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
            var polygon = L.polygon([
                [-7.783340104479848, 110.35778669885015],
                [-7.7832338045254765, 110.35719641510484],
                [-7.784610386848623, 110.35696030160666],
                [-7.784759206288424, 110.3575183880568]
            ]).addTo(map);
        }
        function errorCalback(){

        }

        $('#takeabsen').click(function(e){
            Webcam.snap(function(uri){
                image = uri;
            });
            alert(image);
        }); 
    </script>
@endpush