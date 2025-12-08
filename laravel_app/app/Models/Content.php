<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    //
    protected $fillable = [
        'likes',
        'title',
        'text',
        'thumbnail',
        'tagsId',
        'pictureId',
    ];

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tagsId');
    }

    public function picture()
    {
        return $this->belongsTo(Picture::class, 'pictureId');
    }
}
