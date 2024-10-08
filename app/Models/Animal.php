<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Animal extends Model
{
    use HasFactory;
    protected $fillable = [
        'type_id',
        'name',
        'birthday',
        'area',
        'fix',
        'description',
        'personality',
    ];

    public function type() 
    {
        return $this->belongsTo(Type::class);
    }

    public function getAgeAttribute() 
    {
        $diff = Carbon::now()->diff($this->birthday);
        return "{$diff->y}歲{$diff->m}月";
    }

    /**
    * 取得動物的刊登人
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
    * 多對多關聯animal與user
    */
    public function like()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
}
