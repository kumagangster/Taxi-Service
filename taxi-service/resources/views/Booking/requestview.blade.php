@extends('layouts.driver')
@section('content')
    <div class="container">
        <h2>Available Fares</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Pickup Location</th>
                <th>Destination</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
            </thead>
            @if(count($fares) > 0)
                <tbody>
                @foreach($fares as $fare)
                    <tr>
                        <td>{{ $fare->start_location }}</td>
                        <td>{{ $fare->destination_location }}</td>
                        <td>${{ $fare->amount }}</td>
                        <td>
                            <form action="{{ route('driver.accept',['id'=>auth()->id()])}}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">Accept</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            @endif
        </table>
    </div>
@endsection
