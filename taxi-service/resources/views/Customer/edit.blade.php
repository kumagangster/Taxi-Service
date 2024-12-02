@extends('layouts.customer')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Customer Update') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('customer.update',['id'=>$customer->id])}}">
                            @csrf
                            @method('put')
                            <div class="row mb-3">
                                <label for="customer_name" class="col-md-4 col-form-label text-md-end">Name:</label>
                                <div class="col-md-6">
                                    <input id="customer_name" type="text"
                                           class="form-control @error('customer_name') is-invalid @enderror"
                                           name="customer_name"
                                           value="{{ $customer->customer_name }}" required>

                                    @error('customer_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="customer_email" class="col-md-4 col-form-label text-md-end">Email:</label>
                                <div class="col-md-6">
                                    <input id="customer_email" type="email"
                                           class="form-control @error('customer_email') is-invalid @enderror"
                                           name="customer_email"
                                           value="{{ $customer->customer_email }}" required>

                                    @error('customer_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="customer_phone" class="col-md-4 col-form-label text-md-end">Phone:</label>
                                <div class="col-md-6">
                                    <input id="customer_phone" type="number"
                                           class="form-control @error('customer_phone') is-invalid @enderror"
                                           name="customer_phone"
                                           value="{{ $customer->customer_phone }}" required>

                                    @error('customer_phone')
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
                                        {{ __('Customer Update') }}
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
