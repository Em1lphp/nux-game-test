<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\MagicLink;
use App\Models\RegisteredUser;
use App\Repositories\MagicLinkRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MagicLinkService
{
    private const MAGIC_LINK_EXPIRATION_DAYS = 7;

    public function __construct(private readonly MagicLinkRepository $magicLinkRepository)
    {
    }

    public function createUniqueLink(RegisteredUser $user): Model
    {
        $token = $this->getUniqueToken();

        return $user->magicLinks()->create([
            'token' => $token,
            'is_active' => true,
            'expires_at' => now()->addDays(static::MAGIC_LINK_EXPIRATION_DAYS),
        ]);
    }

    public function deactivateUniqueLink(string $token): void
    {
        $link = $this->getMagicLinkByToken($token);

        $link->update(['is_active' => false]);
    }

    public function getMagicLinkByToken(string $token): Model
    {
        return $this->magicLinkRepository->findByToken($token);
    }

    public function getActiveMagicLink(string $token): MagicLink
    {
        return $this->magicLinkRepository->findActiveMagicLink($token);
    }

    public function deactivateExpiredMagicLinks(): void
    {
        $expiredLinks = $this->magicLinkRepository->getExpiredMagicLinks();
        foreach ($expiredLinks as $link) {
            $link->update(['is_active' => false]);
        }
    }

    private function getUniqueToken(): string
    {
        do {
            $token = Str::uuid()->toString();
        } while ($this->magicLinkRepository->isTokenExists($token));

        return $token;
    }
}
