<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SubtaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'task' => new TaskResource($this->whenLoaded('task')),
            'title' => $this->title,
            'is_completed' => $this->is_completed,
            'completed_at' => $this->completed_at?->format('Y-m-d H:i:s'),
            'logs_count' => $this->whenCounted('dailyLogs'),
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
