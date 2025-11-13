<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $reviews = Review::query()
        //     ->select('id', 'user_id', 'reviewable_id', 'reviewable_type', 'rating', 'content', 'created_at')
        //     ->with('reviewable', 'user:id,first_name')
        //     ->latest('created_at')
        //     ->paginate();
        $reviews = Cache::remember('admin_reviews_page_'.request('page', 1), 60, function () {
            $sub = Review::select(
                'reviewable_type',
                'reviewable_id',
                // 'user_id',
                DB::raw('COUNT(*) as total_reviews'),
                DB::raw('AVG(rating) as avg_rating')
            )
                ->groupBy('reviewable_type', 'reviewable_id');

            return Review::query()
                ->select(
                    'reviews.id',
                    'reviews.user_id',
                    'reviews.reviewable_id',
                    'reviews.reviewable_type',
                    'reviews.rating',
                    'reviews.content',
                    'reviews.created_at',
                    'agg.total_reviews',
                    'agg.avg_rating'
                )
                ->joinSub($sub, 'agg', function ($join) {
                    $join->on('reviews.reviewable_type', '=', 'agg.reviewable_type')
                        ->on('reviews.reviewable_id', '=', 'agg.reviewable_id');
                })
                ->with(['user:id,first_name', 'reviewable:id,title'])
                ->orderByDesc('reviews.created_at')
                ->paginate(15);
        });

        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
