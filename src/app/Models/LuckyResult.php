<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuckyResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'magic_link_id',
        'random_number',
        'result',
        'win_amount',
    ];
}
