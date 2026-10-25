@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
<div class="card">
    <h1>Edit task</h1>

    <form method="POST" action="{{ route('tasks.update', $task) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('tasks._form', ['buttonText' => 'Save changes'])
    </form>
</div>
@endsection
