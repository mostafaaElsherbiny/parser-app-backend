<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

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