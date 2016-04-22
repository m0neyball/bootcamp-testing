<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Post extends Model
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
            ->likes()
            ->where('user_id', Auth::id())
            ->delete();
    }

    public function isLiked ()
    {
        return !!$this
            ->likes ()
            ->where ('user_id', Auth::id())
            ->count ();
    }

    public function likes ()
    {
        return $this->morphMany ('App\Like', 'likeable');
    }
}
