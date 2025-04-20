@include('component.header')
@section('title', 'التسجيل في المؤتمر التطوعي')
<link rel="stylesheet" href="{{ asset('assets/css/انضم الينا.css') }}"> 

<div class="container mt-5">
    <div class="form-container">
        <a href="{{ route('conferences.register.form', $conferences->id) }}">التسجيل في المؤتمر</a>

        <!-- نموذج التسجيل -->
        <form action="{{ route('conferences.register.submit', $conferences->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">الاسم الكامل:</label>
                <input type="text" name="full_name" class="form-control" required>
                @error('full_name')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">البريد الإلكتروني:</label>
                <input type="email" name="email" class="form-control" required>
                @error('email')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">رقم الهاتف:</label>
                <input type="text" name="phone" class="form-control" required>
                @error('phone')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">مجال الاهتمام:</label>
                <select name="interest_field" class="form-control" required>
                    <option value="" selected disabled>اختر مجال الاهتمام</option>
                    <option value="التعليم">التعليم</option>
                    <option value="البيئة">البيئة</option>
                    <option value="الصحة">الصحة</option>
                    <option value="الدعم النفسي">الدعم النفسي</option>
                    <option value="إدارة الفعاليات">إدارة الفعاليات</option>
                </select>
                @error('interest_field')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">المدينة / الدولة:</label>
                <select name="city" class="form-control" required>
                    <option value="" selected disabled>اختر المدينة / الدولة</option>
                    <option value="عمان - الأردن">عمان - الأردن</option>
                    <option value="إربد - الأردن">إربد - الأردن</option>
                    <option value="الزرقاء - الأردن">الزرقاء - الأردن</option>
                    <option value="العقبة - الأردن">العقبة - الأردن</option>
                    <option value="دبي - الإمارات">دبي - الإمارات</option>
                    <option value="الرياض - السعودية">الرياض - السعودية</option>
                </select>
                @error('city')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">هل لديك خبرة سابقة في التطوع؟</label>
                <select name="previous_experience" class="form-control" required>
                    <option value="" selected disabled>اختر</option>
                    <option value="نعم">نعم</option>
                    <option value="لا">لا</option>
                </select>
                @error('previous_experience')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3" id="experienceDetails" style="display: none;">
                <label class="form-label">إذا كانت لديك خبرة، يرجى توضيحها:</label>
                <textarea name="experience_details" class="form-control"></textarea>
                @error('experience_details')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">المهارات:</label>
                <div class="d-flex flex-wrap">
                    <div class="form-check me-3">
                        <input type="checkbox" class="form-check-input" name="skills[]" value="تنظيم" id="skill1">
                        <label class="form-check-label" for="skill1">تنظيم</label>
                    </div>
                    <div class="form-check me-3">
                        <input type="checkbox" class="form-check-input" name="skills[]" value="إدارة" id="skill2">
                        <label class="form-check-label" for="skill2">إدارة</label>
                    </div>
                    <div class="form-check me-3">
                        <input type="checkbox" class="form-check-input" name="skills[]" value="تصوير" id="skill3">
                        <label class="form-check-label" for="skill3">تصوير</label>
                    </div>
                    <div class="form-check me-3">
                        <input type="checkbox" class="form-check-input" name="skills[]" value="تسويق" id="skill4">
                        <label class="form-check-label" for="skill4">تسويق</label>
                    </div>
                    <div class="form-check me-3">
                        <input type="checkbox" class="form-check-input" name="skills[]" value="كتابة محتوى" id="skill5">
                        <label class="form-check-label" for="skill5">كتابة محتوى</label>
                    </div>
                </div>
                @error('skills')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 mt-5">
                <label class="form-label">لماذا ترغب في المشاركة في المؤتمر التطوعي السنوي؟</label>
                <textarea name="motivation" class="form-control" rows="3" required></textarea>
                @error('motivation')
                    <div class="text-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <form action="{{ route('conferences.register.submit', $conference->id) }}" method="POST">
                @csrf
                
                <button type="submit" class="btn btn-primary">تسجيل</button>
            </form>

            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
</div>

@include('component.footer')
