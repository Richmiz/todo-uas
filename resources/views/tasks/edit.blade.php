@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>{{ __('Edit Task') }} - {{ $task->title }}</h4>
                        <div>
                            <a href="{{ route('home') }}" class="btn btn-outline-primary me-2">Dashboard</a>
                            <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">All Tasks</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <h6 class="alert-heading">Please fix the following errors:</h6>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Title *</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $task->title) }}" required placeholder="Enter task title">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Deskipsi</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Enter task description">{{ old('description', $task->description) }}</textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Tanggal Jatuh Tempo</label>
                                <input type="date" name="due_date" class="form-control" value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Status *</label>
                                <select name="status" class="form-control" required>
                                    <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="is_completed" value="1" {{ old('is_completed', $task->is_completed) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold">Tandai sebagai Selesai</label>
                                </div>
                                <small class="text-muted">Ini akan menggantikan status di atas jika dicentang.</small>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Task
                                </button>
                                <a href="{{ route('tasks.index') }}" class="btn btn-secondary ms-2">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                            <a href="{{ route('home') }}" class="btn btn-outline-primary">
                                <i class="fas fa-tachometer-alt"></i> Kembali ke Dashboard
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection