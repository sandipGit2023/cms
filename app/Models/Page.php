<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'slug',
        'title',
        'path'
    ];

    protected $appends = ['full_path'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($page) {
            if ($page->parent_id) {
                $parent = Page::find($page->parent_id);
                $page->path = $parent->path . '/' . $page->slug;
            } else {
                $page->path = '/' . $page->slug;
            }
        });
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Page::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Page::class, 'parent_id');
    }

    public function getFullPathAttribute(): string
    {
        return $this->path;
    }

    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id');
    }

    public function getAllChildren()
    {
        return $this->children()->with('children');
    }
}
