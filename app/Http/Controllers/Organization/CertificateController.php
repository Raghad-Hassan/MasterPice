<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certificate;
use App\Models\User;
use App\Models\VolunteerOpportunity;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    // دالة عرض النموذج لإنشاء الشهادة
    public function create(Request $request)
    {
        // جلب المعاملات من الـ query string
        $userId = $request->query('user');
        $opportunityId = $request->query('opportunity');

        // عرض النموذج مع تمرير المعاملات
        return view('organization.certificates.create', compact('userId', 'opportunityId'));
    }

    // دالة تخزين الشهادة في قاعدة البيانات
    public function store(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $data = $request->validate([
            'user_id' => 'required|exists:users,id', // التأكد من وجود المستخدم
            'volunteer_opportunities_id' => 'required|exists:volunteer_opportunities,id', // التأكد من وجود الفرصة التطوعية
            'title' => 'required|string|max:255', // التحقق من العنوان
            'organization' => 'required|string|max:255', // التحقق من اسم المنظمة
            'issue_date' => 'required|date', // التحقق من تاريخ الإصدار
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // التحقق من الصورة (حجم ونوع)
        ]);

        // معالجة تحميل الصورة إذا كانت موجودة
        if ($request->hasFile('image_path')) {
            // تخزين الصورة في مجلد certificates داخل الـ storage
            $data['image_path'] = $request->file('image_path')->store('certificates', 'public');
        }

        // إنشاء سجل جديد في جدول الشهادات
        Certificate::create($data);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->back()->with('success', 'تم إصدار الشهادة بنجاح.');
    }
}
