<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Mindscms\Entrust\Traits\EntrustUserWithPermissionsTrait;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, EntrustUserWithPermissionsTrait, SearchableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function receivesBroadcastNotificationsOn()
    {
        return 'App.User.'.$this->id;
    }

    protected $searchable = [
        'columns'   => [
            'users.name'        => 10,
            'users.username'    => 10,
            'users.email'       => 10,
            'users.phone_number' => 10,
            'users.bio'         => 10,
        ],
    ];


    public function isAdmin($query)
    {
        return   $query->where('user_role', 'admin');// this looks for an admin column in your users table
    }

    public function scopeAdmin($query)
    {
        return   $query->where('user_role', 'admin');// this looks for an admin column in your users table
    }


    public function role(): \Illuminate\Database\Eloquent\Relations\HasOneThrough
    {
        return $this->hasOneThrough(Role::class, RelatedRole::class, "user_id", "id", "id", "role_id");
    }

    public function relatedRole(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(RelatedRole::class);
    }


    public function isAdministrator(){
        return $this->is_super_admin;
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function status()
    {
        return $this->status == '1' ? 'Active' : 'Inactive';
    }

    public function userImage()
    {
        return $this->user_image != '' ? asset('assets/users/' .$this->user_image) : asset('assets/users/default.png');
    }


}
