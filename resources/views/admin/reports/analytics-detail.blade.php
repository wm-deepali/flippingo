@extends('layouts.master')

@section('title', 'Listing Analytics')

@section('content')

<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Submission Analytics</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-body">

            <h4>Analytics for: {{ $submission->product_title }}</h4>
            <p>Category: {{ $submission->category_name ?? '-' }}</p>

            {{-- Summary Cards --}}
            <div class="row mt-3 mb-4">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5>Total Views</h5>
                            <p class="display-4">{{ array_sum($chartViews) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5>Total Clicks</h5>
                            <p class="display-4">{{ array_sum($chartClicks) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5>Total Unique Views</h5>
                            <p class="display-4">{{ array_sum($chartUniques ?? []) }}</p>
                        </div>
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
    </div>
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
