<?php

namespace App\Http\Controllers\Idea;

use App\Models\Idea;
use App\Models\IdeaLike;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IdeaController extends Controller
{
    public function create()
    {
        $ideas = Idea::all();  
        return view('ideas.create', compact('ideas'));
    }
    

    public function store(Request $request)
    {
        if (auth()->check()) {
            
           
            $fieldMap = [
                'تعليم' => 'education',
                'صحة' => 'health',
                'بيئة' => 'environment',
                'تقنية' => 'technology',
                'اجتماعي' => 'social'
            ];
    
            $cityMap = [
                'عمان' => 'amman',
                'الزرقاء' => 'zarqa',
                'إربد' => 'irbid',
                'العقبة' => 'aqaba',
                'البلقاء' => 'balqa',
                'المفرق' => 'mafraq',
                'معان' => 'maan',
                'الكرك' => 'karak',
                'الطفيلة' => 'tafilah',
                'مادبا' => 'madaba',
                'جرش' => 'jerash',
                'عجلون' => 'ajloun'
            ];
    
            
            $request->validate([
                'field' => 'required|string',
                'idea_region' => 'required|string',
                'idea_description' => 'required|string',
                'idea_goals' => 'required|string',
                'idea_duration' => 'required|numeric|min:1',
                'idea_authorities' => 'required|string',
            ], [
                'field.required' => 'يرجى اختيار مجال الفكرة.',
                'idea_region.required' => 'يرجى اختيار المنطقة المقترحة.',
                'idea_description.required' => 'يرجى كتابة وصف الفكرة.',
                'idea_goals.required' => 'يرجى تحديد الأهداف.',
                'idea_duration.required' => 'يرجى إدخال مدة التنفيذ.',
                'idea_duration.numeric' => 'يجب أن تكون المدة رقمًا.',
                'idea_duration.min' => 'أقل مدة هي يوم واحد.',
                'idea_authorities.required' => 'يرجى اختيار الجهة المعنية.',
            ]);
    
            
            $idea = new Idea();
            $idea->user_id = auth()->id();
            $idea->title = 'فكرة جديدة'; 
            $idea->description = $request->input('idea_description'); 
            $idea->field = $fieldMap[$request->input('field')] ?? 'education';
            $idea->city = $cityMap[$request->input('city')] ?? 'amman';
            $idea->idea_goals = $request->input('idea_goals');
            $idea->duration_days = $request->input('idea_duration');
            $idea->idea_duration = $request->input('idea_duration', 0);
            $idea->related_entities = $request->input('idea_authorities');
            $idea->status = 'pending';
    
           
            
        if ($request->hasFile('image')) {
            
            if ($idea->image) {
                Storage::delete('public/'.$idea->image);
            }
            
            
            $imagePath = $request->file('image')->store('ideas', 'public');
            $idea->image = $imagePath;
        }

            
            $idea->save();
    
          
            auth()->user()->notify(new \App\Notifications\IdeaSubmittedNotification());
    
            
            return back()->with([
                'success' => 'تم إرسال فكرتك بنجاح وستتم مراجعتها.',
                'ideas' => Idea::where('status', 'approved')->get()
            ]);
        } else {
            return redirect()->route('login')->with('error', 'من فضلك سجل دخولك أولاً');
        }
    }
    
    

    public function index()
    {
        $ideas = Idea::with('user')->where('status', 'approved')->get();
        return view('ideas.index', compact('ideas'));
    }




    public function like(Request $request, $ideaId)
{
    $user = auth()->user();  

   
    $existingLike = IdeaLike::where('user_id', $user->id)->where('idea_id', $ideaId)->first();

    if ($existingLike) {
       
        $existingLike->delete();
        $idea = Idea::with('likes')->find($ideaId); 
        $likesCount = $idea->likes->count();
        return response()->json(['message' => 'إلغاء الإعجاب', 'likes_count' => $likesCount]);
    } else {
      
        IdeaLike::create([
            'user_id' => $user->id,
            'idea_id' => $ideaId,
        ]);
        $likesCount = IdeaLike::where('idea_id', $ideaId)->count();
        return response()->json(['message' => 'إعجاب تم', 'likes_count' => $likesCount]);
    }
}
}
