<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use Notifiable;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function statuses()
    {
        return $this->hasMany('App\Status');
    }

    public function friendships()
    {
        return $this->hasMany('App\Friendship');
    }

    public function followers()
    {
        return $this->hasMany('App\Friendship', 'follower_id');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function iFollow(User $user)
    {
        return $this->friendships->where('follower_id', $user->id)->count() == 1;
    }

    public function followMe(User $user)
    {
        return $user->friendships->where('user_id', $this->id);
    }
}
