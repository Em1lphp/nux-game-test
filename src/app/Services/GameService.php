<?php

declare(strict_types=1);

namespace App\Services;

use App\DTO\GameWinnerDto;
use App\Enums\PlayerStatusEnum;
use App\Models\LuckyResult;
use App\Models\MagicLink;
use Illuminate\Database\Eloquent\Collection;

class GameService
{
    public function process(MagicLink $magicLink): GameWinnerDto
    {
        if ($magicLink->is_active === false) {
            throw new \Exception('Magic link is not active');
        }

        $winner = $this->detectWinner();

        $winAmount = $this->calculateWinAmount($winner);

        LuckyResult::create([
            'magic_link_id' => $magicLink->id,
            'random_number' => $winner->amount,
            'result' => $winner->winnerStatus,
            'win_amount' => $winAmount,
        ]);

        return new GameWinnerDto($winner->winnerStatus, $winner->amount, $winAmount);
    }

    public function getHistory(MagicLink $magicLink): Collection
    {
        return $magicLink->luckyResults()
            ->latest()
            ->take(3)
            ->get();
    }

    private function detectWinner(): GameWinnerDto
    {
        $amount = rand(1, 1000);
        $status = $amount % 2 === 0
            ? PlayerStatusEnum::Winner->value
            : PlayerStatusEnum::Loser->value;

        return new GameWinnerDto($status, $amount, 0);
    }

    private function calculateWinAmount(GameWinnerDto $winner): float
    {
        if ($winner->winnerStatus === PlayerStatusEnum::Loser->value) {
            return 0.0;
        }

        $calculatedWinAmount = match (true) {
            $winner->amount > 900 => $winner->amount * 0.7,
            $winner->amount > 600 => $winner->amount * 0.5,
            $winner->amount > 300 => $winner->amount * 0.3,
            default => $winner->amount * 0.1,
        };

        return round($calculatedWinAmount, 2);
    }
}
