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
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

   public function roles () {
       return $this->belongsToMany('App\Role', 'user_role');
   }

   public function departments ()
   {
       return $this->belongsTo(Department::class,'department_id' );
   }

   public function  loans(){
       return $this->hasMany(Loan::class,'user_id');
   }

}
