@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="card narrow">
    <h1>Register</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}">
        @error('name') <p class="field-error">{{ $message }}</p> @enderror

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}">
        @error('email') <p class="field-error">{{ $message }}</p> @enderror

        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        @error('password') <p class="field-error">{{ $message }}</p> @enderror

        <label for="password_confirmation">Confirm password</label>
        <input type="password" id="password_confirmation" name="password_confirmation">

        <button class="btn">Create account</button>
    </form>

    <p class="muted">Already registered? <a href="{{ route('login') }}">Login</a></p>
</div>
@endsection
