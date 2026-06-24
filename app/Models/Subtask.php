<?php

namespace App\Models;

use App\Models\Task;
use App\Models\DailyLog;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'task_id',
    'title',
    'is_completed',
    'completed_at',
])]
class Subtask extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'is_completed' => 'boolean',
            'completed_at' => 'datetime',
        ];
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public function dailyLogs(): HasMany
    {
        return $this->hasMany(DailyLog::class);
    }
}
