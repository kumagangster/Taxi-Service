<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <style>
        #map {
            width: 100%;
            height: 400px;
        }

        #startLocation, #destination {
            width: 70%;
            margin-bottom: 10px;
        }

        #autocomplete-container {
            position: relative;
            width: 70%;
            margin-bottom: 10px;
        }

        .autocomplete-items {
            position: absolute;
            border: 1px solid #d4d4d4;
            max-height: 150px;
            overflow-y: auto;
            z-index: 99;
        }

        .autocomplete-item {
            padding: 8px;
            cursor: pointer;
        }

        .autocomplete-item:hover {
            background-color: #e9e9e9;
        }

        #estimatedPrice {
            margin-top: 10px;
        }
    </style>
    <link rel='stylesheet' href="{{asset('https://unpkg.com/leaflet@1.7.1/dist/leaflet.css')}}" crossorigin='' />
</head>

<body>

<div id='map'></div>
<h1>Taxi Booking</h1>
<div id='autocomplete-container'>
    <label for="startLocation">Current Location:</label>
    <input type="text" id="startLocation" name="startLocation" placeholder="Type or click on the map" required>
    <div class="autocomplete-items" id="startAutocomplete"></div>
</div>

<div id='autocomplete-container'>
    <label for="destination">Destination:</label>
    <input type="text" id="destination" name="destination" placeholder="Type or click on the map" required>
    <div class="autocomplete-items" id="destinationAutocomplete"></div>
</div>

<button type="button" onclick="calculateDistance()">Calculate Distance</button>

<p id="estimatedPrice"></p>

<button type="submit">Confirm Booking</button>

<script src='{{asset('https://unpkg.com/leaflet@1.7.1/dist/leaflet.js')}}' crossorigin=''></script>
<script>
    mapboxgl.accessToken = 'pk.eyJ1Ijoia3VtYWdhbmdzdGVyMDA3IiwiYSI6ImNsb3dlNXk0cjEydnYyc3Mxd2pmeDllZm4ifQ.wpd0bdLOCLCyWZOupJd5Qw';
    const map = new mapboxgl.Map({
        container: 'map', // container ID
        style: 'mapbox://styles/mapbox/streets-v12', // style URL
        center: [-74.5, 40], // starting position [lng, lat]
        zoom: 9, // starting zoom
    });
    {{--var mapboxApiKey = '{{ env("MAPBOX_API_KEY") }}';--}}
    {{--var map = L.map('map').setView([51.505, -0.09], 13);--}}
    {{--L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {--}}
    {{--    attribution: '© OpenStreetMap contributors'--}}
    {{--}).addTo(map);--}}

    {{--var startLocationInput = document.getElementById('startLocation');--}}
    {{--var destinationInput = document.getElementById('destination');--}}
    {{--var estimatedPrice = document.getElementById('estimatedPrice');--}}

    {{--map.on('click', function (e) {--}}
    {{--    var selectedLocation = e.latlng;--}}
    {{--    startLocationInput.value = selectedLocation.lat + ', ' + selectedLocation.lng;--}}
    {{--});--}}

    {{--var geocodingApiUrl = 'https://api.mapbox.com/geocoding/v5/mapbox.places/{query}.json?access_token=' + mapboxApiKey;--}}

    {{--function geocodeAddress(input, callback) {--}}
    {{--    var query = encodeURIComponent(input);--}}
    {{--    fetch(geocodingApiUrl.replace('{query}', query))--}}
    {{--        .then(response => response.json())--}}
    {{--        .then(data => {--}}
    {{--            if (data.features.length > 0) {--}}
    {{--                var coordinates = data.features[0].center;--}}
    {{--                callback(null, coordinates);--}}
    {{--            } else {--}}
    {{--                callback('Location not found', null);--}}
    {{--            }--}}
    {{--        })--}}
    {{--        .catch(error => {--}}
    {{--            callback(error, null);--}}
    {{--        });--}}
    {{--}--}}

    {{--function calculateDistance() {--}}
    {{--    var startLocation = startLocationInput.value;--}}
    {{--    var destination = destinationInput.value;--}}

    {{--    geocodeAddress(startLocation, function (error, startCoordinates) {--}}
    {{--        if (error) {--}}
    {{--            alert('Error geocoding start location: ' + error);--}}
    {{--            return;--}}
    {{--        }--}}

    {{--        geocodeAddress(destination, function (error, destinationCoordinates) {--}}
    {{--            if (error) {--}}
    {{--                alert('Error geocoding destination: ' + error);--}}
    {{--                return;--}}
    {{--            }--}}

    {{--            var distance = calculateDistanceBetweenPoints(startCoordinates, destinationCoordinates);--}}
    {{--            var price = calculatePrice(distance);--}}

    {{--            estimatedPrice.textContent = 'Estimated Price: $' + price.toFixed(2);--}}
    {{--        });--}}
    {{--    });--}}
    {{--}--}}

    {{--function calculateDistanceBetweenPoints(point1, point2) {--}}
    {{--    var lat1 = point1[1];--}}
    {{--    var lon1 = point1[0];--}}
    {{--    var lat2 = point2[1];--}}
    {{--    var lon2 = point2[0];--}}

    {{--    var R = 6371; // Radius of the Earth in kilometers--}}
    {{--    var dLat = deg2rad(lat2 - lat1);--}}
    {{--    var dLon = deg2rad(lon2 - lon1);--}}

    {{--    var a =--}}
    {{--        Math.sin(dLat / 2) * Math.sin(dLat / 2) +--}}
    {{--        Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *--}}
    {{--        Math.sin(dLon / 2) * Math.sin(dLon / 2);--}}

    {{--    var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));--}}
    {{--    var distance = R * c; // Distance in kilometers--}}

    {{--    return distance;--}}
    {{--}--}}

    {{--function deg2rad(deg) {--}}
    {{--    return deg * (Math.PI / 180);--}}
    {{--}--}}

    {{--function calculatePrice(distance) {--}}
    {{--    return distance * 1.5;--}}
    {{--}--}}
    {{--autocomplete(document.getElementById("startLocation"), document.getElementById("startAutocomplete"));--}}
    {{--autocomplete(document.getElementById("destination"), document.getElementById("destinationAutocomplete"));--}}

    {{--// Autocomplete function--}}
    {{--function autocomplete(input, autocompleteContainer) {--}}
    {{--    input.addEventListener("input", function () {--}}
    {{--        var query = this.value;--}}
    {{--        fetch(geocodingApiUrl.replace('{query}', encodeURIComponent(query)))--}}
    {{--            .then(response => response.json())--}}
    {{--            .then(data => {--}}
    {{--                autocompleteContainer.innerHTML = "";--}}
    {{--                data.features.forEach(item => {--}}
    {{--                    var option = document.createElement("div");--}}
    {{--                    option.innerHTML = "<strong>" + item.place_name + "</strong>";--}}
    {{--                    option.addEventListener("click", function () {--}}
    {{--                        input.value = item.place_name;--}}
    {{--                        autocompleteContainer.innerHTML = "";--}}
    {{--                    });--}}
    {{--                    autocompleteContainer.appendChild(option);--}}
    {{--                });--}}
    {{--            })--}}
    {{--            .catch(error => console.error(error));--}}
    {{--    });--}}

    {{--    document.addEventListener("click", function (e) {--}}
    {{--        if (e.target !== input) {--}}
    {{--            autocompleteContainer.innerHTML = "";--}}
    {{--        }--}}
    {{--    });--}}
    {{--}--}}
</script>
</body>

</html>
