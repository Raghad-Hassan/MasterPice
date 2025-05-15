<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OpportunityComment;
use Illuminate\Support\Facades\Auth;

class OpportunityCommentController extends Controller
{
    /**
     * Store a newly created comment
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'opportunity_id' => 'required|exists:opportunities,id',
            'comment' => 'required|string|max:1000',
        ]);

        $comment = OpportunityComment::create([
            'user_id' => Auth::id(),
            'opportunity_id' => $validated['opportunity_id'],
            'comment' => $validated['comment'],
        ]);

        return response()->json([
            'message' => 'تم إضافة التعليق بنجاح',
            'comment' => $comment->load('user')
        ], 201);
    }

    /**
     * Get all comments for a specific opportunity
     */
    public function index($opportunityId)
    {
        $comments = OpportunityComment::with('user')
            ->where('opportunity_id', $opportunityId)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($comments);
    }
}