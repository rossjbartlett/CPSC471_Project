@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- First Name -->
                        <div class="form-group row">
                            <label for="fName" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="fName" type="text" class="form-control{{ $errors->has('fName') ? ' is-invalid' : '' }}" name="fName" value="{{ old('fName') }}" required autofocus>

                                @if ($errors->has('fName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Last Name -->
                        <div class="form-group row">
                            <label for="lName" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="lName" type="text" class="form-control{{ $errors->has('lName') ? ' is-invalid' : '' }}" name="lName" value="{{ old('lName') }}" required autofocus>

                                @if ($errors->has('lName'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('lName') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- EMAIL -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- SIN -->
                        <div class="form-group row">
                            <label for="SIN" class="col-md-4 col-form-label text-md-right">{{ __('SIN') }}</label>

                            <div class="col-md-6">
                                <input id="SIN" type="text" class="form-control{{ $errors->has('SIN') ? ' is-invalid' : '' }}" name="SIN" value="{{ old('SIN') }}" required autofocus>

                                @if ($errors->has('SIN'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('SIN') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- DOB -->
                        <div class="form-group row">
                            <label for="DOB" class="col-md-4 col-form-label text-md-right">{{ __('DOB') }}</label>

                            <div class="col-md-6">
                                <!-- TODO use date instead of string? -->
                                <!-- <input id="DOB" type="date" class="form-control{{ $errors->has('DOB') ? ' is-invalid' : '' }}" placeholder="YYYY-MM-DD" name="DOB" value="{{ old('DOB') }}"> -->
                                <input id="DOB" type="text" class="form-control{{ $errors->has('DOB') ? ' is-invalid' : '' }}" name="DOB" value="{{ old('DOB') }}" required autofocus>

                                @if ($errors->has('DOB'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('DOB') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- address -->
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}">

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- phone nums -->
                        <div class="form-group row">
                            <label for="phoneNumbers" class="col-md-4 col-form-label text-md-right">{{ __('Phone Numbers') }}</label>
                            <div class="col-md-6">
                                <input id="phoneNumbers" type="text" class="form-control{{ $errors->has('phoneNumbers') ? ' is-invalid' : '' }}" name="phoneNumbers" placeholder="Seperate with a comma and a space" >

                                @if ($errors->has('phoneNumbers'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phoneNumbers') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        

                        <!-- salary -->
                        <div class="form-group row">
                            <label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('Salary') }}</label>

                            <div class="col-md-6">
                                <input id="salary" type="text" class="form-control{{ $errors->has('salary') ? ' is-invalid' : '' }}" name="salary" value="{{ old('salary') }}">

                                @if ($errors->has('salary'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('salary') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
