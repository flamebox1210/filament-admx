<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Article extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    protected $casts = [
        'components' => 'json',
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'is_featured',
        'is_active',
        'image',
        'title',
        'slug',
        'content',
        'components',
        'category_id',
        'tags',
    ];

    /**
     * @var string[]
     */
    protected $translatable = [
        'title',
        'slug',
        'content',
        'components'
    ];

    /**
     * @return BelongsTo
     */
    public function article_categories(): HasOne
    {
        return $this->hasOne(ArticleCategory::class, 'id', 'category_id');
    }


}
