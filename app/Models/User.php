<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'username',
    //     'email',
    //     'password',
    // ];

    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //! eleguent accessor
    // syntax is get......Attribute() after and before we add the field name
    // public function getPasswordAttribute($password)
    // {
    //     $this->attributes['password'] = bcrypt($password);
    // }

    //! eleguent mutator
    // syntax is set......Attribute() after and before we add the field name
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = bcrypt($password);
    }


    public function posts()
    {

        // because a single user can have many post in post class
        return $this->hasMany(Post::class);
    }
}
