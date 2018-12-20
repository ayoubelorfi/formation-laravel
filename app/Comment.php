<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * @var string
     */
    protected $table = 'comment';

    /**
     * @var bool
     */
    public $timestamps = true;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
