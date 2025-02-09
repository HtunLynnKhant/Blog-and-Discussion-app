<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleLanguage extends Model
{
    use HasFactory;
    protected $fillable= [
        'article_id',
        'language_id',
    ];
}
