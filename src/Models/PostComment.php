<?php

namespace Nowyouwerkn\WeBlog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;

    protected $table = 'wkblog_post_comments';
    protected $primaryKey = 'id';
}
