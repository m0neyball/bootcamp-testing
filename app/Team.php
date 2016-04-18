<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['name', 'size'];

    public function add ($user)
    {
        $this->members()->save($user);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members ()
    {
        return $this->hasMany(User::class);
    }

    public function count ()
    {
        return $this->members()->count();
    }
}
