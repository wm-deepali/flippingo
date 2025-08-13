@extends('layouts.new-master')

@section('title')
Flippingo -Shop Categories
@endsection



@section('content')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--start breadcrumb-->
				<section class="py-3 border-bottom d-none d-md-flex">
					<div class="container">
						<div class="page-breadcrumb d-flex align-items-center">
							<h3 class="breadcrumb-title pe-3">Shop Categories</h3>
							<div class="ms-auto">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb mb-0 p-0">
										<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i> Home</a>
										</li>
										<li class="breadcrumb-item"><a href="javascript:;">Shop</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Shop Categories</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
				</section>
				<!--end breadcrumb-->
				<!--start shop categories-->
				<section class="py-4">
					<div class="container">
						<div class="product-categories">
							<div class="row row-cols-1 row-cols-lg-4">
							    @if(isset($shpcategories) && count($shpcategories)>0)
							    @foreach($shpcategories as $shpcategory)
								<div class="col">
									<div class="card rounded-0 product-card">
										<a href="javascript:;">
											<img src="{{ asset('storage/'.$shpcategory->image) }}" class="card-img-top border-bottom bg-dark-1" alt="...">
										</a>
										<div class="list-group list-group-flush">
											<a href="javascript:;" class="list-group-item bg-transparent">
												<h6 class="mb-0 text-uppercase">{{$shpcategory->name}}</h6>
											</a>	
											@if(isset($shpcategory->subcategories) && count($shpcategory->subcategories)>0)
							                @foreach($shpcategory->subcategories as $shopsubcat)
											
											<a href="{{ route('subcategory-details', ['slug' => $shopsubcat->slug]) }}" class="list-group-item bg-transparent d-flex justify-content-between align-items-center">
											{{$shopsubcat->name}}
										  <!--span class="badge bg-light rounded-pill">14</span-->
										</a>
										@endforeach
											@endif
										</div>
									</div>
								</div>
								@endforeach
								@endif
								
							</div>
							<!--end row-->
						</div>
					</div>
				</section>
				<!--end shop categories-->
				<!--start brand-->
				<section class="py-4">
					<div class="container">
						<div class="popular-brands">
							<div class="text-center">
								<h2 class="text-uppercase mb-0">Popular Brands</h2>
								<hr>
							</div>
							<div class="row row-cols-2 row-cols-sm-2 row-cols-md-4 row-cols-xl-5">
								<div class="col">
									<div class="card">
										<div class="card-body">
											<a href="javscript:;">
												<img src="{{ URL::asset('assets/images/brands/01.png')}}" class="img-fluid" alt="" />
											</a>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="card">
										<div class="card-body">
											<a href="javscript:;">
												<img src="{{ URL::asset('assets/images/brands/02.png')}}" class="img-fluid" alt="" />
											</a>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="card">
										<div class="card-body">
											<a href="javscript:;">
												<img src="{{ URL::asset('assets/images/brands/03.png')}}" class="img-fluid" alt="" />
											</a>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="card">
										<div class="card-body">
											<a href="javscript:;">
												<img src="{{ URL::asset('assets/images/brands/04.png')}}" class="img-fluid" alt="" />
											</a>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="card">
										<div class="card-body">
											<a href="javscript:;">
												<img src="{{ URL::asset('assets/images/brands/05.png')}}" class="img-fluid" alt="" />
											</a>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="card">
										<div class="card-body">
											<a href="javscript:;">
												<img src="{{ URL::asset('assets/images/brands/06.png')}}" class="img-fluid" alt="" />
											</a>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="card">
										<div class="card-body">
											<a href="javscript:;">
												<img src="{{ URL::asset('assets/images/brands/07.png')}}" class="img-fluid" alt="" />
											</a>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="card">
										<div class="card-body">
											<a href="javscript:;">
												<img src="{{ URL::asset('assets/images/brands/08.png')}}" class="img-fluid" alt="" />
											</a>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="card">
										<div class="card-body">
											<a href="javscript:;">
												<img src="{{ URL::asset('assets/images/brands/09.png')}}" class="img-fluid" alt="" />
											</a>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="card">
										<div class="card-body">
											<a href="javscript:;">
												<img src="{{ URL::asset('assets/images/brands/10.png')}}" class="img-fluid" alt="" />
											</a>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="card">
										<div class="card-body">
											<a href="javscript:;">
												<img src="{{ URL::asset('assets/images/brands/11.png')}}" class="img-fluid" alt="" />
											</a>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="card">
										<div class="card-body">
											<a href="javscript:;">
												<img src="{{ URL::asset('assets/images/brands/12.png')}}" class="img-fluid" alt="" />
											</a>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="card">
										<div class="card-body">
											<a href="javscript:;">
												<img src="{{ URL::asset('assets/images/brands/13.png')}}" class="img-fluid" alt="" />
											</a>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="card">
										<div class="card-body">
											<a href="javscript:;">
												<img src="{{ URL::asset('assets/images/brands/14.png')}}" class="img-fluid" alt="" />
											</a>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="card">
										<div class="card-body">
											<a href="javscript:;">
												<img src="{{ URL::asset('assets/images/brands/15.png')}}" class="img-fluid" alt="" />
											</a>
										</div>
									</div>
								</div>
							</div>
							<!--end row-->
						</div>
					</div>
				</section>
				<!--end brand-->
			</div>
		</div>
@endsection