<?php

namespace App\Http\Controllers\Api\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskStatusController extends Controller
{
    public function update(Task $task)
    {
        abort_if($task->user_id !== Auth::id(), 403);

        $task->update([
            'is_completed' => !$task->is_completed
        ]);

        return response()->json([
            'message' => 'Task status updated',
            'is_completed' => $task->is_completed,
        ]);
    }
}
