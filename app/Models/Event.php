<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Event extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    /**
     * @var string[]
     */
    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
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
        'is_active',
        'image',
        'title',
        'slug',
        'content',
        'components',
        'started_at',
        'ended_at',
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
}
