<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Translatable\HasTranslations;

class File extends Model
{
    use HasFactory, SoftDeletes, HasTranslations, LogsActivity;

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
        'filename',
        'file',
    ];
    /**
     * @var string[]
     */
    protected $translatable = [
        'filename',
    ];

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'article_files');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['filename', 'created_at']);
    }
}
