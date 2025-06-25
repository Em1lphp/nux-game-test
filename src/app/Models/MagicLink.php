<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MagicLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'registered_user_id',
        'token',
        'is_active',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(RegisteredUser::class, 'registered_user_id');
    }

    public function luckyResults(): HasMany
    {
        return $this->hasMany(LuckyResult::class);
    }
}
