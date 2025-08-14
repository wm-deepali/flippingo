@extends('layouts.master')

@section('content')
<style>
    .form-label { font-weight: bold; }
</style>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-body">

            {{-- Top page toolbar --}}
            <div class="row mb-2">
                <div class="col-12 d-flex justify-content-end">
                    <a href="{{ route('admin.form.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Forms
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Centered column -->
                <div class="col-lg-7 col-md-8 col-sm-12 mx-auto">
                    <div class="card shadow-sm rounded">
                        <div class="card-body" style="background: #fff; padding:20px;">

                            {{-- Render saved HTML --}}
                            {!! $formData->html !!}

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
