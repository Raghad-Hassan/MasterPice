<?php

namespace App\Http\Controllers\Organization;

use App\Models\OpportunityComment; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OpportunityCommentController extends Controller
{
   
    public function index()
    {
        $comments = OpportunityComment::all(); 
        return view('organization.comments.index', compact('comments')); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'nullable|string|max:255',
            'opportunity_id' => 'nullable|exists:opportunities,id', 
        ]);

        OpportunityComment::create([
            'comment' => $request->comment,
            'opportunity_id' => $request->opportunity_id,
            'user_id' => auth()->id(), // Ensure the user is authenticated
        ]);

        return response()->noContent();

    }
}
