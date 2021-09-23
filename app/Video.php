<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    protected  $fillable = [
        'name',
        'description',
        'video',
        'conversion_status',
        'converted_name'
    ];
    public function tag(){
        return $this->hasMany(VideoTag::class);
    }
}
