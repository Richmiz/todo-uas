@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>{{ __('Dashboard Task Management') }}</h4>
                        <a href="{{ route('tasks.create') }}" class="btn btn-primary">Tambah Task Baru</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Alert H-3 -->
                    @if($upcomingTasks->count() > 0)
                    <div class="alert alert-warning">
                        <h5><i class="fas fa-exclamation-triangle"></i> Peringatan H-3!</h5>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
                                        <th>Sisa Hari</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($upcomingTasks as $task)
                                    <tr>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->due_date->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge badge-{{ $task->status == 'pending' ? 'warning' : 'info' }}">
                                                {{ ucfirst($task->status) }}
                                            </span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::now()->diffInDays($task->due_date) }} hari</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    <!-- Task Statistics -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <h3>{{ $pendingTasks->count() }}</h3>
                                    <p>Pending Tasks</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h3>{{ $inProgressTasks->count() }}</h3>
                                    <p>In Progress</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h3>{{ $completedTasks->count() }}</h3>
                                    <p>Completed</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-danger text-white">
                                <div class="card-body">
                                    <h3>{{ $incompleteTasks->count() }}</h3>
                                    <p>Belum Selesai</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tasks by Status -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Tasks Belum Selesai</h5>
                                </div>
                                <div class="card-body">
                                    @if($incompleteTasks->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Judul</th>
                                                    <th>Status</th>
                                                    <th>Deadline</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($incompleteTasks as $task)
                                                <tr>
                                                    <td>{{ $task->title }}</td>
                                                    <td>
                                                        <span class="badge badge-{{ $task->status == 'pending' ? 'warning' : 'info' }}">
                                                            {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $task->due_date ? $task->due_date->format('d/m/Y') : '-' }}</td>
                                                    <td>
                                                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @else
                                    <p class="text-muted">Tidak ada task yang belum selesai.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Tasks Completed</h5>
                                </div>
                                <div class="card-body">
                                    @if($completedTasks->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Judul</th>
                                                    <th>Deadline</th>
                                                    <th>Completed At</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($completedTasks->take(5) as $task)
                                                <tr>
                                                    <td>{{ $task->title }}</td>
                                                    <td>{{ $task->due_date ? $task->due_date->format('d/m/Y') : '-' }}</td>
                                                    <td>{{ $task->updated_at->format('d/m/Y H:i') }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    @if($completedTasks->count() > 5)
                                    <div class="text-center">
                                        <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
                                    </div>
                                    @endif
                                    @else
                                    <p class="text-muted">Belum ada task yang diselesaikan.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
