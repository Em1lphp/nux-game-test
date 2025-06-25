<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\MagicLinkService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DeactivateLinkCommand extends Command
{
    public function __construct(private readonly MagicLinkService $magicLinkService)
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:deactivate-link-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deactivate expired links';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        try {
            $this->magicLinkService->deactivateExpiredMagicLinks();
            Log::info('Expired magic links deactivated.');
        } catch (\Throwable $throwable) {
            Log::error($throwable->getMessage());
        }
    }
}
