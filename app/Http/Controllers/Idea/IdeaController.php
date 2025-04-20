<?php

namespace App\Http\Controllers\Idea;

use App\Models\Idea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    public function create()
    {
        $ideas = Idea::where('status', 'approved')->get();
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
                'field' => 'required',
                'idea_region' => 'required',
                'idea_description' => 'required|string',
                'idea_goals' => 'required|string',
                'idea_duration' => 'required|numeric|min:1',
                'idea_authorities' => 'required',
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
            $idea->idea_region = $request->input('idea_region');
            $idea->idea_description = $request->input('idea_description');
            $idea->title = 'عنوان افتراضي';
            $idea->field = $fieldMap[$request->input('field')] ?? 'education';
            $idea->city = $cityMap[$request->input('idea_region')] ?? 'amman';
            $idea->description = $request->input('idea_description');
            $idea->idea_goals = $request->input('idea_goals');
            $idea->duration_days = 0;
            $idea->related_entities = $request->input('idea_authorities');
            $idea->idea_duration = $request->input('idea_duration');
            $idea->idea_authorities = $request->input('idea_authorities');
            $idea->status = 'pending';

            if ($request->hasFile('image')) {
                $idea->image = $request->file('image')->store('ideas', 'public');
            }

            $idea->save();

            auth()->user()->notify(new \App\Notifications\IdeaSubmittedNotification());

            return redirect()->route('ideas.create')->with('success', 'تم إرسال فكرتك بنجاح وستتم مراجعتها.');
        } else {
            return redirect()->route('login')->with('error', 'من فضلك سجل دخولك أولاً');
        }
    }

    public function index()
    {
        $ideas = Idea::with('user')->where('status', 'approved')->get();
        return view('ideas.index', compact('ideas'));
    }
}
