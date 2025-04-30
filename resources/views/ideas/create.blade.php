@include('component.header')
<link rel="stylesheet" href="{{ asset('assets/css/بنك الافكار.css') }}">

<div class="top-links">
    <a href="{{ route('index') }}">الصفحة الرئيسية</a>
    <a href="#">/ </a>
    <a href="#">بنك الأفكار</a>
</div>

<div class="form-container p-4">
    <div class="container">
        <form action="{{ route('ideas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="ideaField" class="form-label">مجال الفكرة</label>
                    <select class="form-control" name="field" id="ideaField" required>
                        <option value="">اختر مجال الفكرة</option>
                        <option value="تعليم" {{ old('field') == 'تعليم' ? 'selected' : '' }}>تعليم</option>
                        <option value="صحة" {{ old('field') == 'صحة' ? 'selected' : '' }}>صحة</option>
                        <option value="بيئة" {{ old('field') == 'بيئة' ? 'selected' : '' }}>بيئة</option>
                        <option value="تقنية" {{ old('field') == 'تقنية' ? 'selected' : '' }}>تقنية</option>
                        <option value="اجتماعي" {{ old('field') == 'اجتماعي' ? 'selected' : '' }}>اجتماعي</option>
                    </select>
                    @error('field')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                

                <div class="col-md-6">
                    <label for="ideaRegion" class="form-label">المنطقة المقترحة</label>
                    <select class="form-control" name="idea_region" id="ideaRegion" required>
                        <option value="">اختر المنطقة</option>
                        <option value="عمان" {{ old('idea_region') == 'عمان' ? 'selected' : '' }}>عمان</option>
                        <option value="الزرقاء" {{ old('idea_region') == 'الزرقاء' ? 'selected' : '' }}>الزرقاء</option>
                        <option value="إربد" {{ old('idea_region') == 'إربد' ? 'selected' : '' }}>إربد</option>
                        <option value="العقبة" {{ old('idea_region') == 'العقبة' ? 'selected' : '' }}>العقبة</option>
                        <option value="البلقاء" {{ old('idea_region') == 'البلقاء' ? 'selected' : '' }}>البلقاء</option>
                        <option value="المفرق" {{ old('idea_region') == 'المفرق' ? 'selected' : '' }}>المفرق</option>
                        <option value="معان" {{ old('idea_region') == 'معان' ? 'selected' : '' }}>معان</option>
                        <option value="الكرك" {{ old('idea_region') == 'الكرك' ? 'selected' : '' }}>الكرك</option>
                        <option value="الطفيلة" {{ old('idea_region') == 'الطفيلة' ? 'selected' : '' }}>الطفيلة</option>
                        <option value="مادبا" {{ old('idea_region') == 'مادبا' ? 'selected' : '' }}>مادبا</option>
                        <option value="جرش" {{ old('idea_region') == 'جرش' ? 'selected' : '' }}>جرش</option>
                        <option value="عجلون" {{ old('idea_region') == 'عجلون' ? 'selected' : '' }}>عجلون</option>
                    </select>
                    @error('idea_region')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-12">
                    <label for="idea_description" class="form-label">وصف الفكرة</label>
                    <textarea class="form-control" name="idea_description" id="idea_description" rows="3" required>{{ old('idea_description') }}</textarea>
                    @error('idea_description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-12">
                    <label for="ideaGoals" class="form-label">الأهداف التي تحققها الفكرة</label>
                    <textarea class="form-control" name="idea_goals" id="ideaGoals" rows="3" required>{{ old('idea_goals') }}</textarea>
                    @error('idea_goals')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-md-6">
                    <label for="ideaDuration" class="form-label">المدة المقترحة لتنفيذ الفكرة (أيام)</label>
                    <input type="number" class="form-control" name="idea_duration" id="ideaDuration" min="1" value="{{ old('idea_duration') }}" required>
                    @error('idea_duration')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="ideaAuthorities" class="form-label">الجهات المعنية</label>
                    <select class="form-control" name="idea_authorities" id="ideaAuthorities" required>
                        <option value="">اختر الجهة المعنية</option>
                        <option value="البلديات" {{ old('idea_authorities') == 'البلديات' ? 'selected' : '' }}>البلديات</option>
                        <option value="وزارة التربية" {{ old('idea_authorities') == 'وزارة التربية' ? 'selected' : '' }}>وزارة التربية</option>
                        <option value="وزارة الصحة" {{ old('idea_authorities') == 'وزارة الصحة' ? 'selected' : '' }}>وزارة الصحة</option>
                        <option value="القطاع الخاص" {{ old('idea_authorities') == 'القطاع الخاص' ? 'selected' : '' }}>القطاع الخاص</option>
                        <option value="المؤسسات التطوعية" {{ old('idea_authorities') == 'المؤسسات التطوعية' ? 'selected' : '' }}>المؤسسات التطوعية</option>
                    </select>
                    @error('idea_authorities')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" class="btn-submit btn">إضافة الفكرة</button>
                </div>
            </div>
        </form>
    </div>
</div>


@if(session('success'))
    <div class="alert alert-success text-center mt-3" id="success-alert">
        {{ session('success') }}
    </div>

    <script>
        setTimeout(function () {
            let alert = document.getElementById('success-alert');
            if(alert){
                alert.style.display = 'none';
            }
        }, 8000); 
    </script>
@endif

