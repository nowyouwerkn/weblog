<?php

namespace Nowyouwerkn\WeBlog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'wkblog_posts';
    protected $primaryKey = 'id';
}
