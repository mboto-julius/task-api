<?php

namespace App\Http\Controllers\Api\Tasks;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Http\Requests\Subtasks\StoreSubtaskRequest;
use App\Http\Requests\Subtasks\UpdateSubtaskRequest;
use App\Http\Resources\SubtaskResource;
use App\Models\Subtask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubtaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Task $task)
    {
        $this->authorizeTask($task);
        $subtasks = $task->subtasks()
            ->withCount('dailyLogs')
            ->latest()
            ->get();
        return SubtaskResource::collection($subtasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubtaskRequest $request, Task $task)
    {
        $this->authorizeTask($task);
        $subtask = Subtask::create([
            'task_id' => $task->id,
            'title' => $request->title,
        ]);
        return new SubtaskResource($subtask);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subtask $subtask)
    {
        $this->authorizeTask($subtask->task);
        return new SubtaskResource($subtask);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubtaskRequest $request, Subtask $subtask)
    {
        $this->authorizeTask($subtask->task);
        $subtask->update([
            'title' => $request->title,
        ]);
        return new SubtaskResource($subtask->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subtask $subtask)
    {
        $this->authorizeTask($subtask->task);
        if ($subtask->dailyLogs()->exists()) {
            return response()->json([
                'message' => 'Cannot delete subtask with logs.'
            ], 422);
        }
        $subtask->delete();
        return response()->json([
            'message' => 'Subtask deleted successfully.'
        ]);
    }

    private function authorizeTask(Task $task): void
    {
        abort_if($task->user_id !== Auth::id(), 403);
    }
}
