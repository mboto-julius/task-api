<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'subtask_id',
    'description',
    'start_time',
    'end_time',
])]
class DailyLog extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'start_time' => 'datetime',
            'end_time' => 'datetime',
        ];
    }

    public function subtask(): BelongsTo
    {
        return $this->belongsTo(Subtask::class);
    }
}
