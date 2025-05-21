<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Story;
use App\Models\Chapter;
use App\Models\StoryPurchase;
use App\Models\ChapterPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Constructor - ensure user is authenticated
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Purchase a chapter
     */
    public function purchaseChapter(Request $request)
    {
        $request->validate([
            'chapter_id' => 'required|exists:chapters,id',
        ]);
        
        $user = Auth::user();
        $chapter = Chapter::findOrFail($request->chapter_id);
        
        // Check if chapter is already free
        if ($chapter->is_free) {
            return response()->json([
                'success' => false,
                'message' => 'Chương này đã miễn phí, không cần mua.'
            ], 400);
        }
        
        // Check if user already purchased this chapter
        if ($user->hasPurchasedChapter($chapter->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn đã mua chương này trước đó.'
            ], 400);
        }
        
        // Check if user has enough coins
        if ($user->coins < $chapter->price) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn không đủ xu để mua chương này. Vui lòng nạp thêm.'
            ], 400);
        }
        
        // Process the purchase in a transaction
        DB::beginTransaction();
        try {
            // Deduct coins from user
            $user->coins -= $chapter->price;
            $user->save();
            
            // Create purchase record
            ChapterPurchase::create([
                'user_id' => $user->id,
                'chapter_id' => $chapter->id,
                'amount_paid' => $chapter->price
            ]);
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Mua chương thành công!',
                'newBalance' => $user->coins
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xử lý giao dịch. Vui lòng thử lại.'
            ], 500);
        }
    }
    
    /**
     * Purchase a story combo (all chapters)
     */
    public function purchaseStoryCombo(Request $request)
    {
        $request->validate([
            'story_id' => 'required|exists:stories,id',
        ]);
        
        $user = Auth::user();
        $story = Story::findOrFail($request->story_id);
        
        // Check if story has combo option enabled
        if (!$story->has_combo) {
            return response()->json([
                'success' => false,
                'message' => 'Truyện này không có gói combo.'
            ], 400);
        }
        
        // Check if user already purchased this story combo
        if ($user->hasPurchasedStory($story->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn đã mua combo truyện này trước đó.'
            ], 400);
        }
        
        // Check if user has enough coins
        if ($user->coins < $story->combo_price) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn không đủ xu để mua combo này. Vui lòng nạp thêm.'
            ], 400);
        }
        
        // Process the purchase in a transaction
        DB::beginTransaction();
        try {
            // Deduct coins from user
            $user->coins -= $story->combo_price;
            $user->save();
            
            // Create purchase record
            StoryPurchase::create([
                'user_id' => $user->id,
                'story_id' => $story->id,
                'amount_paid' => $story->combo_price
            ]);
            
            DB::commit();
            
            return response()->json([
                'success' => true,
                'message' => 'Mua combo truyện thành công!',
                'newBalance' => $user->coins
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xử lý giao dịch. Vui lòng thử lại.'
            ], 500);
        }
    }
}
