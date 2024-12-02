<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        $initialMarkers = [
            [
                'position' => [
                    'lat' => 28.625485,
                    'lng' => 79.821091
                ],
                'draggable' => true
            ],
            [
                'position' => [
                    'lat' => 28.625293,
                    'lng' => 79.817926
                ],
                'draggable' => false
            ],
            [
                'position' => [
                    'lat' => 28.625182,
                    'lng' => 79.81464
                ],
                'draggable' => true
            ]
        ];
        return view('components.map', compact('initialMarkers'));
    }
    public function showMap()
    {
        return view('components.map2');
    }
    public function calculateDistance(Request $request){
        $selectedLocation = json_decode($request->input('selectedLocation'), true);
        $destinationLat = $request->input('destinationLat');
        $destinationLng = $request->input('destinationLng');

        // Use a library or method to calculate distance
        $distance = $this->calculateDistanceBetweenPoints($selectedLocation['lat'], $selectedLocation['lng'], $destinationLat, $destinationLng);

        return response()->json(['distance' => $distance]);
    }
    private function calculateDistanceBetweenPoints($lat1, $lng1, $lat2, $lng2)
    {
        $radius = 6371;
        $dlat = deg2rad($lat2 - $lat1);
        $dlng = deg2rad($lng2 - $lng1);
        $a = sin($dlat / 2) * sin($dlat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dlng / 2) * sin($dlng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $radius * $c;

        return $distance;
    }
}
