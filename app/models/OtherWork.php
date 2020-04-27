<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Traits\FullTextSearchTrait;
use MathParser\StdMathParser;
use MathParser\Interpreting\Evaluator;


class OtherWork extends Model
{
    use FullTextSearchTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'detail',
        'norm',
        'count',
    ];

    protected $dates = ['worked_at', 'created_at', 'updated_at'];

    /**
     * Scope a query to only include popular users.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOwner($query)
    {
        return $query->where('user_id', \Auth::id());
    }

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

    /*
     * Lấy thông tin user của công tác
     * */
    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }


    /**
     * Tính điểm công tác
     *
     * @return float
     */
    public function getTotalPointAttribute()
    {
        return pointCalculation(
            $this->getUser->formula,
            $this->attributes['norm'],
            $this->attributes['count']
        );
    }
}
