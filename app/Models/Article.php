<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable= [
        'user_id',
        'category_id',
        'slug',
        'title',
        'image',
        'description',
    ];
    public function language(){
        return $this->belongsToMany(Language::class, 'article_languages');
    }

    public function like()
    {
        return $this->hasMany(ArticleLike::class);
    }

    public function comment()
    {
        return $this->hasMany(ArticleComment::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
