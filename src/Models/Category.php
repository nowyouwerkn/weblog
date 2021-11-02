<?php

namespace Nowyouwerkn\WeBlog\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'wkblog_categories';
    protected $primaryKey = 'id';
}
