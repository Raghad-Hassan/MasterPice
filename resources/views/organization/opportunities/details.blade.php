@extends('organization.layouts.app')

@section('content')
<div class="container py-4">
    <!-- رأس الصفحة -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">{{ $opportunity->title }}</h1>
        <div>
            <a href="{{ route('organization.opportunities.edit', $opportunity->id) }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-edit"></i> تعديل
            </a>
            <a href="{{ route('organization.opportunities.index') }}" class="btn btn-outline-primary">
                <i class="fas fa-arrow-right"></i> العودة للقائمة
            </a>
        </div>
    </div>

    <!-- محتوى الصفحة -->
    <div class="row">
        <!-- الجانب الأيسر - الصورة والتفاصيل -->
        <div class="col-md-8">
            <div class="card mb-4">
                <img src="{{ asset($opportunity->image_path) }}" class="card-img-top" alt="{{ $opportunity->title }}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="badge bg-{{ $opportunity->category_color }}">{{ $opportunity->category_name }}</span>
                        <small class="text-muted">تم النشر: {{ $opportunity->created_at->diffForHumans() }}</small>
                    </div>
                    
                    <h5 class="card-title">وصف الفرصة</h5>
                    <p class="card-text">{{ $opportunity->description }}</p>
                    
                    <h5 class="card-title mt-4">أهداف التنمية المستدامة</h5>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($opportunity->goals as $goal)
                            <span class="badge bg-light text-dark border">
                                <i class="{{ $goal->icon }} me-1"></i> {{ $goal->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- الجانب الأيمن - المعلومات الجانبية -->
        <div class="col-md-4">
            <!-- معلومات الفرصة -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-info-circle me-2"></i> معلومات الفرصة
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-clock me-2"></i> عدد الساعات:</span>
                            <span>{{ $opportunity->total_hours }} ساعة</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-map-marker-alt me-2"></i> الموقع:</span>
                            <span>{{ $opportunity->location }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-calendar-alt me-2"></i> التاريخ:</span>
                            <span>{{ $opportunity->start_date->format('Y-m-d') }} إلى {{ $opportunity->end_date->format('Y-m-d') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-calendar-day me-2"></i> الأيام:</span>
                            <span>{{ $opportunity->working_days }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-clock me-2"></i> الساعات:</span>
                            <span>{{ $opportunity->start_time }} - {{ $opportunity->end_time }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span><i class="fas fa-bus me-2"></i> وسائل النقل:</span>
                            <span>{{ $opportunity->transportation_available ? 'متاحة' : 'غير متاحة' }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- إحصائيات المشاركة -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-chart-bar me-2"></i> إحصائيات المشاركة
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p class="mb-1">المتطوعين المسجلين: {{ $opportunity->volunteers_count }} من {{ $opportunity->max_volunteers }}</p>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" 
                                 style="width: {{ ($opportunity->volunteers_count / $opportunity->max_volunteers) * 100 }}%">
                            </div>
                        </div>
                    </div>

                    <h6 class="mt-4">توزيع الساعات التطوعية</h6>
                    <canvas id="hoursChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- قائمة المتطوعين -->
    <div class="card mt-4">
        <div class="card-header bg-primary text-white">
            <i class="fas fa-users me-2"></i> المتطوعين المسجلين
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم المتطوع</th>
                            <th>البريد الإلكتروني</th>
                            <th>الساعات المسجلة</th>
                            <th>حالة الموافقة</th>
                            <th>إجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($opportunity->volunteers as $volunteer)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $volunteer->user->name }}</td>
                            <td>{{ $volunteer->user->email }}</td>
                            <td>{{ $volunteer->pivot->hours }} ساعة</td>
                            <td>
                                <span class="badge bg-{{ $volunteer->pivot->approved ? 'success' : 'warning' }}">
                                    {{ $volunteer->pivot->approved ? 'موافق' : 'قيد المراجعة' }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" 
                                        data-bs-target="#volunteerModal{{ $volunteer->id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a href="#" class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-check"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- نماذج عرض بيانات المتطوعين -->
@foreach($opportunity->volunteers as $volunteer)
<div class="modal fade" id="volunteerModal{{ $volunteer->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">بيانات المتطوع: {{ $volunteer->user->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset($volunteer->user->profile_image) }}" 
                             class="img-fluid rounded-circle mb-3" width="120" alt="صورة المتطوع">
                    </div>
                    <div class="col-md-8">
                        <p><strong>البريد الإلكتروني:</strong> {{ $volunteer->user->email }}</p>
                        <p><strong>الهاتف:</strong> {{ $volunteer->user->phone ?? 'غير متوفر' }}</p>
                        <p><strong>الساعات المسجلة:</strong> {{ $volunteer->pivot->hours }} ساعة</p>
                        <p><strong>تاريخ التسجيل:</strong> {{ $volunteer->pivot->created_at->format('Y-m-d') }}</p>
                    </div>
                </div>
                <hr>
                <h6>مهارات المتطوع</h6>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($volunteer->skills as $skill)
                        <span class="badge bg-light text-dark">{{ $skill->name }}</span>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                <button type="button" class="btn btn-primary">حفظ التغييرات</button>
            </div>
        </div>
    </div>
</div>
@endforeach

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // رسم مخطط توزيع الساعات
    const ctx = document.getElementById('hoursChart').getContext('2d');
    const hoursChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['5 ساعات', '10 ساعات', '15 ساعات', 'أكثر'],
            datasets: [{
                data: [{{ $hours_distribution }}],
                backgroundColor: [
                    '#4e73df',
                    '#1cc88a',
                    '#36b9cc',
                    '#f6c23e'
                ],
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }],
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    rtl: true
                }
            }
        }
    });
</script>
@endpush
@endsection