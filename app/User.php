<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

use App\Comment;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $collection = 'employees';
    protected $fillable = [
        'id', 'username', 'lastname', 'firstname', 'email', 'phone', 'profile_img', 'role', 'password', 'is_active', 'is_deleted', 'created_at', 'updated_at'
    ];

    public function comments() {
        return $this->belongsToMany('App\Comment');
    }

    public function events() {
        return $this->belongsToMany('App\Event');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}