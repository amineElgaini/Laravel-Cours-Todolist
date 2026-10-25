@extends('layouts.app')

@section('title', 'New Task')

@section('content')
<div class="card">
    <h1>New task</h1>

    {{-- enctype is needed to upload files --}}
    <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
        @include('tasks._form', ['buttonText' => 'Create task'])
    </form>
</div>
@endsection
