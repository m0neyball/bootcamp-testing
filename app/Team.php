<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Mockery\CountValidator\Exception;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

    public function add ($user)
    {
        $this->auardAgainstTooManyMembers ();
        $method = $user instanceof User ? 'save' : 'saveMany';
        $this->members ()->$method ($user);
    }

    public function remove (User $user)
    {
        $user->leaveTeam ();
    }

    public function restart ()
    {
        /*
        $this->members ()->each (function ($user) {
            $user->leaveTeam ();
        });
        */
        /*
        $this->members()->delete();
        */
        $this->members ()->update (['team_id' => null]);
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
