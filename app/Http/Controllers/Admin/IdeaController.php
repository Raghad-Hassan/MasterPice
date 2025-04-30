<?php

namespace App\Http\Controllers\Admin;

use App\Models\Idea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\IdeaRejectedNotification;


class IdeaController extends Controller
{
    
    public function showIdeasForAdmin()
    {
        
        $ideas = Idea::with('user')->where('status', 'pending')->get();
        return view('admin.ideas.index', compact('ideas'));
    }

   
    public function approve(Idea $idea)
    {
        $idea->status = 'approved'; 
        $idea->save(); 

       
        $idea->user->notify(new \App\Notifications\IdeaSubmittedNotification($idea));

        return redirect()->route('admin.ideas.index')->with('success', 'تمت الموافقة على الفكرة.');
        }


    public function reject(Idea $idea)
    {
        $idea->status = 'rejected'; 
        $idea->save(); 

      
        $idea->user->notify(new \App\Notifications\IdeaRejectedNotification($idea));

        return redirect()->route('admin.ideas.index')->with('success', 'تم رفض الفكرة.');
    }

   
    public function delete(Idea $idea)
    {
        $idea->delete(); 

        return redirect()->route('admin.ideas.index')->with('success', 'تم حذف الفكرة.');
    }

    
    public function edit($id)
    {
        $idea = Idea::findOrFail($id);
        return view('admin.ideas.edit', compact('idea'));
    }

   
   public function update(Request $request, $id)
{
    $idea = Idea::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:1000',
        'idea_goals' => 'nullable|string|max:1000',
        'city' => 'nullable|string|max:255',
        'related_entities' => 'nullable|string|max:1000',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $idea->title = $request->input('title');
    $idea->description = $request->input('description');
    $idea->idea_goals = $request->input('idea_goals');
    $idea->city = $request->input('city');
    $idea->related_entities = $request->input('related_entities');

    if (auth()->user()->is_admin) {
        if ($request->hasFile('image')) {
            
            if ($idea->image) {
                Storage::disk('public')->delete($idea->image);
            }
          
            $idea->image = $request->file('image')->store('ideas', 'public');
        }
    }

    $idea->save();

    return redirect()->route('admin.ideas.index')->with('success', 'تم تحديث الفكرة بنجاح!');
}

}
