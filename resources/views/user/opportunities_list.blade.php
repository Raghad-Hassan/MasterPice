<link rel="stylesheet" href="{{ asset('assets/css/عرض الفرص.css') }}">
@if($opportunities->count() > 0)
    <div class="row">
        @foreach($opportunities as $opportunity)
            <div class="col-md-4 mb-4">
                <a href="{{ route('opportunity.details', $opportunity->id) }}" style="text-decoration: none; color: inherit;">
                    <div class="opportunity-card"
                    data-category="{{ $opportunity->category }}"
                    data-end-date="{{ $opportunity->end_date }}"
                    data-status="{{ $opportunity->status }}"
                    data-gender="{{ $opportunity->gender }}"
                    data-organization="{{ $opportunity->organization_type }}"
                    data-location="{{ $opportunity->city }}"
                    data-hours="{{ $opportunity->volunteer_hours }}">
                        {{-- @if($opportunity->image)
                            <img src="{{ asset('storage/' . $opportunity->image) }}" alt="صورة الفرصة" class="opportunity-img">
                        @else
                            <img src="{{ asset('images/default-opportunity.jpg') }}" alt="صورة افتراضية" class="opportunity-img">
                        @endif --}}
                        <div class="opportunity-details">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-{{ $icons[$opportunity->category] ?? 'th-large' }} me-2"></i>
                                <h5 class="opportunity-title mb-0">{{ $opportunity->title }}</h5>
                            </div>
                            <p class="opportunity-description">{{ \Illuminate\Support\Str::limit($opportunity->description, 100) }}</p>
                            
                            <div class="d-flex justify-content-between mb-2">
                                <p class="opportunity-info"><i class="fas fa-calendar-alt"></i> {{ $opportunity->start_date->format('Y-m-d') }}</p>
                                <p class="opportunity-info"><i class="fas fa-map-marker-alt"></i> {{ trans('cities.' . $opportunity->city) }}</p>
                            </div>

                            <!-- عدد المشاركين وشريط التقدم -->
                            <div class="participants-container mb-3">
                                <p class="participants-text">
                                    المشاركين: 
                                    <span class="current-participants">{{ $opportunity->current_volunteers }}</span> 
                                    من 
                                    <span class="total-participants">{{ $opportunity->total_volunteers }}</span>
                                </p>
                                <div class="progress-bar">
                                    <div class="progress" 
                                         style="width: {{ ($opportunity->current_volunteers / $opportunity->total_volunteers) * 100 }}%;">
                                    </div>
                                </div>
                            </div>

                            @if(auth()->check()) 
                        </a>
                            @if($opportunity->status === 'available')
                                {{-- <form action="{{ route('opportunity.register', $opportunity->id) }}" method="POST" style="display: inline;">
                                    @csrf --}}
                                    <button class="register-btn" data-user-id='{{ Auth::id() }}' data-opp-id='{{ $opportunity->id }}' onclick='register({{ $opportunity->id }} , {{ Auth::id() }} )'>سجل الآن</button>
                                {{-- </form> --}}
                            @else
                                <button class="register-btn btn-secondary" disabled>مكتمل</button>
                            @endif
                        @else
                        <a href="{{ route('login') }}" class="register-btn" style="display: inline-block; padding: 10px 20px; background-color: #0d6efd; color: white; text-align: center; border-radius: 30px; text-decoration: none;">سجل الآن</a>

                        @endif
                        
                        </div>
                    </div>
            </div>
        @endforeach
    </div>
    
 
@else
    <div class="alert alert-info text-center py-4">
        <i class="fas fa-info-circle me-2"></i>
        لا توجد فرص تطوع متاحة حسب الفلتر المحدد.
    </div>
@endif