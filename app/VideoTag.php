<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoTag extends Model
{
    //
    protected $fillable = [
        'video_id',
        'tag',
    ];


    public function video(){
        return $this->belongsTo(Video::class);
    }
}
