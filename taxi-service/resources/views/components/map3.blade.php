<html>
<head>
    <link rel="stylesheet" href="{{asset('https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.css')}}" />
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/leaflet.js')}}"></script>
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-map.js?key=S8d7L47mdyAG5nHG09dUnSPJjreUVPeC"></script>
    <script src="https://www.mapquestapi.com/sdk/leaflet/v2.2/mq-routing.js?key=S8d7L47mdyAG5nHG09dUnSPJjreUVPeC"></script>
    <script src="{{asset('https://api.mqcdn.com/sdk/place-search-js/v1.0.0/place-search.js')}}"></script>
    <link rel="stylesheet" href="{{asset('https://api.mqcdn.com/sdk/place-search-js/v1.0.0/place-search.css')}}" />
</head>
<body style='border:0; margin: 0'>
<div id='map' ></div>
<div class="formBlock">
    <form id="form">
        <input type="search" id="place-search-input" class="inp1" placeholder="Start Location"/>
        <input type="search" id="place-search-input" class="inp2" placeholder="Destination"/>
        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">{{__('Get Directions')}}</button>
            </div>
        </div>
    </form>
</div>

<script src="{{asset('/js/app.js')}}"></script>
</body>
</html>
