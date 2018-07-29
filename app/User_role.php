<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_role extends Model
{
    protected $table = 'user_role';

    protected $fillable = [
        'user_id',
        'role_id'
    ];
    public function users()
    {
        return $this->hasMany('App\User','user_id');
    }
}
