<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Team
 *
 * @property integer $id
 * @property string $name
 * @property integer $size
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $members
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereSize($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Team whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Team extends Model
{
    protected $fillable = ['name', 'size'];

    public function add ($user)
    {
        $this->guardAgainstTooManyMembers ();

        $method = $user instanceof User ? 'save' : 'saveMany';

        $this->members()->$method($user);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members ()
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return mixed
     */
    public function count ()
    {
        return $this->members()->count();
    }

    /**
     * @throws \Exception
     */
    protected function guardAgainstTooManyMembers ()
    {
        if ($this->count () >= $this->size) {
            throw new \Exception;
        }
    }
}
