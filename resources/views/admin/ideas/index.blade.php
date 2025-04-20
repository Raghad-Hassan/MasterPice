<table class="table">
    <thead>
        <tr>
            <th>عنوان الفكرة</th>
            <th>مجال الفكرة</th>
            <th>الوصف</th>
            <th>الأهداف</th>
            <th>المدة</th>
            <th>الحالة</th>
            <th>الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($ideas as $idea)
            <tr>
                <td>{{ $idea->title }}</td>
                <td>{{ $idea->field }}</td>
                <td>{{ $idea->idea_description }}</td>
                <td>{{ $idea->idea_goals }}</td>
                <td>{{ $idea->idea_duration }}</td>
                <td>{{ ucfirst($idea->status) }}</td>
                <td>
                    @if ($idea->status == 'pending')
                        <a href="{{ route('admin.idea.approve', $idea->id) }}" class="btn btn-success">موافقة</a>
                        <a href="{{ route('admin.idea.reject', $idea->id) }}" class="btn btn-danger">رفض</a>
                    @elseif ($idea->status == 'approved')
                        <a href="{{ route('admin.idea.edit', $idea->id) }}" class="btn btn-warning">تعديل</a>
                    @elseif ($idea->status == 'rejected')
                        <a href="{{ route('admin.idea.delete', $idea->id) }}" class="btn btn-danger">حذف</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
