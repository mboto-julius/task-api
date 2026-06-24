<?php

namespace App\Http\Resources;

use App\Http\Resources\TaskResource;
use App\Http\Resources\SubtaskResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'task' => new TaskResource($this->subtask->task),
            'subtask' => new SubtaskResource($this->subtask),
            'description' => $this->description,
            'start_time' => $this->start_time?->format('Y-m-d H:i:s'),
            'end_time' => $this->end_time?->format('Y-m-d H:i:s'),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
