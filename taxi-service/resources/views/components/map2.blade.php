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
    </style>
    <link rel='stylesheet' href='https://unpkg.com/leaflet@1.7.1/dist/leaflet.css' crossorigin='' />
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css' rel='stylesheet' />
</head>

<body>
<h1>Taxi Booking</h1>
<div id='map'></div>
<form id="bookingForm">
    <label for="startLocation">Current Location:</label>
    <input type="text" id="startLocation" name="startLocation" placeholder="Type or click on the map" required>

    <label for="destination">Destination:</label>
    <input type="text" id="destination" name="destination" placeholder="Type or click on the map" required>

    <button type="button" onclick="calculateDistance()">Calculate Distance</button>

    <p id="estimatedPrice"></p>

    <button type="submit">Confirm Booking</button>
</form>

<script src='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js'></script>

<script src='https://unpkg.com/leaflet@1.7.1/dist/leaflet.js' crossorigin=''></script>
<script>
    var mapboxApiKey = '{{ env("MAPBOX_API_KEY") }}';
    var map = L.map('map').setView([51.505, -0.09], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var startLocationInput = document.getElementById('startLocation');
    var destinationInput = document.getElementById('destination');
    var estimatedPrice = document.getElementById('estimatedPrice');

    map.on('click', function (e) {
        var selectedLocation = e.latlng;
        startLocationInput.value = selectedLocation.lat + ', ' + selectedLocation.lng;
    });

    var geocodingApiUrl = 'https://api.mapbox.com/geocoding/v5/mapbox.places/{query}.json?access_token=' + mapboxApiKey;

    function geocodeAddress(input, callback) {
        var query = encodeURIComponent(input);
        fetch(geocodingApiUrl.replace('{query}', query))
            .then(response => response.json())
            .then(data => {
                if (data.features.length > 0) {
                    var coordinates = data.features[0].center;
                    callback(null, coordinates);
                } else {
                    callback('Location not found', null);
                }
            })
            .catch(error => {
                callback(error, null);
            });
    }

    function calculateDistance() {
        var startLocation = startLocationInput.value;
        var destination = destinationInput.value;

        geocodeAddress(startLocation, function (error, startCoordinates) {
            if (error) {
                alert('Error geocoding start location: ' + error);
                return;
            }

            geocodeAddress(destination, function (error, destinationCoordinates) {
                if (error) {
                    alert('Error geocoding destination: ' + error);
                    return;
                }

                var distance = calculateDistanceBetweenPoints(startCoordinates, destinationCoordinates);
                var price = calculatePrice(distance);

                estimatedPrice.textContent = 'Estimated Price: $' + price.toFixed(2);
            });
        });
    }

    function calculateDistanceBetweenPoints(point1, point2) {
        var lat1 = point1[1];
        var lon1 = point1[0];
        var lat2 = point2[1];
        var lon2 = point2[0];

        var R = 6371; // Radius of the Earth in kilometers
        var dLat = deg2rad(lat2 - lat1);
        var dLon = deg2rad(lon2 - lon1);

        var a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);

        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        var distance = R * c; // Distance in kilometers

        return distance;
    }

    function deg2rad(deg) {
        return deg * (Math.PI / 180);
    }

    function calculatePrice(distance) {
        // Replace this with your pricing logic
        return distance * 1.5;
    }
</script>
</body>

</html>
