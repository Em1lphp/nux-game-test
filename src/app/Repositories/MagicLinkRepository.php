<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\MagicLink;
use Illuminate\Database\Eloquent\Collection;

class MagicLinkRepository
{
    public function findActiveMagicLink(string $token): MagicLink
    {
        return MagicLink::where('token', $token)
            ->where('is_active', true)
            ->where('expires_at', '>', now())
            ->firstOrFail();
    }

    public function findByToken(string $token): MagicLink
    {
        return MagicLink::where('token', $token)->firstOrFail();
    }

    public function isTokenExists(string $token): bool
    {
        return MagicLink::where('token', $token)->exists();
    }

    public function getExpiredMagicLinks(): Collection
    {
        return MagicLink::where('expires_at', '<', now())->get();
    }
}
