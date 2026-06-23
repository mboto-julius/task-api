<?php

namespace App\Http\Controllers\Api\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskStatisticsController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $totalTasks = Task::where('user_id', $userId)->count();
        $completedTasks = Task::where('user_id', $userId)->where('is_completed', 1)->count();
        $pendingTask = Task::where('user_id', $userId)->where('is_completed', 0)->count();
        return response()->json([
            'total_tasks' => $totalTasks,
            'completed_tasks' => $completedTasks,
            'pending_tasks' => $pendingTask,
        ]);
        
    }
}
