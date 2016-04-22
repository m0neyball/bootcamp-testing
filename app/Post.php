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

    public function likes ()
    {
        return $this->morphMany (Like::create, 'likeable');
    }
}
