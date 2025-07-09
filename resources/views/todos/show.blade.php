@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>{{ $todo->title }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $todo->description }}</p>
            <p><strong>Email:</strong> {{ $todo->email }}</p>
            <p><strong>Due Date:</strong> {{ $todo->due_date->format('Y-m-d H:i') }}</p>
            <p><strong>Status:</strong>
                @if ($todo->email_sent)
                    <span class="badge bg-success">Notification Sent</span>
                @else
                    <span class="badge bg-warning">Notification Pending</span>
                @endif
            </p>

            <h4 class="mt-4">Email Logs</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sent At</th>
                        <th>Recipient</th>
                        <th>Subject</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($todo->emailLogs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $log->recipient }}</td>
                            <td>{{ $log->subject }}</td>
                            <td>
                                @if ($log->sent)
                                    <span class="badge bg-success">Success</span>
                                @else
                                    <span class="badge bg-danger">Failed</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No email logs found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="{{ route('todos.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection
