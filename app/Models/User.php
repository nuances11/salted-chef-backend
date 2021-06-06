<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasRoles, Notifiable, HasApiTokens;

    protected $appends = [
        'role',
        'role_readable_name',
        'full_name'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'roles',
        'created_at',
        'email_verified_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($pass) {
        $this->attributes['password'] = Hash::make($pass);
    }

    public function getRoleAttribute() {
        return $this->roles->first()->name;
    }

    public function getRoleReadableNameAttribute() {
        return $this->roles->first()->readable_name;
    }

    public function getFullnameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
