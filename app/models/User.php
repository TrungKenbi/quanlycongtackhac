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
        'name', 'email', 'password', 'formula', 'target_point'
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
     * @return HasMany
     */
    public function otherworks()
    {
        return $this->hasMany('App\Models\OtherWork');
    }

    public function getNameDepartmentsAttribute()
    {
        $departments = [];
        $roles = $this->roles;
        foreach ($roles as $role)
            if ($role->id > 3)
                $departments[] = $role->name;
        return $departments;
    }

    public function getAllWorkingTimeAttribute()
    {
        $hourWork = 0;
        $otherworks = $this->otherworks()->get();
        foreach ($otherworks as $otherwork)
            $hourWork += pointCalculation($this->attributes['formula'], $otherwork->norm, $otherwork->count);
        $hourWork = (int) $hourWork;

        return $hourWork;
    }
}
