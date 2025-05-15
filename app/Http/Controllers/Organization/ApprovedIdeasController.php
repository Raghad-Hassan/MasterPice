<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Idea;

class ApprovedIdeasController extends Controller
{
    public function index()
    {
        $approvedIdeas = Idea::where('status', 'approved')->get(); 
        return view('organization.approved_ideas.index', compact('approvedIdeas'));
    }


    public function show($id)
{
    $idea = Idea::with('user')->findOrFail($id);
    return view('organization.approved_ideas.show', compact('idea'));
}


}
