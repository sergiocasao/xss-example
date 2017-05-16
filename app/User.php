<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

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
}
