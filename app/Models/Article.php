<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'components' => 'json',
        'tags' => 'json',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'is_featured',
        'is_active',
        'title',
        'slug',
        'image',
        'components',
        'category_id',
        'tags',
    ];

    /**
     * @return BelongsTo
     */
    public function article_categories(): HasOne
    {
        return $this->hasOne(ArticleCategory::class, 'id', 'category_id');
    }


}
