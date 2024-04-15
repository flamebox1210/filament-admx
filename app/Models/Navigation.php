<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Navigation extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    /**
     * @var string[]
     */
    protected $casts = [
        'components' => 'json',
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * @var string[]
     */
    protected $translatable = [
        'title',
        'slug',
        'components'
    ];
}
