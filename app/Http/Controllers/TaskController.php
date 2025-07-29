<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::orderBy('due_date', 'asc')->orderBy('created_at', 'desc')->get();
        $pendingCount = Task::where('status', 'pending')->count();
        $inProgressCount = Task::where('status', 'in_progress')->count();
        $completedCount = Task::where('status', 'completed')->count();
        
        return view('tasks.index', compact('tasks', 'pendingCount', 'inProgressCount', 'completedCount'));
    }


    public function create()
    {
        return view('tasks.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,in_progress,completed'
        ]);
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->has('is_completed'),
            'due_date' => $request->due_date,
            'status' => $request->status
        ]);
        return redirect()->route('tasks.index')
            ->with('success', 'Tugas Telah Berhasil ditambahkan');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        $task = Task::find($id);
        return view('tasks.edit', compact('task'));
    }

 
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,in_progress,completed'
        ]);
        $task = Task::find($id);
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->has('is_completed'),
            'due_date' => $request->due_date,
            'status' => $request->status
        ]);
        return redirect()->route('tasks.index')
            ->with('success', 'Tugas Telah Berhasil di Update');
    }


    public function destroy(string $id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('tasks.index')
            ->with('success', 'Tugas Telah Berhasil Menghapus Data');
    }
}