@include('component.header')
<link href="{{ asset('assets/css/edit-profil-user.css') }}" rel="stylesheet">

<div class="profile-container">
    <div class="profile-header">
        <form id="uploadForm" action="{{ route('profile.upload.photo') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="profile-picture">
                <!-- عرض الصورة -->
                <img src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('default-profile.jpg') }}" id="profileImage">
                
                <label for="imageUpload" class="edit-icon">
                    <i class="fas fa-camera"></i>
                    <input type="file" id="imageUpload" name="image" accept="image/*" style="display: none;" onchange="document.getElementById('uploadForm').submit();">
                </label>
            </div>
        </form>

        @auth
            @php $user = Auth::user(); @endphp
            <h2>{{ $user->name }}</h2>
            <p class="member-since">عضو منذ: {{ $user->created_at->format('Y-m-d') }}</p>
        @else
            <p>يرجى تسجيل الدخول لعرض بيانات البروفايل.</p>
        @endauth
    </div>

    @auth
    <form id="profile-form" method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT')

        <div class="profile-card">
            <h3><i class="fas fa-id-card"></i> المعلومات الشخصية</h3>

            <div class="form-group">
                <label>الاسم الأول</label>
                <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}">
                <span class="error-text text-danger" id="first_name_error"></span>
            </div>

            <div class="form-group">
                <label>اسم العائلة</label>
                <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}">
                <span class="error-text text-danger" id="last_name_error"></span>
            </div>

            <div class="form-group">
                <label>البريد الإلكتروني</label>
                <input type="text" name="email" value="{{ old('email', $user->email) }}">
                <span class="error-text text-danger" id="email_error"></span>
            </div>

            <div class="form-group">
                <label>الهاتف</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">
                <span class="error-text text-danger" id="phone_error"></span>
            </div>

            <div class="form-group">
                <label>نبذة عنك</label>
                <textarea name="bio" rows="3">{{ $user->bio ?? '' }}</textarea>
                <span class="error-text text-danger" id="bio_error"></span>
            </div>

            <button type="submit" class="save-btn">حفظ التعديلات</button>
        </div>
    </form>

    <!-- سكربت Ajax لمنع إعادة تحميل الصفحة -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#profile-form').on('submit', function(e) {
            e.preventDefault();
            $('.error-text').text('');

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                success: function(response) {
                 window.location.href = "{{ route('profile.show') }}";

                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            $('#' + key + '_error').text(value[0]);
                        });
                    }
                }
            });
        });
    </script>


    @endauth
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('success'))
    <script>
        Swal.fire({
            title: "{{ session('success') }}",
            icon: "success",
            confirmButtonText: "حسنًا",
            customClass: {
                popup: 'swal-wide'
            }
        });
    </script>
@endif


@include('component.footer')
