<form action="{{ route('organization.opportunities.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-6">
            <!-- العنوان -->
            <div class="mb-3">
                <label class="form-label">العنوان*</label>
                <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
            </div>

            <!-- الوصف -->
            <div class="mb-3">
                <label class="form-label">الوصف*</label>
                <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
            </div>

            <!-- الصورة -->
            <div class="mb-3">
                <label class="form-label">صورة الفرصة</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>

            <!-- التصنيف -->
            <div class="mb-3">
                <label class="form-label">التصنيف*</label>
                <select name="category" class="form-select" required>
                    <option value="entrepreneurship">ريادة</option>
                    <option value="environment">بيئية</option>
                    <option value="health">صحة</option>
                    <option value="arts">فنون</option>
                    <option value="education">تعليم</option>
                    <option value="sports">رياضة</option>
                    <option value="other">أخرى</option>
                </select>
            </div>

            <!-- الموقع -->
            <div class="mb-3">
                <label class="form-label">الموقع*</label>
                <input type="text" name="location" class="form-control" value="{{ old('location') }}" required>
            </div>

            <!-- المدينة -->
            <div class="mb-3">
                <label class="form-label">المحافظة*</label>
                <select name="city" class="form-select" required>
                    <option value="amman">عمان</option>
                    <option value="zarqa">الزرقاء</option>
                    <option value="irbid">إربد</option>
                    <option value="ajloun">عجلون</option>
                    <option value="mafraq">المفرق</option>
                    <option value="kareem">الكرك</option>
                    <option value="madaba">مادبا</option>
                    <option value="tafilah">الطفيلة</option>
                    <option value="maan">معان</option>
                    <option value="batn">البتراء</option>
                    <option value="jerash">جرش</option>
                    <option value="aqaba">العقبة</option>
                </select>
            </div>

            <!-- عدد ساعات التطوع -->
            <div class="mb-3">
                <label class="form-label">عدد ساعات التطوع*</label>
                <input type="number" name="volunteer_hours" class="form-control" value="{{ old('volunteer_hours') }}" required>
            </div>

            <!-- عدد المتطوعين المطلوب -->
            <div class="mb-3">
                <label class="form-label">عدد المتطوعين المطلوب*</label>
                <input type="number" name="total_volunteers" class="form-control" value="{{ old('total_volunteers', 10) }}" min="1" required>
            </div>

            <!-- الحد الأدنى للساعات -->
            <div class="mb-3">
                <label class="form-label">الحد الأدنى للساعات*</label>
                <input type="number" name="min_hours" class="form-control" value="{{ old('min_hours', 1) }}" min="1" required>
            </div>

            <!-- الحد الأقصى للساعات -->
            <div class="mb-3">
                <label class="form-label">الحد الأقصى للساعات*</label>
                <input type="number" name="max_hours" class="form-control" value="{{ old('max_hours', 10) }}" min="1" required>
            </div>

            <!-- وسائل النقل -->
            <div class="mb-3">
                <label class="form-label">وسائل النقل</label>
                <select name="transportation" class="form-select">
                    <option value="available">متاحة</option>
                    <option value="unavailable">غير متاحة</option>
                </select>
            </div>
        </div>

        <div class="col-md-6">
            <!-- تاريخ البداية -->
            <div class="mb-3">
                <label class="form-label">تاريخ البداية*</label>
                <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}" required>
            </div>

            <!-- تاريخ النهاية -->
            <div class="mb-3">
                <label class="form-label">تاريخ النهاية*</label>
                <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}" required>
            </div>

            <!-- وقت البداية -->
            <div class="mb-3">
                <label class="form-label">وقت البداية</label>
                <input type="time" name="start_time" class="form-control" value="{{ old('start_time') }}">
            </div>

            <!-- وقت النهاية -->
            <div class="mb-3">
                <label class="form-label">وقت النهاية</label>
                <input type="time" name="end_time" class="form-control" value="{{ old('end_time') }}">
            </div>

            <!-- أيام العمل -->
            <div class="mb-3">
                <label class="form-label">أيام العمل*</label>
                <input type="text" name="days" class="form-control" value="{{ old('days') }}" required>
            </div>

            <!-- عدد المشاركين -->
            <div class="mb-3">
                <label class="form-label">عدد المشاركين الحاليين</label>
                <input type="number" name="current_participants" class="form-control" value="{{ old('current_participants', 0) }}" min="0" disabled>
            </div>

            <!-- العدد الإجمالي للمشاركين -->
            <div class="mb-3">
                <label class="form-label">العدد الإجمالي للمشاركين*</label>
                <input type="number" name="total_participants" class="form-control" value="{{ old('total_participants', 0) }}" min="0" required>
            </div>
            <div class="mb-3">
                <label class="form-label">العدد الإجمالي ساعات*</label>
                <input type="number" name="total_hours" class="form-control" value="{{ old('total_hours', 0) }}" min="0" required>
            </div>

            <!-- الجنس المطلوب -->
            <div class="mb-3">
                <label class="form-label">الجنس*</label>
                <select name="gender" class="form-select" required>
                    <option value="all">للجميع</option>
                    <option value="male">للذكور فقط</option>
                    <option value="female">للإناث فقط</option>
                </select>
            </div>

            <!-- حالة الفرصة -->
            <div class="mb-3">
                <label class="form-label">حالة الفرصة*</label>
                <select name="status" class="form-select" required>
                    <option value="available">متاحة</option>
                    <option value="full">ممتلئة</option>
                </select>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary">حفظ الفرصة</button>
        <a href="{{ route('organization.opportunities.index') }}" class="btn btn-secondary">إلغاء</a>
    </div>
</form>
