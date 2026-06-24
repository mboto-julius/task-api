<?php

namespace App\Http\Controllers\Api\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Requests\DailyLogs\StoreDailyLogRequest;
use App\Http\Requests\DailyLogs\UpdateDailyLogRequest;
use App\Http\Resources\DailyLogResource;
use App\Models\DailyLog;
use App\Models\Subtask;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class DailyLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Subtask $subtask)
    {
        $this->authorizeTask($subtask->task);
        return DailyLogResource::collection(
            $subtask->dailyLogs()->latest()->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDailyLogRequest $request, Subtask $subtask)
    {
        $this->authorizeTask($subtask->task);
        if ($subtask->is_completed) {
            return response()->json([
                'message' => 'Subtask is completed. Cannot add logs.'
            ], 422);
        }
        $log = DailyLog::create([
            'subtask_id' => $subtask->id,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);
        return new DailyLogResource($log);
    }

    /**
     * Display the specified resource.
     */
    public function show(DailyLog $dailyLog)
    {
        $this->authorizeTask($dailyLog->subtask->task);
        return new DailyLogResource($dailyLog);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDailyLogRequest $request, DailyLog $dailyLog)
    {
        $this->authorizeTask($dailyLog->subtask->task);
        $dailyLog->update([
            'description' => $request->description ?? $dailyLog->description,
            'start_time' => $request->start_time ?? $dailyLog->start_time,
            'end_time' => $request->end_time ?? $dailyLog->end_time,
        ]);
        return new DailyLogResource($dailyLog->fresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DailyLog $dailyLog)
    {
        $this->authorizeTask($dailyLog->subtask->task);
        $dailyLog->delete();
        return response()->json([
            'message' => 'Daily log deleted successfully.'
        ]);
    }

    private function authorizeTask(Task $task): void
    {
        abort_if($task->user_id !== Auth::id(), 403);
    }
}
