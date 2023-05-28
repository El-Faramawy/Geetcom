<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $appends = ['name'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

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
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }

    protected $guarded = [];

    public function getImageAttribute(){
        return  get_file($this->attributes['image']);
    }

    public function orders(){
        return $this->hasMany('App\Models\Order','user_id');
    }
    public function chat_messages(){
        return $this->hasMany(Chat::class,'user_id');
    }
    public function unread_messages(){
        return $this->hasMany(Chat::class,'user_id')->where(['is_read'=>0,'message_from'=>'user']);
    }

//    public function last_message(){
//        return $this->hasMany(Chat::class,'user_id')->where(['message_from'=>'user'])->latest()->first();
//    }

    public function getNameAttribute(){
        return $this->f_name.' '.$this->l_name;
    }

}
