@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>{{ __('All Tasks') }}</h4>
                        <div>
                            <a href="{{ route('home') }}" class="btn btn-outline-primary me-2">Dashboard</a>
                            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Add New Task</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Task Statistics -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $pendingCount }}</h3>
                                    <p class="mb-0">Pending</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $inProgressCount }}</h3>
                                    <p class="mb-0">In Progress</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $completedCount }}</h3>
                                    <p class="mb-0">Completed</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body text-center">
                                    <h3>{{ $tasks->count() }}</h3>
                                    <p class="mb-0">Total Tasks</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($tasks->isEmpty())
                        <div class="text-center py-5">
                            <h5 class="text-muted">No tasks found</h5>
                            <p class="text-muted">Start by creating your first task!</p>
                            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Create Your First Task</a>
                        </div>
                    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Completed</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->due_date ? $task->due_date->format('d/m/Y') : '-' }}</td>
                        <td>
                            <span class="badge badge-{{ $task->status == 'pending' ? 'warning' : ($task->status == 'in_progress' ? 'info' : 'success') }}">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </td>
                        <td>
                            @if($task->is_completed)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-secondary">No</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-sm btn-warning me-1" href="{{ route('tasks.edit', $task->id) }}">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection