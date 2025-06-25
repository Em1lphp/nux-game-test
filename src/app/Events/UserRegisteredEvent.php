<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\RegisteredUser;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserRegisteredEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(public readonly RegisteredUser $user)
    {
    }
}
