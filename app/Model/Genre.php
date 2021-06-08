<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function games()
    {
        return $this->hasMany(Game::class);
    }
}

