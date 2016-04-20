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

    /**
     * @param $users
     *
     * @throws \Exception
     */
    public function add ($users)
    {
        $this->guardAgainstTooManyMembers($this->extractNewUsersCount($users));

        $method = $users instanceof User ? 'save' : 'saveMany';

        $this->members()->$method($users);
    }

    /**
     * @param User $user
     *
     * @return bool|int
     *
     */
    public function remove (User $user)
    {
        return $user->leaveTeam();
    }

    /**
     * @param $users
     */
    public function removeMany ($users)
    {
        return $this->members ()
                    ->whereIn ('id', $users->pluck ('id'))
                    ->update (['team_id' => null]);
    }

    /**
     * @return int
     */
    public function restart ()
    {
        return $this->members()->update(['team_id' => null]);
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
     * @return int
     */
    public function maximumSize()
    {
        return $this->size;
    }

    /**
     * @param $newUserCount
     *
     * @throws \Exception
     */
    protected function guardAgainstTooManyMembers($newUserCount)
    {
        $newTeamCount = $this->count() + $newUserCount;

        if ($newTeamCount > $this->maximumSize()) {
            throw new \Exception;
        }
    }

    /**
     * @param $users
     *
     * @return int
     */
    protected function extractNewUsersCount($users)
    {
        if ($users instanceof User) {
            return 1;
        }

        return count($users);
    }
}
