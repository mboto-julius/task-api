<?php

namespace App\Http\Controllers\Api\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\StoreTaskRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', Auth::id())
                ->latest()
                ->get();
        return TaskResource::collection($tasks);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);
        return new TaskResource($task);
    }

    public function show(Task $task)
    {
        $this->authorizeTask($task);
        return new TaskResource($task);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorizeTask($task);
        $task->update($request->validated());
        return new TaskResource($task->fresh());
    }

    public function destroy(Task $task)
    {
        $this->authorizeTask($task);
        if ($task->subtasks()->exists()) {
            return response()->json([
                'message' => 'Task cannot be deleted because it has subtasks.'
            ], 422);
        }
        $task->delete();
        return response()->json([
            'message' => 'Task deleted successfully.'
        ]);
    }

    protected function authorizeTask(Task $task): void
    {
        abort_if(
            $task->user_id !== Auth::id(),
            403,
            'Unauthorized.'
        );
    }
}
