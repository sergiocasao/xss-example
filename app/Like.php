<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id', 'status_id', 'created_at'
    ];

    public function user()
    {
       return $this->belongsTo('App\User');
    }

    public function status()
    {
       return $this->belongsTo('App\Status');
    }
}
