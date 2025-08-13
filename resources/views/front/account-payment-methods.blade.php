@extends('layouts.new-master')

@section('title')
    Flippingo -Payment Methods
@endsection



@section('content')
		<div class="page-wrapper">
			<div class="page-content">
				<!--start breadcrumb-->
				<section class="py-3 border-bottom d-none d-md-flex">
					<div class="container">
						<div class="page-breadcrumb d-flex align-items-center">
							<h3 class="breadcrumb-title pe-3">Payment Methods</h3>
							<div class="ms-auto">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb mb-0 p-0">
										<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i> Home</a>
										</li>
										<li class="breadcrumb-item"><a href="javascript:;">Account</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">Payment Methods</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
				</section>
				<!--end breadcrumb-->
				<!--start shop cart-->
				<section class="py-4">
					<div class="container">
						<h3 class="d-none">Account</h3>
						<div class="card">
							<div class="card-body">
								<div class="row">
									@include('layouts.includes.user-sidebar', ['activeMenu' => 'payment-methods'])
									<div class="col-lg-8">
										<div class="card shadow-none mb-0">
											<div class="card-body">
												<div class="table-responsive">
													<table class="table">
														<thead class="table-light">
															<tr>
																<th>Method</th>
																<th>Expires</th>
																<th></th>
															</tr>
														</thead>
														<tbody>
															<tr>
																<td>Visa ending in 1111</td>
																<td>11/12</td>
																<td>
																	<div class="d-flex gap-2">	<a href="javascript:;" class="btn btn-light btn-sm rounded-0">Delete</a>
																	</div>
																</td>
															</tr>
															<tr>
																<td>Visa ending in 4242</td>
																<td>11/12</td>
																<td>
																	<div class="d-flex gap-2"> <a href="javascript:;" class="btn btn-light btn-sm rounded-0">Delete</a>
																		<a href="javascript:;" class="btn btn-light btn-sm rounded-0">Make Default</a>
																	</div>
																</td>
															</tr>
														</tbody>
													</table>
												</div> <a href="javascript:;" class="btn btn-light rounded-0">Add Payment Method</a>
											</div>
										</div>
									</div>
								</div>
								<!--end row-->
							</div>
						</div>
					</div>
				</section>
				<!--end shop cart-->
			</div>
		</div>
		<!--end page wrapper -->
@endsection