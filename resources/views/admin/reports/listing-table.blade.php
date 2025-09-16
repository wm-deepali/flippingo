<table class="table table-hover">
    <thead>
        <tr>
            <th>Submission Date</th>
            <th>Product Title</th>
            <th>Category</th>
            <th>Total Clicks</th>
            <th>Total Views</th>
            <th>Unique Views</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($submissions as $submission)
            <tr>
                <td>{{ $submission->created_at->format('Y-m-d') }}</td>
                <td>{{ $submission->product_title }}</td>
                <td>{{ $submission->category_name ?? '-' }}</td>

                <td>{{ number_format($submission->period_clicks) }}</td>
                <td>{{ number_format($submission->period_views) }}</td>
                <td>{{ number_format($submission->period_unique) }}</td>

                <td>
                    <span class="badge badge-{{ $submission->status === 'published' ? 'success' : 'secondary' }}">
                        {{ ucfirst($submission->status) }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('admin.form-submissions.analytics', $submission->id) }}"
                        class="btn btn-sm btn-primary">View</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $submissions->links() }}