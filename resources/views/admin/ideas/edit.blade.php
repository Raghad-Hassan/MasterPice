@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">تعديل فكرة</h2>

    <form action="{{ route('admin.ideas.update', $idea->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- عنوان الفكرة -->
        <div class="mb-3">
            <label for="title" class="form-label">عنوان الفكرة</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $idea->title) }}">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- وصف الفكرة -->
        <div class="mb-3">
            <label for="description" class="form-label">وصف الفكرة</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $idea->description) }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- أهداف الفكرة -->
        <div class="mb-3">
            <label for="idea_goals" class="form-label">أهداف الفكرة</label>
            <textarea name="idea_goals" id="idea_goals" class="form-control" rows="4">{{ old('idea_goals', $idea->idea_goals) }}</textarea>
            @error('idea_goals')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- المدينة -->
        <div class="mb-3">
            <label for="city" class="form-label">المدينة</label>
            <input type="text" name="city" id="city" class="form-control" value="{{ old('city', $idea->city) }}">
            @error('city')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- الكيانات ذات الصلة -->
        <div class="mb-3">
            <label for="related_entities" class="form-label">الكيانات ذات الصلة</label>
            <textarea name="related_entities" id="related_entities" class="form-control" rows="4">{{ old('related_entities', $idea->related_entities) }}</textarea>
            @error('related_entities')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- صورة الفكرة -->
        <div class="mb-3">
            <label for="image" class="form-label">صورة الفكرة</label>
            <input type="file" name="image" id="image" class="form-control">
            @if ($idea->image)
                <img src="{{ asset('storage/' . $idea->image) }}" class="img-thumbnail mt-2" width="200">
            @endif
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    
       
        <!-- زر الحفظ -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
            <a href="{{ route('admin.ideas.index') }}" class="btn btn-secondary">الرجوع</a>
        </div>
    </form>
</div>
@endsection
