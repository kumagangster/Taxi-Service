@extends('layouts.driver')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Driver Update') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('driver.update',['id'=>$driver->id])}}">
                            @csrf
                            @method('put')
                            <div class="row mb-3">
                                <label for="driver_name" class="col-md-4 col-form-label text-md-end">Name:</label>
                                <div class="col-md-6">
                                    <input id="driver_name" type="text"
                                           class="form-control @error('driver_name') is-invalid @enderror"
                                           name="driver_name"
                                           value="{{ $driver->driver_name }}" required>

                                    @error('driver_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="driver_email" class="col-md-4 col-form-label text-md-end">Email:</label>
                                <div class="col-md-6">
                                    <input id="driver_email" type="email"
                                           class="form-control @error('customer_email') is-invalid @enderror"
                                           name="driver_email"
                                           value="{{ $driver->driver_email }}" required>

                                    @error('driver_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="driver_phone" class="col-md-4 col-form-label text-md-end">Phone:</label>
                                <div class="col-md-6">
                                    <input id="driver_phone" type="number"
                                           class="form-control @error('driver_phone') is-invalid @enderror"
                                           name="driver_phone"
                                           value="{{ $driver->driver_phone }}" required>

                                    @error('driver_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Driver Update') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
