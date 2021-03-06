<?php
/**
 * Copyright (c) 2019 TrungKenbi
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherWorkUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'other_work_id', 'user_id'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
