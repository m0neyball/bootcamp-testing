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

    public function add($user)
    {
        $this->guardAgainstTooManyMember();

        $method =  'saveMany';
        if($user instanceof User)
        {
            $method = 'save';
        }

        $this->members()->$method($user);

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

    public function removeAll()
    {
        return $this->members()
            ->update (['team_id' => null]);
    }

    private function guardAgainstTooManyMember()
    {
        if($this->count() >= $this->size)
        {
            throw new Exception;
        }
    }
}
