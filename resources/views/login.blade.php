<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h4>Log In</h4>
                    </div>

                    <div class="card-body">
                        <!-- Display Validation Errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Login Form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary">Log In</button>
                            </div>

                            <div class="form-group text-center">
                                <a href="{{ route('password.request') }}">Forgot your password?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection