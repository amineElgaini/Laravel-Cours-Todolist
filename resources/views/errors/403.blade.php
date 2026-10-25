@extends('layouts.app')

@section('title', 'Forbidden')

@section('content')
<div class="card center">
    <h1>403</h1>
    <p>{{ $exception->getMessage() ?: 'You are not allowed to see this page.' }}</p>
    <a href="{{ url('/') }}" class="btn">Go home</a>
</div>
@endsection
