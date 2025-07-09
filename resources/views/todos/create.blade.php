@extends('layouts.app')

@section('content')
    <h1>{{ isset($todo) ? 'Edit' : 'Create' }} Todo</h1>

    <form action="{{ isset($todo) ? route('todos.update', $todo) : route('todos.store') }}" method="POST">
        @csrf
        @if (isset($todo))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title"
                value="{{ old('title', $todo->title ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $todo->description ?? '') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Notification Email</label>
            <input type="email" class="form-control" id="email" name="email"
                value="{{ old('email', $todo->email ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="datetime-local" class="form-control" id="due_date" name="due_date"
                value="{{ old('due_date', isset($todo) ? $todo->due_date->format('Y-m-d\TH:i') : '') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('todos.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
