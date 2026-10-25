@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="card narrow">
    <h1>Login</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}">
        @error('email') <p class="field-error">{{ $message }}</p> @enderror

        <label for="password">Password</label>
        <input type="password" id="password" name="password">
        @error('password') <p class="field-error">{{ $message }}</p> @enderror

        <label class="check"><input type="checkbox" name="remember"> Remember me</label>

        <button class="btn">Login</button>
    </form>

    <p class="muted">No account? <a href="{{ route('register') }}">Register here</a></p>
</div>
@endsection
