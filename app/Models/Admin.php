<?php

namespace App\Models;

use App\Models\AdminPermission;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use Notifiable;


    protected $guarded = [];


    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    private  $guard= [];

    protected $table='admins';

    public function admin_permissions(){
        return $this->hasMany(AdminPermission::class,'admin_id');
    }
    protected $appends = ['permission_ids'];
    public function getPermissionidsAttribute()
    {
        return $this->admin_permissions()->pluck('permission_id')->toArray();
    }

}
