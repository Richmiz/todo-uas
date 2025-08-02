@extends('layouts.app')

@section('content')
<div class="max-w-9xl mx-auto px-4 py-8">
    <div class="flex flex-col gap-6">
        <div>
            <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <!-- <h4 class="text-xl font-semibold">{{ __('Dashboard Task Management') }}</h4> -->
                <a href="{{ route('tasks.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Add a new Task</a>
            </div>

            <div class="p-6">
                @if (session('status'))
                    <div class="mb-4 p-3 rounded bg-green-100 text-green-800 border border-green-200">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Alert H-3 -->
                @if($upcomingTasks->count() > 0)
                <div class="mb-6 p-4 rounded bg-yellow-100 border-l-4 border-yellow-400">
                    <h5 class="font-semibold text-yellow-800 mb-2 flex items-center gap-2"><i class="fas fa-exclamation-triangle"></i>Warning!</h5>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="bg-yellow-200 text-yellow-900">
                                    <th class="px-3 py-2 text-left">Title</th>
                                    <th class="px-3 py-2 text-left">Deadline</th>
                                    <th class="px-3 py-2 text-left">Status</th>
                                    <th class="px-3 py-2 text-left">Days Left</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($upcomingTasks as $task)
                                <tr class="border-b">
                                    <td class="px-3 py-2">{{ $task->title }}</td>
                                    <td class="px-3 py-2">{{ $task->due_date->format('d/m/Y') }}</td>
                                    <td class="px-3 py-2">
                                        <span class="inline-block px-2 py-1 rounded text-xs font-semibold {{ $task->status == 'pending' ? 'bg-yellow-400 text-yellow-900' : 'bg-blue-200 text-blue-900' }}">
                                            {{ ucfirst($task->status) }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-2">
                                        @php
                                            $now = \Carbon\Carbon::now();
                                            $days = (int) $now->diffInDays($task->due_date, false);
                                            $hours = (int) $now->diffInHours($task->due_date, false);
                                        @endphp
                                        @if($days < 1 && $hours > 0)
                                            {{ $hours }} Hour{{ $hours == 1 ? '' : 's' }}
                                        @else
                                            {{ $days }} Day{{ abs($days) == 1 ? '' : 's' }}
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                <!-- Task Statistics -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-yellow-400 text-white rounded-lg p-6 flex flex-col items-center">
                        <h3 class="text-2xl font-bold">{{ $pendingTasks->count() }}</h3>
                        <p class="mt-2">Pending Tasks</p>
                    </div>
                    <div class="bg-blue-400 text-white rounded-lg p-6 flex flex-col items-center">
                        <h3 class="text-2xl font-bold">{{ $inProgressTasks->count() }}</h3>
                        <p class="mt-2">In Progress</p>
                    </div>
                    <div class="bg-green-500 text-white rounded-lg p-6 flex flex-col items-center">
                        <h3 class="text-2xl font-bold">{{ $completedTasks->count() }}</h3>
                        <p class="mt-2">Completed</p>
                    </div>
                    <div class="bg-red-500 text-white rounded-lg p-6 flex flex-col items-center">
                        <h3 class="text-2xl font-bold">{{ $incompleteTasks->count() }}</h3>
                        <p class="mt-2">Not Completed</p>
                    </div>
                </div>

                <!-- Tasks by Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white border rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h5 class="font-semibold">Not Completed Tasks</h5>
                        </div>
                        <div class="p-6">
                            @if($incompleteTasks->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm">
                                    <thead>
                                        <tr class="bg-gray-100 text-gray-700">
                                            <th class="px-3 py-2 text-left">Title</th>
                                            <th class="px-3 py-2 text-left">Status</th>
                                            <th class="px-3 py-2 text-left">Deadline</th>
                                            <th class="px-3 py-2 text-left">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($incompleteTasks as $task)
                                        <tr class="border-b">
                                            <td class="px-3 py-2">{{ $task->title }}</td>
                                            <td class="px-3 py-2">
                                                <span class="inline-block px-2 py-1 rounded text-xs font-semibold {{ $task->status == 'pending' ? 'bg-yellow-400 text-yellow-900' : 'bg-blue-200 text-blue-900' }}">
                                                    {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                                </span>
                                            </td>
                                            <td class="px-3 py-2">{{ $task->due_date ? $task->due_date->format('d/m/Y') : '-' }}</td>
                                            <td class="px-3 py-2">
                                                <a href="{{ route('tasks.edit', $task->id) }}" class="inline-block px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs">Edit</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @else
                            <p class="text-gray-500">There are no unfinished tasks.</p>
                            @endif
                        </div>
                    </div>
                    <div class="bg-white border rounded-lg shadow">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h5 class="font-semibold">Tasks Completed</h5>
                        </div>
                        <div class="p-6">
                            @if($completedTasks->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full text-sm">
                                    <thead>
                                        <tr class="bg-gray-100 text-gray-700">
                                            <th class="px-3 py-2 text-left">Title</th>
                                            <th class="px-3 py-2 text-left">Deadline</th>
                                            <th class="px-3 py-2 text-left">Completed At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($completedTasks->take(5) as $task)
                                        <tr class="border-b">
                                            <td class="px-3 py-2">{{ $task->title }}</td>
                                            <td class="px-3 py-2">{{ $task->due_date ? $task->due_date->format('d/m/Y') : '-' }}</td>
                                            <td class="px-3 py-2">{{ $task->updated_at->format('d/m/Y H:i') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($completedTasks->count() > 5)
                            <div class="text-center mt-4">
                                <a href="{{ route('tasks.index') }}" class="inline-block px-4 py-2 border border-blue-600 text-blue-600 rounded hover:bg-blue-50 text-xs">View All</a>
                            </div>
                            @endif
                            @else
                            <p class="text-gray-500">There are no completed tasks.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
