<?php
namespace App;

use Auth;

trait Likeability
{
    public function like ()
    {
        $like = new Like([
            'user_id' => Auth::id ()
        ]);
        $this->likes ()->save ($like);
    }

    public function unlike ()
    {
        $this
            ->likes ()
            ->where ('user_id', Auth::id ())
            ->delete ();
    }

    public function toggle ()
    {
        if ($this->isLiked ()) {
            $this->unlike ();
        } else {
            $this->like ();
        }
    }

    public function isLiked ()
    {
        return !!$this
            ->likes ()
            ->where ('user_id', Auth::id ())
            ->count ();
    }

    public function getLikesCountAttribute ()
    {
        return $this->likes ()->count ();
    }

    public function likes ()
    {
        return $this->morphMany ('App\Like', 'likeable');
    }
}