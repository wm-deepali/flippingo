@extends('layouts.user-master')

@section('title')
    {{ $page->meta_title ?? 'Reports' }}
@endsection
 

@section('content')

    @include('user.sidebar')

    <div class="page-wrapper">

        <div class="report-analystics container my-4">

            <!-- Title -->
            <h4 class="fw-bold">Analytics for: {{ $submission->product_title }}</h4>
            <p>Category: {{ $submission->category_name ?? '-' }}</p>

            <!-- Summary Cards -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="report-card pastel-blue">
                        <p>Total Clicks</p>
                        <h3>{{ array_sum($chartClicks) }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="report-card pastel-green">
                        <p>Total Views</p>
                        <h3>{{ array_sum($chartViews) }}</h3>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="report-card pastel-purple">
                        <p>Unique Views</p>
                        <h3>{{ array_sum($chartUniques ?? []) }}</h3>
                    </div>
                </div>
            </div>

            {{-- Chart --}}
            <div class="card">
                <div class="card-header">
                    <h5>Views & Clicks (Last 30 Days)</h5>
                </div>
                <div class="card-body">
                    <canvas id="submissionChart" style="width:100%; height:400px;"></canvas>
                </div>
            </div>


        </div>

        <!-- CSS -->
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('submissionChart').getContext('2d');
const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($chartLabels),
        datasets: [
            {
                label: 'Views',
                data: @json($chartViews),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'Clicks',
                data: @json($chartClicks),
                backgroundColor: 'rgba(255, 99, 132, 0.6)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },
            {
                label: 'Unique Views',
                data: @json($chartUniques ?? []),
                backgroundColor: 'rgba(255, 206, 86, 0.6)',
                borderColor: 'rgba(255, 206, 86, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { position: 'top' },
            title: {
                display: true,
                text: 'Submission Activity Last 30 Days'
            }
        },
        scales: {
            y: { beginAtZero: true, title: { display: true, text: 'Count' } },
            x: { title: { display: true, text: 'Date' } }
        }
    }
});
</script>
@endsection