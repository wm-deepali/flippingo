@extends('layouts.new-master')

@section('title')
	Flippingo Blogs
@endsection

@section('content')

	<!--start page wrapper -->
	<div class="page-wrapper">
		<div class="page-content">
			<!--start breadcrumb-->
			<section class="py-3 border-bottom d-none d-md-flex">
				<div class="container">
					<div class="page-breadcrumb d-flex align-items-center">
						<div class="breadcrumb-title pe-3">Blog</div>
						<div class="ms-auto">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i>
											Home</a>
									</li>
									<li class="breadcrumb-item"><a href="javascript:;">Blog</a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Blog Posts</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
			</section>
			<!--end breadcrumb-->
			<!--start page content-->
			<section class="py-4">
				<div class="container">
					<div class="row">
						<div class="col-12 col-lg-9">
							<div class="blog-right-sidebar p-3">
								@foreach ($blogs as $blog)
									<div class="card mb-4">
										<img src="{{ $blog->thumbnail_url }}" class="card-img-top" alt="{{ $blog->title }}">
										<div class="card-body">
											<div class="list-inline">
												<span class="list-inline-item"><i class='bx bx-user me-1'></i>By Admin</span>
												<span class="list-inline-item"><i
														class='bx bx-calendar me-1'></i>{{ $blog->created_at->format('M d, Y') }}</span>
											</div>
											<h4 class="mt-4">{{ $blog->title }}</h4>
											<p>{{ \Illuminate\Support\Str::limit(strip_tags($blog->detail), 150) }}</p>
											<a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-light btn-ecomm">
												Read More <i class='bx bx-chevrons-right'></i>
											</a>
										</div>
									</div>
								@endforeach
								<hr>


								<nav class="d-flex justify-content-between" aria-label="Page navigation">

									{{-- Prev Button --}}
									<ul class="pagination">
										<li class="page-item {{ $blogs->onFirstPage() ? 'disabled' : '' }}">
											<a class="page-link" href="{{ $blogs->previousPageUrl() ?? 'javascript:;' }}">
												<i class="bx bx-chevron-left"></i> Prev
											</a>
										</li>
									</ul>

									{{-- Page Numbers --}}
									<ul class="pagination">
										@for ($i = 1; $i <= $blogs->lastPage(); $i++)
											<li
												class="page-item d-none d-sm-block {{ $blogs->currentPage() == $i ? 'active' : '' }}">
												<a class="page-link" href="{{ $blogs->url($i) }}">
													{{ $i }}
												</a>
											</li>
										@endfor
									</ul>

									{{-- Next Button --}}
									<ul class="pagination">
										<li class="page-item {{ $blogs->hasMorePages() ? '' : 'disabled' }}">
											<a class="page-link" href="{{ $blogs->nextPageUrl() ?? 'javascript:;' }}"
												aria-label="Next">
												Next <i class="bx bx-chevron-right"></i>
											</a>
										</li>
									</ul>

								</nav>

							</div>
						</div>
						<div class="col-12 col-lg-3">
							<div class="blog-left-sidebar p-3">
								<form>
									<div class="position-relative blog-search mb-3">
										<input type="text" class="form-control form-control-lg rounded-0 pe-5"
											placeholder="Serach posts here...">
										<div class="position-absolute top-50 end-0 translate-middle"><i
												class='bx bx-search fs-4 text-white'></i>
										</div>
									</div>
									<div class="blog-categories mb-3">
										<h5 class="mb-4">Recent Posts</h5>

										@foreach ($recentBlogs as $recent)
											<div class="d-flex align-items-center mb-3">
												<img src="{{ $recent->thumbnail_url }}" width="75" alt="{{ $recent->title }}">
												<div class="ms-3">
													<a href="{{ route('blogs.show', $recent->slug) }}"
														class="fs-6">{{ \Illuminate\Support\Str::limit($recent->title, 40) }}</a>
													<p class="mb-0">{{ $recent->created_at->format('M d, Y') }}</p>
												</div>
											</div>
											<div class="my-3 border-bottom"></div>
										@endforeach
									</div>
								</form>
							</div>
						</div>
					</div>
					<!--end row-->
				</div>
			</section>
			<!--end start page content-->
		</div>
	</div>
	<!--end page wrapper -->
@endsection