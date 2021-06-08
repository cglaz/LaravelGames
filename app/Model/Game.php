<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    //protected $table = ''
    //protected $primaryKey = '';
    //protected $timestamps = false;
    protected $attributes = [
      'score' => 5
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

}
