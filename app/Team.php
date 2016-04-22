<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Mockery\CountValidator\Exception;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

    public function add ($users)
    {
        $this->auardAgainstTooManyMembers ($this->extractNewUsersCount($users));
        $method = $users instanceof User ? 'save' : 'saveMany';
        $this->members ()->$method ($users);
    }

    public function remove ($users = null)
    {
        if ($users instanceof User) {
            return $users->leaveTeam ();
        }
        $this->removeMany ($users);
    }

    public function removeMany ($users)
    {
        /*
        $users->each (function ($user) {
        $user->leaveTeam ();
        });
        */
        $usersId = $users->pluck ('id');

        return $this
            ->members ()
            ->whereIn ('id', $usersId)
            ->update (['team_id' => null]);
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

    public function maximumSize ()
    {
        return $this->size;
    }

    protected function auardAgainstTooManyMembers ($newUsersCount)
    {
        $newTeamCount = $this->count () + $newUsersCount;
        if ($newTeamCount > $this->maximumSize ()) {
            throw new Exception;
        }
    }

    protected function extractNewUsersCount ($users)
    {
        if (($users instanceof User)) {
            return 1;
        }

        return count($users);
    }
}
