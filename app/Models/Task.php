<?php

namespace App\Models;

use App\Enums\TaskEnum;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'title', 'description', 'status', 'due_date'])]

class Task extends Model
{
    protected $attributes = [
        'status' => TaskEnum::PENDING,
    ];

    protected function casts(): array
    {
        return [
            'status' => TaskEnum::class,
            'due_date' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
