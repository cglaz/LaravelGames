<?php

namespace App\Model;

use App\Model\Scope\LastWeekScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Game extends Model
{
    //protected $table = ''
    //protected $primaryKey = '';
    //protected $timestamps = false;

    protected $fillable = [
        'title', 'description', 'score', 'publisher', 'genre_id'
    ];

    protected static function booted()
    {
       //static::addGlobalScope(new LastWeekScope());
    }


    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function scopeBest(Builder $query): Builder
    {
        return $query
            ->with('genre')
            ->where('score', '>=', 9)
            ->orderBy('score', 'desc');
    }

    public function scopeGenre(Builder $query, int $genre_id): Builder
    {
        return $query
            ->where('genre_id', $genre_id);
    }

    public function scopePublisher(Builder $query, string $name): Builder
    {
        return $query->where('publisher', $name);
    }

}
