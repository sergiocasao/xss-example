<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'description', 'user_id', 'status_id', 'created_at'
    ];

    public function retweets()
    {
        return $this->hasMany('App\Status', 'status_id');
    }

    public function retweet()
    {
        return $this->belongsTo('App\Status', 'status_id');
    }

    public function user()
    {
       return $this->belongsTo('App\User');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function isLikedBy(User $user){
        return $this->likes()->where('user_id', $user->id)->count() == 1;
    }
}
