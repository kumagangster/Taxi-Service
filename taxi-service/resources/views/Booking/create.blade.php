@extends('layouts.customer')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Booking Request') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('bookings.store') }}" id="addStar" class="form-horizontal poststars" >
                            @csrf

                            <div class="row mb-3">
                                <label for="pickup_location" class="col-md-4 col-form-label text-md-end">{{ __('Pickup Location') }}</label>

                                <div class="col-md-6">
                                    <input id="pickup_location" type="text" class="form-control @error('pickup_location') is-invalid @enderror" name="pickup_location" value="{{ old('pickup_location') }}"  required>
                                    @error('pickup_location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="destination" class="col-md-4 col-form-label text-md-end">{{ __('Destination') }}</label>

                                <div class="col-md-6">
                                    <input id="destination" type="text" class="form-control @error('destination') is-invalid @enderror" name="destination" value="{{ old('destination') }}" required>
                                    @error('destination')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="requested_time" class="col-md-4 col-form-label text-md-end">{{ __('Requested Time') }}</label>

                                <div class="col-md-6">
                                    <input id="requested_time" type="datetime-local" class="form-control @error('requested_time') is-invalid @enderror" name="requested_time" value="{{ old('requested_time') }}" required>

                                    @error('requested_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="distance" name="distance" value="" />
                            </div>
{{--                            <input type="hidden" id="fare" value="">--}}

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit Booking') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div id="map" style="height: 400px; width: 100%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        window.onload = function () {
            L.mapquest.key = 'pTLjsGCZRhX6dgBbeBQIzATJXmxnkhYj';
            var map = L.mapquest.map('map',{
                center: [11.1271, 78.6569],
                layers: L.mapquest.tileLayer('map'),
                zoom: 7
            });

            var newInput=document.createElement('fare');
            newInput.type='hidden';
            newInput.name='newInputName';
            newInput.id='newInput';

            var start = document.getElementById('pickup_location');
            var startValue;

            start.addEventListener('change', function () {
                startValue = start.value;
            });

            var end = document.getElementById('destination');
            var endValue;

            end.addEventListener('change', function () {
                endValue = end.value;
                updateRoute();
            });
            L.mapquest.control().addTo(map);
            L.mapquest.geocodingControl().addTo(map);
            function updateRoute() {
                var distanceinKM;
                var dir=L.mapquest.directions();
                dir.route({
                    start: startValue,
                    end: endValue,
                });
                function directionsCallbacks(err,result){
                    distanceinKM=result.route.distance;
                    // document.getElementById('fare').value=distanceinKM*15;
                    // var x=document.getElementById('fare').value;
                    // console.log(x);
                }
            }
        }
    </script>
@endsection
