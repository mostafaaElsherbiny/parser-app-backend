<?php

namespace App\Models;

use App\Traits\SortAble;
use App\Traits\FilterAble;
use App\Traits\SearchAble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    use SearchAble;
    use FilterAble;
    use SortAble;

    public $fillable = [
        'title',
        'description',
        'url',
        'urlToImage',
        'publishedAt',
        'content',
        'category',
        'source',
    ];
}
