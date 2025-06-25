<?php

declare(strict_types=1);

namespace App\DTO;

readonly class GameWinnerDto
{
    public function __construct(
        public string $winnerStatus,
        public int $amount,
        public float $winAmount,
    ) {
    }
}
