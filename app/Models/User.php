<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Chapter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'role',
        'active',
        'key_active',
        'key_reset_password',
        'reset_password_at',
        'ban_login',
        'ban_comment',
        'ban_rate',
        'ban_read',
        'ip_address',
        'rating',
        'recently_read',
        'coins'
    ];

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }

    public function chapterPurchases()
    {
        return $this->hasMany(ChapterPurchase::class);
    }

    public function storyPurchases()
    {
        return $this->hasMany(StoryPurchase::class);
    }
    
    /**
     * Check if user has purchased a specific chapter
     */
    public function hasPurchasedChapter($chapterId)
    {
        $chapter = Chapter::find($chapterId);
        
        if (!$chapter) {
            return false;
        }
        
        if ($chapter->is_free) {
            return true;
        }
        
        // Check individual chapter purchase
        if ($this->chapterPurchases()->where('chapter_id', $chapterId)->exists()) {
            return true;
        }
        
        // Check if purchased as part of a story combo
        return $this->storyPurchases()->where('story_id', $chapter->story_id)->exists();
    }
    
    /**
     * Check if user has purchased a specific story combo
     */
    public function hasPurchasedStory($storyId)
    {
        return $this->storyPurchases()->where('story_id', $storyId)->exists();
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function isBanLogin(): bool
    {
        return $this->ban_login;
    }

    public function isBanComment(): bool
    {
        return $this->ban_comment;
    }

    public function isBanRate(): bool
    {
        return $this->ban_rate;
    }

    public function isBanRead(): bool
    {
        return $this->ban_read;
    }


    public function banned_ips()
    {
        return $this->hasMany(Banned_ip::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'recently_read' => 'array'
    ];
}
