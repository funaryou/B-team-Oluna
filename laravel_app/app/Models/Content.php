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
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'contents_id', 'tags_id');
    }

    public function picture()
    {
        return $this->hasMany(Picture::class, 'contents_id');
    }
}
