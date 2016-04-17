<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Article
 *
 * @mixin \Eloquent
 */
class Article extends Model
{
    public function scopeTrending ($query)
    {
        return $query->orderBy('reads', 'desc')->get();
    }
}
