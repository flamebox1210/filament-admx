<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Partner extends Model
{
    use HasFactory, SoftDeletes, HasTranslations;

    /**
     * @var string[]
     */
    protected $casts = [
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
        'url',
        'category_id',
    ];

    /**
     * @var string[]
     */
    protected $translatable = [
        'title',
        'slug',
    ];


    /**
     * @return HasOne
     */
    public function partner_category(): HasOne
    {
        return $this->hasOne(PartnerCategory::class, 'id', 'category_id');
    }
}
