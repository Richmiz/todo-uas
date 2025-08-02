@extends('layouts.app')

@section('content')
<div class="max-w-9xl mx-auto px-4 py-8">
    <div class="flex flex-col gap-6">
        <div class="">
            <div class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <h4 class="text-xl font-semibold">{{ __('All Tasks') }}</h4>
                <div class="flex gap-2">
                    <a href="{{ route('home') }}" class="inline-block px-4 py-2 border border-blue-600 text-blue-600 rounded hover:bg-blue-50 transition">Dashboard</a>
                    <a href="{{ route('tasks.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Add New Task</a>
                </div>
            </div>
            <div class="p-6">
                @if (session('success'))
                    <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Task Statistics -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-yellow-400 text-white rounded-lg p-6 flex flex-col items-center">
                        <h3 class="text-2xl font-bold">{{ $pendingCount }}</h3>
                        <p class="mt-2">Pending</p>
                    </div>
                    <div class="bg-blue-400 text-white rounded-lg p-6 flex flex-col items-center">
                        <h3 class="text-2xl font-bold">{{ $inProgressCount }}</h3>
                        <p class="mt-2">In Progress</p>
                    </div>
                    <div class="bg-green-500 text-white rounded-lg p-6 flex flex-col items-center">
                        <h3 class="text-2xl font-bold">{{ $completedCount }}</h3>
                        <p class="mt-2">Completed</p>
                    </div>
                    <div class="bg-indigo-500 text-white rounded-lg p-6 flex flex-col items-center">
                        <h3 class="text-2xl font-bold">{{ $tasks->count() }}</h3>
                        <p class="mt-2">Total Tasks</p>
                    </div>
                </div>

                @if ($tasks->isEmpty())
                    <div class="text-center py-10">
                        <h5 class="text-gray-500 text-lg font-semibold mb-2">No tasks found</h5>
                        <p class="text-gray-400 mb-4">Start by creating your first task!</p>
                        <a href="{{ route('tasks.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Create Your First Task</a>
                    </div>
                @else
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700">
                                <th class="px-3 py-2 text-left">Title</th>
                                <th class="px-3 py-2 text-left">Description</th>
                                <th class="px-3 py-2 text-left">Deadline</th>
                                <th class="px-3 py-2 text-left">Status</th>
                                <th class="px-3 py-2 text-left">Completed</th>
                                <th class="px-3 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                            <tr class="border-b">
                                <td class="px-3 py-2">{{ $task->title }}</td>
                                <td class="px-3 py-2">{{ $task->description }}</td>
                                <td class="px-3 py-2">{{ $task->due_date ? $task->due_date->format('d/m/Y') : '-' }}</td>
                                <td class="px-3 py-2">
                                    <span class="inline-block px-2 py-1 rounded text-xs font-semibold
                                        {{ $task->status == 'pending' ? 'bg-yellow-400 text-yellow-900' : ($task->status == 'in_progress' ? 'bg-blue-200 text-blue-900' : 'bg-green-500 text-white') }}">
                                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                    </span>
                                </td>
                                <td class="px-3 py-2">
                                    @if($task->is_completed)
                                        <span class="inline-block px-2 py-1 rounded text-xs font-semibold bg-green-500 text-white">Yes</span>
                                    @else
                                        <span class="inline-block px-2 py-1 rounded text-xs font-semibold bg-gray-300 text-gray-700">No</span>
                                    @endif
                                </td>
                                <td class="px-3 py-2 flex gap-2">
                                    <a class="inline-flex items-center px-3 py-1 bg-yellow-400 text-white rounded hover:bg-yellow-500 text-xs" href="{{ route('tasks.edit', $task->id) }}">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-xs">
                                            <i class="fas fa-trash mr-1"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection