<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'games';

    protected $fillable = [
        'player1','player2',
        'api_text','p1_text','p2_text',
        'p1_completion','p2_completion',
        'p1_speed','p2_speed',
        'p1_time','p2_time',
        'p1_again','p2_again'
    ];
}
