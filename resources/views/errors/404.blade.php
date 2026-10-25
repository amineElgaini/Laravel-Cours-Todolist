@extends('layouts.app')

@section('title', 'Not found')

@section('content')
<div class="card center">
    <h1>404</h1>
    <p>Sorry, this page does not exist.</p>
    <a href="{{ url('/') }}" class="btn">Go home</a>
</div>
@endsection
