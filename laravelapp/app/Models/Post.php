<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // protected $table = 'posts';

    // protected $primaryKey = 'title';

    // protected $timestamps = false;
    // protected $dateTime = 'U';

    protected $fillable = [
        'title', 'excerpt', 'body', 'image', 'is_published', 'min_to_read'
    ];
}
