<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegisteredUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'username',
        'phone_number',
    ];

    public function magicLinks(): HasMany
    {
        return $this->hasMany(MagicLink::class);
    }
}
