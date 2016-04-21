<?php

namespace App;

use Exception;
use Faker\Test\Provider\UserAgentTest;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable =[
        'name',
        'size'
    ];

    public function add($users)
    {
//        $this->guardAgainstTooManyMember($users);
        $this->guardAgainstTooManyMember();


        $method =  'saveMany';
        if($users instanceof User)
        {
            $method = 'save';
        }

        $this->members()->$method($users);

    }

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function count()
    {
        return $this->members()->count();
    }

    public function remove($user)
    {
        return $this->members()
            ->where('id', $user->id)
            ->update (['team_id' => null]);
    }

    public function removeMany($users)
    {
        return $this->members()
        ->whereIn('id', $users->pluck('id'))
        ->update (['team_id' => null]);
    }

    public function restart()
    {
        return $this->members()
            ->update (['team_id' => null]);
    }

    private function guardAgainstTooManyMember($users)
    {
        $numUsersAdd = ($users instanceof User)?1:$users->count();

        $newTeamCount = $this->count() + $numUsersAdd;

        if($newTeamCount >= $this->size)
        {
            throw new Exception;
        }
    }
}
