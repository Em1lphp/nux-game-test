<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\UserRegisteredEvent;
use App\Http\Requests\RegisterRequest;
use App\Models\RegisteredUser;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class RegisterController extends Controller
{
    public function showForm(): View
    {
        return view('register');
    }

    public function register(RegisterRequest $request): View
    {
        try {
            $user = RegisteredUser::create($request->validated());

            event(new UserRegisteredEvent($user));

            $token = $user->magicLinks()->latest('id')->first()->token;

            return view('registration-success', compact('token'));
        } catch (\Throwable $e) {
            Log::error('Registration error', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return view('error', [
                'message' => sprintf('Registration error: %s', $e->getMessage()),
            ]);
        }
    }
}
