<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\GameService;
use App\Services\MagicLinkService;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class GameController extends Controller
{
    public function __construct(
        private readonly GameService $gameService,
        private readonly MagicLinkService $magicLinkService,
    ) {
    }

    public function start(string $token): View|RedirectResponse
    {
        try {
            $magicLink = $this->magicLinkService->getActiveMagicLink($token);
            $result = $this->gameService->process($magicLink);

            return view('game-result', compact('result'));
        } catch (\Throwable $e) {
            Log::error('Failed to start the game', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->route('register.form')->withErrors([
                'message' => 'Something went wrong while starting the game. Please register again.',
            ]);
        }
    }

    public function history(string $token): View|RedirectResponse
    {
        try {
            $magicLink = $this->magicLinkService->getActiveMagicLink($token);
            $history = $this->gameService->getHistory($magicLink);

            return view('game-history', compact('history'));
        } catch (\Throwable $e) {
            Log::error('Failed to load game history', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->route('register.form')->withErrors([
                'message' => 'Something went wrong while loading your game history. Please try again.',
            ]);
        }
    }
}
