<?php

namespace App;

use Exception;
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


        $this->members()->save($user);
    }

    public function members()
    {
        return $this->hasMany(User::class);
    }

    public function count()
    {
        return $this->members()->count();
    }

    private function guardAgainstTooManyMember()
    {
        if($this->count() >= $this->size)
        {
            throw new Exception;
        }
    }
}
