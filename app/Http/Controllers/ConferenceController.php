<?php

namespace App\Http\Controllers;

use App\Models\AnnualConference;
use App\Models\ConferenceRegistration;
use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    /**
     * عرض قائمة المؤتمرات للمستخدمين
     */
    public function index()
    {
        $conferences = AnnualConference::where('active', true)
                                     ->orderBy('date', 'desc')
                                     ->get();
        
        return view('conferences.show', compact('conferences'));
    }

    /**
     * عرض صفحة التسجيل للمؤتمر
     */
    public function showRegistrationForm($id)
    {
        // جلب المؤتمر باستخدام المعرف
        $conference = AnnualConference::findOrFail($id);
        
        // التحقق من أن المؤتمر مفعل
        if (!$conference->active) {
            abort(404, 'المؤتمر غير متاح حالياً');
        }
        
        return view('conferences.register', compact('conference'));
    }

    /**
     * معالجة تسجيل المؤتمر
     */
    public function register(Request $request, $conferenceId)
    {
        // التحقق من صحة البيانات
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:conference_registrations,email',
            'phone' => 'required|string|max:15',
            'interest_field' => 'required|string',
            'city' => 'required|string',
            'previous_experience' => 'required|in:نعم,لا',
            'experience_details' => 'nullable|string|required_if:previous_experience,نعم',
            'skills' => 'nullable|array',
            'motivation' => 'required|string',
        ]);

        // إنشاء تسجيل جديد
        $registration = new ConferenceRegistration();
        $registration->fill([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'interest_field' => $request->interest_field,
            'city' => $request->city,
            'previous_experience' => $request->previous_experience == 'نعم',
            'experience_details' => $request->experience_details,
            'skills' => json_encode($request->skills),
            'motivation' => $request->motivation,
            'conference_id' => $conferenceId,
            'user_id' => auth()->id() ?? null, // إذا كان مسجل دخول
        ]);

        $registration->save();

        return redirect()->route('conferences.index')
                       ->with('success', 'تم تسجيلك في المؤتمر بنجاح!');
    }

    /**
     * عرض تفاصيل مؤتمر معين
     */
    public function show($id)
{
    $conference = AnnualConference::findOrFail($id);

    $conferenceStats = (object)[
        'workshops_count' => $conference->workshops()->count(),
        'activities_count' => $conference->activities()->count(),
    ];

    $conferences = AnnualConference::all();

    return view('conferences.show', compact('conference', 'conferenceStats', 'conferences'));
}

    /**
     * عرض قائمة المؤتمرات للإدارة (للمشرفين)
     */
    public function adminIndex()
    {
        $conferences = AnnualConference::all();
        return view('admin.annual_conferences.index', compact('conferences'));
    }

    /**
     * عرض نموذج إنشاء مؤتمر جديد
     */
    public function create()
    {
        return view('admin.annual_conferences.create');
    }

    /**
     * حفظ المؤتمر الجديد
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'expected_participants' => 'required|integer',
            'organizations_count' => 'required|integer',
            'activities' => 'required|string',
            'workshops' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // تخزين المؤتمر الجديد
        $conference = AnnualConference::create($request->except('image'));

        // إذا كان هناك صورة، يتم تخزينها
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('conferences', 'public');
            $conference->update(['image' => $imagePath]);
        }

        return redirect()->route('admin.annual-conferences.index')
                         ->with('success', 'تم إنشاء المؤتمر بنجاح');
    }

    /**
     * عرض نموذج تعديل المؤتمر
     */
    public function edit($id)
    {
        $conference = AnnualConference::findOrFail($id);
        return view('admin.annual_conferences.edit', compact('conference'));
    }

    /**
     * تحديث بيانات المؤتمر
     */
    public function update(Request $request, $id)
    {
        $conference = AnnualConference::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'expected_participants' => 'required|integer',
            'organizations_count' => 'required|integer',
            'activities' => 'required|string',
            'workshops' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'active' => 'sometimes|boolean',
        ]);

        // تحديث المؤتمر
        $conference->update($request->except('image'));

        // إذا كان هناك صورة جديدة، تحديثها
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('conferences', 'public');
            $conference->update(['image' => $imagePath]);
        }

        return redirect()->route('admin.annual-conferences.index')
                         ->with('success', 'تم تحديث المؤتمر بنجاح');
    }

    /**
     * حذف المؤتمر
     */
    public function destroy($id)
    {
        $conference = AnnualConference::findOrFail($id);
        $conference->delete();

        return redirect()->route('admin.annual-conferences.index')
                         ->with('success', 'تم حذف المؤتمر بنجاح');
    }

   
    public function showParticipants($id)
{
    // جلب المؤتمر بناءً على المعرف
    $conference = AnnualConference::findOrFail($id);

    // جلب المشاركين في المؤتمر بناءً على المؤتمر المحدد
    $registrations = ConferenceRegistration::where('conference_id', $id)->get();

    // عرض المؤتمر والمشاركين
    return view('admin.participants', compact('conference', 'registrations'));
}

}
