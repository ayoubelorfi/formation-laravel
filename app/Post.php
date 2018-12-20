<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * @var string
     */
    protected $table = 'post';

    /**
     * @var bool
     */
    public $timestamps = true;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
