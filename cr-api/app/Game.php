<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';

    protected $fillable = [
        'player1','player2',
        'api_text','p1_text','p2_text',
        'p1_again','p2_again',
        'time','tracking', 'end'
    ];
}
