<?php
/**
 * Copyright (c) 2019 TrungKenbi
 */

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

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


    /**
     * Get the otherworks for the user.
     */
    public function getOtherWorks()
    {
        return $this->hasMany('App\Models\OtherWork');
    }

    public function getHourWork()
    {
        $hourWork = 0;
        $otherworks = $this->getOtherWorks()->get();
        foreach ($otherworks as $otherwork)
            $hourWork += $otherwork->norm * $otherwork->count * (103 / 320);
        $hourWork = (int) $hourWork;
        return $hourWork;
    }
}
