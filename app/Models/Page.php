<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Page extends Model
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
        'is_default',
        'is_active',
        'image',
        'title',
        'slug',
        'content',
        'components',
    ];

    /**
     * @var string[]
     */
    protected $translatable = [
        'title',
        'slug',
        'content',
        'components',
        'meta_title',
        'meta_description'
    ];


}
