<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index()
    {
        $query = Task::where('user_id', auth()->id());
        if ($search = request('q')) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%");
            });
        }
        $tasks = $query->orderBy('due_date', 'asc')
            ->orderBy('created_at', 'desc')
            ->get();
        $pendingCount = Task::where('user_id', auth()->id())->where('status', 'pending')->count();
        $inProgressCount = Task::where('user_id', auth()->id())->where('status', 'in_progress')->count();
        $completedCount = Task::where('user_id', auth()->id())->where('status', 'completed')->count();
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
            'status' => $request->status,
            'user_id' => auth()->id(),
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
        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
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
        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => $request->has('is_completed'),
            'due_date' => $request->due_date,
            'status' => $request->status
        ];
        if ($request->has('is_completed')) {
            $data['status'] = 'completed';
        }
        $task->update($data);
        return redirect()->route('tasks.index')
            ->with('success', 'Tugas Telah Berhasil di Update');
    }


    public function destroy(string $id)
    {
        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $task->delete();
        return redirect()->route('tasks.index')
            ->with('success', 'Tugas Telah Berhasil Menghapus Data');
    }
}