<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Idea;

class IdeaController extends Controller
{
    // عرض الأفكار في لوحة التحكم
    public function showIdeasForAdmin()
    {
        // جلب كل الأفكار من قاعدة البيانات
        $ideas = Idea::all();
        return view('admin.ideas.index', compact('ideas'));
    }

    // الموافقة على الفكرة
    public function approveIdea($id)
    {
        $idea = Idea::findOrFail($id);
        $idea->status = 'approved'; // تغيير الحالة إلى "موافقة"
        $idea->save(); // حفظ التغيير في قاعدة البيانات

        return redirect()->route('admin.ideas.index')->with('success', 'تمت الموافقة على الفكرة!');
    }

    // رفض الفكرة
    public function rejectIdea($id)
    {
        $idea = Idea::findOrFail($id);
        $idea->status = 'rejected'; // تغيير الحالة إلى "مرفوضة"
        $idea->save(); // حفظ التغيير في قاعدة البيانات

        return redirect()->route('admin.ideas.index')->with('success', 'تم رفض الفكرة!');
    }

    // حذف الفكرة
    public function deleteIdea($id)
    {
        $idea = Idea::findOrFail($id);
        $idea->delete(); // حذف الفكرة من قاعدة البيانات

        return redirect()->route('admin.ideas.index')->with('success', 'تم حذف الفكرة!');
    }
}
