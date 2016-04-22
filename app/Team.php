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

    public function maximumSize()
    {
        return $this->size;
    }

    protected function guardAgainstTooManyMember($users)
    {

        $newTeamCount = $this->count() + $this->extractNewUsersCount($users);

        if($newTeamCount >= $this->maximumSize())
        {
            throw new Exception;
        }
    }

    protected function extractNewUsersCount($users)
    {
        $numUsersAdd = 1;
        if(!($users instanceof User))
        {
            $numUsersAdd = count($users);
        }

        return $numUsersAdd;
    }
}
