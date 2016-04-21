<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 2016/4/21
 * Time: 下午4:20
 */

namespace App;


trait Likeability
{
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

    public function toggle()
    {
        if($this->isLiked())
        {
            return $this->unlike();
        }

        return $this->like();
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }
}