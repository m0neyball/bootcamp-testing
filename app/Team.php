<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Mockery\CountValidator\Exception;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

    public function add (User $user)
    {
        $this->auardAgainstTooManyMembers ();
        $this->members ()->save ($user);
    }

    public function members ()
    {
        return $this->hasMany (User::class);
    }

    public function count ()
    {
        return $this->members ()->count ();
    }

    protected function auardAgainstTooManyMembers ()
    {
        if ($this->count () >= $this->size) {
            throw new Exception;
        }
    }
}
