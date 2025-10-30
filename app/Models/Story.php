<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'status',
        'cover',
        'cover_medium',
        'cover_thumbnail',
        'completed',
        'link_aff',
        'combo_price',
        'has_combo'
    ];

    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';

    public function banners()
    {
        return $this->hasMany(Banner::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)
            ->withTimestamps();
    }

    public function purchases()
    {
        return $this->hasMany(StoryPurchase::class);
    }

    public function isPurchasedBy($userId)
    {
        return $this->purchases()->where('user_id', $userId)->exists();
    }

    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    public function scopeDraft($query)
    {
        return $query->where('status', self::STATUS_DRAFT);
    }

    public function scopePopular($query)
    {
        return $query->withCount('chapters')->orderByDesc('chapters_count');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getTotalViewsAttribute()
    {
        if (array_key_exists('total_views', $this->attributes)) {
            return (int) $this->attributes['total_views'];
        }
        if ($this->relationLoaded('chapters')) {
            return (int) $this->chapters->sum('views');
        }
        return 0;
    }

    public function getAverageViewsAttribute()
    {
        $chaptersCount = (int) ($this->chapters_count ?? 0);
        $totalViews = (int) ($this->total_views ?? ($this->relationLoaded('chapters') ? $this->chapters->sum('views') : 0));
        return $chaptersCount > 0 ? $totalViews / $chaptersCount : 0;
    }

    public function latestChapter()
    {
        return $this->hasOne(Chapter::class)
            ->where('status', self::STATUS_PUBLISHED)
            ->latestOfMany('number');
    }
}
