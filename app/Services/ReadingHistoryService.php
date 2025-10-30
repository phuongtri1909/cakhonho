<?php

namespace App\Services;

use App\Models\Story;
use App\Models\Chapter;
use App\Models\UserReading;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class ReadingHistoryService
{
    /**
     * Save reading progress for user
     */
    public function saveReadingProgress(Story $story, Chapter $chapter, $progressPercent = 0)
    {
        if (Auth::check()) {
            return $this->saveUserReadingProgress(Auth::id(), $story->id, $chapter->id, $progressPercent);
        } else {
            return $this->saveSessionReadingProgress($story->id, $chapter->id, $progressPercent);
        }
    }
    
    /**
     * Save reading progress to database for logged in user
     */
    private function saveUserReadingProgress($userId, $storyId, $chapterId, $progressPercent)
    {
        return UserReading::updateOrCreate(
            [
                'user_id' => $userId,
                'story_id' => $storyId
            ],
            [
                'chapter_id' => $chapterId,
                'progress_percent' => $progressPercent,
                'updated_at' => now()
            ]
        );
    }
    
    /**
     * Save reading progress to session for logged out user
     */
    private function saveSessionReadingProgress($storyId, $chapterId, $progressPercent)
    {
        $deviceKey = $this->getOrCreateDeviceKey();
        
        return UserReading::updateOrCreate(
            [
                'session_id' => $deviceKey,
                'story_id' => $storyId,
                'user_id' => null
            ],
            [
                'chapter_id' => $chapterId,
                'progress_percent' => $progressPercent,
                'updated_at' => now()
            ]
        );
    }
    
    /**
     * Get or create device key for user
     * Key is stored in cookie and stable even when logged in/out
     */
    public function getOrCreateDeviceKey()
    {
        $cookieName = 'reader_device_key';
        
        if (!Cookie::has($cookieName) && !request()->cookie($cookieName)) {
            $deviceKey = 'device_' . Str::uuid()->toString();
            
            Cookie::queue($cookieName, $deviceKey, 525600);
            
            Session::put($cookieName, $deviceKey);
            
            return $deviceKey;
        }
        
        $deviceKey = request()->cookie($cookieName) ?? Session::get($cookieName);
        
        Session::put($cookieName, $deviceKey);
        
        return $deviceKey;
    }
    
    /**
     * Get list of 5 recent readings
     */
    public function getRecentReadings($limit = 5)
    {
        if (Auth::check()) {
            return $this->getUserRecentReadings(Auth::id(), $limit);
        } else {
            return $this->getSessionRecentReadings($limit);
        }
    }
    
    /**
        * Get recent readings for logged in user
     */
    private function getUserRecentReadings($userId, $limit)
    {
        return UserReading::with(['story', 'chapter'])
            ->where('user_id', $userId)
            ->orderByDesc('updated_at')
            ->take($limit)
            ->get();
    }
    
    /**
     * Get recent readings from session
     */
    private function getSessionRecentReadings($limit)
    {
        $deviceKey = $this->getOrCreateDeviceKey();
        
        return UserReading::with(['story', 'chapter'])
            ->where('session_id', $deviceKey)
            ->whereNull('user_id')
            ->orderByDesc('updated_at')
            ->take($limit)
            ->get();
    }
    
    /**
     * Migrate reading data from session to user when logging in
     */
    public function migrateSessionReadingsToUser($userId)
    {
        $deviceKey = $this->getOrCreateDeviceKey();
        
        $sessionReadings = UserReading::where('session_id', $deviceKey)
            ->whereNull('user_id')
            ->get();
        
        foreach ($sessionReadings as $reading) {
            $userReading = UserReading::where('user_id', $userId)
                ->where('story_id', $reading->story_id)
                ->first();
                
            if (!$userReading || $reading->updated_at > $userReading->updated_at) {
                UserReading::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'story_id' => $reading->story_id
                    ],
                    [
                        'chapter_id' => $reading->chapter_id,
                        'progress_percent' => $reading->progress_percent,
                        'updated_at' => $reading->updated_at
                    ]
                );
            }
            
            $reading->delete();
        }
    }
    
    /**
     * Copy user reading data to session when logging out
     */
    public function copyUserReadingsToSession($userId)
    {
        $deviceKey = $this->getOrCreateDeviceKey();
        
        $userReadings = UserReading::where('user_id', $userId)
            ->orderByDesc('updated_at')
            ->take(10)
            ->get();
        
        UserReading::where('session_id', $deviceKey)
            ->whereNull('user_id')
            ->delete();
        
        foreach ($userReadings as $reading) {
            UserReading::create([
                'session_id' => $deviceKey,
                'user_id' => null,
                'story_id' => $reading->story_id,
                'chapter_id' => $reading->chapter_id,
                'progress_percent' => $reading->progress_percent,
                'updated_at' => $reading->updated_at,
                'created_at' => now(),
            ]);
        }
    }
    
    /**
     * Delete old session readings
     * Should be run periodically to clean up DB
     */
    public function cleanupOldSessionReadings($days = 30)
    {
        $cutoffDate = now()->subDays($days);
        
        return UserReading::whereNotNull('session_id')
            ->whereNull('user_id')
            ->where('updated_at', '<', $cutoffDate)
            ->delete();
    }
}