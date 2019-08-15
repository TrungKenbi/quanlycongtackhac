<?php
/**
 * Copyright (c) 2019 TrungKenbi
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherWorkFile extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'other_work_id', 'filename'
    ];
}
