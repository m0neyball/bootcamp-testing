<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Like
 *
 * @property integer $user_id
 * @property integer $likeable_id
 * @property string $likeable_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Like whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Like whereLikeableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Like whereLikeableType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Like whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Like whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Like extends Model
{
    protected $fillable = ['user_id'];
}
