@extends('layouts.new-master')

@section('title')
    {{ $page->meta_title ?? 'Flippingo' }}
@endsection

@section('meta_tags')
    <meta name="title" content="{{ $page->meta_title }}">
    <meta name="description" content="{{ $page->meta_description }}">
    <meta name="keywords" content="{{ $page->meta_keyword }}">
@endsection

@section('content')
    @if($page && $page->status === 'published')
        <div class="page-wrapper">
            <div class="page-content">
                <div>{!! $page->detail !!}</div>
            </div>
        </div>
    @else
        <div class="page-wrapper">
            <div class="page-content text-center py-5">
                <h3>Page not found or unpublished.</h3>
            </div>
        </div>
    @endif
@endsection
