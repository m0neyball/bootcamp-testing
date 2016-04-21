<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * like
     */
    public function like()
    {
        $like = new Like(['user_id' => Auth::id()]);

        $this->likes()->save($like);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function unlike()
    {
        $this->likes()->where('user_id', Auth::id())->delete();
    }

    public function isLiked()
    {
        return !! $this->likes()
                    ->where('user_id', Auth::id())
                    ->count();
    }
}
