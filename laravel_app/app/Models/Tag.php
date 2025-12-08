<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = [
        'tags',
    ];

    public function contents()
    {
        return $this->hasMany(Content::class, 'tagsId');
    }
}
