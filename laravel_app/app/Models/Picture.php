<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    //
    protected $fillable = [
        'picture',
    ];

    public function contents()
    {
        return $this->hasMany(Content::class, 'pictureId');
    }
}
