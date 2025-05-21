<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OpportunityComment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = OpportunityComment::with(['user', 'opportunity'])->latest()->get();
        return view('organization.comments.index', compact('comments'));
    }
}
