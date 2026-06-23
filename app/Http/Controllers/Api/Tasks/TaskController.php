<?php

namespace App\Http\Controllers\Api\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tasks\StoreTaskRequest;
use App\Http\Requests\Tasks\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        return TaskResource::collection(
            auth()->user()->tasks()->latest()->get()
        );
    }

    public function store(StoreTaskRequest $request)
    {
        $task = auth()->user()->tasks()->create(
            $request->validated()
        );
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
        return new TaskResource($task);
    }

    public function destroy(Task $task)
    {
        $this->authorizeTask($task);
        $task->delete();
        return response()->noContent();
    }

    private function authorizeTask(Task $task): void
    {
        abort_if(
            $task->user_id !== Auth::id(),
            403,
            'Unauthorized'
        );
    }
}
