<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Ride;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BookingController extends Controller
{
public function __construct()
{
$this->middleware('auth:customer');
}

public function index()
{
return view('Booking.create');
}

public function store(Request $request)
{

$validatedData = $request->validate([
'pickup_location' => 'required|string',
'destination' => 'required|string',
'requested_time' => 'required|date_format:Y-m-d\TH:i',
]);
$startLocation = $this->geocodeLocation($request->pickup_location);
$destinationLocation = $this->geocodeLocation($request->destination);
$booking = new Ride();
$booking->start_location = $request->pickup_location;
$booking->start_latitude = $startLocation['lat'];
$booking->start_longitude = $startLocation['lng'];
$booking->destination_location = $request->destination;
$booking->destination_latitude = $destinationLocation['lat'];
$booking->destination_longitude = $destinationLocation['lng'];
$booking->requested_time = $request->requested_time;
$booking->status ='pending';
//$booking->fare=$request->fare;
$booking->customer_id=auth()->id();
$booking->save();
return response()->json(['message' => 'Booking created successfully', 'booking' => $booking], 201);
}
    private function geocodeLocation($location)
    {
        $apiKey = '<YOUR API KEY>'; // Replace with your MapQuest API key

        $response = Http::get("https://www.mapquestapi.com/geocoding/v1/address", [
            'key' => $apiKey,
            'location' => $location,
        ]);

        $data = $response->json();

        if (isset($data['results'][0]['locations'][0])) {
            $location = $data['results'][0]['locations'][0]['latLng'];
            return ['lat' => $location['lat'], 'lng' => $location['lng']];
        }

        return null;
    }
}
