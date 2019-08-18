<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OtherWork extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'detail'
    ];

    /*
     * Lấy tài liệu của công tác
     */
    public function getDocuments()
    {
        return $this->hasMany('App\Models\OtherWorkFile')
            ->where('other_work_files.type', '=', 'document');
    }

    /*
     * Lấy hình ảnh của công tác
     */
    public function getPhotos()
    {
        return $this->hasMany('App\Models\OtherWorkFile')
            ->where('other_work_files.type', '=', 'photo');
    }
}
