<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\MagicLinkService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class MagicLinkController extends Controller
{
    public function __construct(private readonly MagicLinkService $magicLinkService)
    {
    }

    public function show(string $token): View
    {
        $link = $this->magicLinkService->getMagicLinkByToken($token);

        return view('magic-link', compact('link'));
    }

    public function generateUniqueUrl(string $token): RedirectResponse|View
    {
        try {
            $link = $this->magicLinkService->getMagicLinkByToken($token);

            $user = $link->user;
            $newLink = $this->magicLinkService->createUniqueLink($user);

            return redirect()->route('magic.link', ['token' => $newLink->token]);
        } catch (\Throwable $e) {
            Log::error('Failed to generate new magic link', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return view('error', [
                'message' => 'An error occurred while generating a new link. Please try again later.',
            ]);
        }
    }

    public function deactivateUniqueLink(string $token): RedirectResponse
    {
        try {
            $this->magicLinkService->deactivateUniqueLink($token);

            return redirect()->route('register.form');
        } catch (\Throwable $e) {
            Log::error('Failed to deactivate magic link', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()->back()->withErrors([
                'message' => 'An error occurred while deactivating the link. Please try again.',
            ]);
        }
    }
}
