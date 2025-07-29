<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $pendingTasks = Task::where('status', 'pending')->get();
        $inProgressTasks = Task::where('status', 'in_progress')->get();
        $completedTasks = Task::where('status', 'completed')->get();
        $incompleteTasks = Task::whereIn('status', ['pending', 'in_progress'])->get();
        

        $upcomingTasks = Task::whereIn('status', ['pending', 'in_progress'])
            ->whereNotNull('due_date')
            ->whereBetween('due_date', [Carbon::now(), Carbon::now()->addDays(3)])
            ->get();
        
        return view('home', compact('pendingTasks', 'inProgressTasks', 'completedTasks', 'incompleteTasks', 'upcomingTasks'));
    }
}
