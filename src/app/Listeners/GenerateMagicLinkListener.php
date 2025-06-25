<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\UserRegisteredEvent;
use App\Services\MagicLinkService;

readonly class GenerateMagicLinkListener
{
    public function __construct(private MagicLinkService $magicLinkService)
    {
    }

    public function handle(UserRegisteredEvent $event): void
    {
        $this->magicLinkService->createUniqueLink($event->user);
    }
}
