@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Edit Task - {{ $task->title }}</h2>
            <div class="flex gap-2">
                <a href="{{ route('home') }}" class="inline-block px-4 py-2 border border-blue-600 text-blue-600 rounded hover:bg-blue-50 transition text-sm">Dashboard</a>
                <a href="{{ route('tasks.index') }}" class="inline-block px-4 py-2 border border-gray-400 text-gray-700 rounded hover:bg-gray-100 transition text-sm">All Tasks</a>
            </div>
        </div>

        @if ($errors->any())
            <div class="mb-4 p-4 rounded bg-red-100 text-red-800 border border-red-200">
                <h6 class="font-semibold mb-2">Please fix the following errors:</h6>
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-gray-700 font-semibold mb-1" for="title">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" value="{{ old('title', $task->title) }}" required placeholder="Enter task title">
            </div>
            <div>
                <label class="block text-gray-700 font-semibold mb-1" for="description">Description</label>
                <textarea name="description" id="description" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" rows="3" placeholder="Enter task description">{{ old('description', $task->description) }}</textarea>
            </div>
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <label class="block text-gray-700 font-semibold mb-1" for="due_date">Due Date</label>
                    <input type="date" name="due_date" id="due_date" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
                </div>
                <div class="flex-1">
                    <label class="block text-gray-700 font-semibold mb-1" for="status">Status <span class="text-red-500">*</span></label>
                    <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none" required>
                        <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="completed" {{ old('status', $task->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
            </div>
            <div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="is_completed" name="is_completed" value="1" class="h-4 w-4 text-green-600 border-gray-300 rounded focus:ring-green-500" {{ old('is_completed', $task->is_completed) ? 'checked' : '' }}>
                    <label for="is_completed" class="text-gray-700 font-semibold">Mark as Done</label>
                </div>
                <small class="text-gray-500">This will override the status above if checked.</small>
            </div>
            <div class="flex flex-col sm:flex-row sm:justify-between gap-4 mt-6">
                <div class="flex gap-2">
                    <button type="submit" class="inline-flex items-center px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition font-semibold">
                        <i class="fas fa-save mr-2"></i> Update Task
                    </button>
                    <a href="{{ route('tasks.index') }}" class="inline-flex items-center px-5 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400 transition font-semibold">
                        <i class="fas fa-times mr-2"></i> Cancel
                    </a>
                </div>
                <a href="{{ route('home') }}" class="inline-flex items-center px-5 py-2 border border-blue-600 text-blue-600 rounded hover:bg-blue-50 transition font-semibold">
                    <i class="fas fa-tachometer-alt mr-2"></i> Return to Dashboard
                </a>
            </div>
        </form>
    </div>
</div>
@endsection