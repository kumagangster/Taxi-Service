@extends('layouts.driver')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Driver Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('driver.register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="driver_name" class="col-md-4 col-form-label text-md-end">{{ __('Driver Name') }}</label>

                                <div class="col-md-6">
                                    <input id="driver_name" type="text" class="form-control @error('driver_name') is-invalid @enderror" name="driver_name" value="{{ old('driver_name') }}" required autocomplete="driver_name" autofocus>

                                    @error('driver_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="driver_email" class="col-md-4 col-form-label text-md-end">{{ __('Driver Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="driver_email" type="email" class="form-control @error('driver_email') is-invalid @enderror" name="driver_email" value="{{ old('customer_email') }}" required autocomplete="email">

                                    @error('driver_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="driver_phone" class="col-md-4 col-form-label text-md-end">{{ __('Driver Phone Number') }}</label>

                                <div class="col-md-6">
                                    <input id="driver_phone" type="number" class="form-control @error('driver_phone') is-invalid @enderror" name="driver_phone" value="{{ old('driver_phone') }}" required autocomplete="tel">

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

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Driver Register') }}
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
