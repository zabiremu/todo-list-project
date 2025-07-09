@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Todo List</h1>
        <a href="{{ route('todos.create') }}" class="btn btn-primary">Create Todo</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Email</th>
                <th>Due Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($todos as $todo)
                <tr>
                    <td>{{ $todo->title }}</td>
                    <td>{{ Str::limit($todo->description, 50) }}</td>
                    <td>{{ $todo->email }}</td>
                    <td>{{ $todo->due_date->format('Y-m-d H:i') }}</td>
                    <td>
                        @if ($todo->email_sent)
                            <span class="badge bg-success">Notified</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('todos.show', $todo) }}" class="btn btn-sm btn-info">View</a>
                        <a href="{{ route('todos.edit', $todo) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
