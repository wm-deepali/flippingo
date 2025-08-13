@extends('layouts.new-master')

@section('title')
Flippingo -About Us
@endsection

@section('content')

		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--start breadcrumb-->
				<section class="py-3 border-bottom d-none d-md-flex">
					<div class="container">
						<div class="page-breadcrumb d-flex align-items-center">
							<h3 class="breadcrumb-title pe-3">About Us</h3>
							<div class="ms-auto">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb mb-0 p-0">
										<li class="breadcrumb-item"><a href="javascript:;"><i
													class="bx bx-home-alt"></i> Home</a>
										</li>
										<li class="breadcrumb-item"><a href="javascript:;">Pages</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">About Us</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
				</section>
				<!--end breadcrumb-->
				<!--start page content-->
				<section class="py-0 py-lg-4">
					<div class="container">
						<h4>A friendly highly skilled team</h4>
						<p style="color: #fff;">Flippingo was established in 2023, led by Mike and Dan our team offers
							fast turnaround print at very short notice; We manage the entire process efficiently from
							start to finish helping you with all your print jobs, campaigns and events.</p>
						<p style="color: #fff;">Flippingo is a buzzing place with a friendly and highly skilled team
							who ensure our clients are looked after every step of the way. You will even have a
							dedicated Account Manager to ensure the best possible customer service experience. We want
							our clients to love working with us and to love the end results even more… see our
							testimonials page to check out a few unsolicited words from our clients.</p>

					</div>
				</section>

				<section class="py-4">
					<div class="container">
						<h4>Why Choose Us</h4>
						<hr>
						<div class="row row-cols-1 row-cols-lg-3">
							<div class="col d-flex">
								<div class="card rounded-0 shadow-none w-100">
									<div class="card-body">
										<img src="{{ URL::asset('assets/images/icons/delivery.png')}}" width="60" alt="">
										<h5 class="my-3">Our Mission</h5>
										<p class="mb-0">Flippingo is passionately committed to providing friendly, expert
											and outstanding value print, design and communications solutions.</p>
									</div>
								</div>
							</div>
							<div class="col d-flex">
								<div class="card rounded-0 shadow-none w-100">
									<div class="card-body">
										<img src="{{ URL::asset('assets/images/icons/money-bag.png')}}" width="60" alt="">
										<h5 class="my-3">Quality Control</h5>
										<p class="mb-0">Providing an exceptional quality service is what makes us tick.
											We are strict on internal quality management, colour control, secure data
											and print finishing.</p>
									</div>
								</div>
							</div>
							<div class="col d-flex">
								<div class="card rounded-0 shadow-none w-100">
									<div class="card-body">
										<img src="{{ URL::asset('assets/images/icons/support.png')}}" width="60" alt="">
										<h5 class="my-3">Our Enviroment</h5>
										<p class="mb-0">We have an ongoing sustainability programme and are proud to to
											say we will only use FSC papers for all our printing jobs.</p>
									</div>
								</div>
							</div>
						</div>
						<!--end row-->
					</div>
				</section>
				<section class="py-4">
					<div class="container">
						<h4>What We Print</h4>
						<hr>
						<div class="container">
							<p>At Flippingo we print a vast range of products. Please see below a list of the types of
								things we print:</p>
							<ul style="list-style: none; padding-left: 0;">
								<li>🔴 Flyers – Digital and litho on various stocks</li>
								<li>🔴 Posters – A3 to AO+</li>
								<li>🔴 Leaflets – Folded types of paper finished on different stocks</li>
								<li>🔴 Books – Hardback and SoftBack</li>
								<li>🔴 Banners – Different sizes with eyelets</li>
								<li>🔴 Boards – Aluminium and Foamex boards</li>
								<li>🔴 Business Cards – Different types of lamination</li>
								<li>🔴 Booklets – 8pp to 68pp with square backs</li>
								<li>🔴 Postcards – A5 and A6 with gloss to the face</li>
								<li>🔴 Roller Banners – Deluxe frames</li>
								<li>🔴 T-shirts – Supplied in different sizes and colours</li>
								<li>🔴 Mugs – Printed in full colour</li>
							</ul>
						</div>
					</div>
				</section>

				<section class="py-4">
					<div class="container">
						<h4>Our Top Brands</h4>
						<hr>
						<div class="row row-cols-2 row-cols-sm-2 row-cols-md-4 row-cols-xl-5">
							<div class="col">
								<div class="card">
									<div class="card-body">
										<a href="javscript:;">
											<img src="{{ URL::asset('assets/images/brands/01.png')}}" class="img-fluid" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card">
									<div class="card-body">
										<a href="javscript:;">
											<img src="{{ URL::asset('assets/images/brands/02.png')}}" class="img-fluid" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card">
									<div class="card-body">
										<a href="javscript:;">
											<img src="{{ URL::asset('assets/images/brands/03.png')}}" class="img-fluid" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card">
									<div class="card-body">
										<a href="javscript:;">
											<img src="{{ URL::asset('assets/images/brands/04.png')}}" class="img-fluid" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card">
									<div class="card-body">
										<a href="javscript:;">
											<img src="{{ URL::asset('assets/images/brands/05.png')}}" class="img-fluid" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card">
									<div class="card-body">
										<a href="javscript:;">
											<img src="{{ URL::asset('assets/images/brands/06.png')}}" class="img-fluid" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card">
									<div class="card-body">
										<a href="javscript:;">
											<img src="{{ URL::asset('assets/images/brands/07.png')}}" class="img-fluid" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card">
									<div class="card-body">
										<a href="javscript:;">
											<img src="{{ URL::asset('assets/images/brands/08.png')}}" class="img-fluid" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card">
									<div class="card-body">
										<a href="javscript:;">
											<img src="{{ URL::asset('assets/images/brands/09.png')}}" class="img-fluid" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card">
									<div class="card-body">
										<a href="javscript:;">
											<img src="{{ URL::asset('assets/images/brands/10.png')}}" class="img-fluid" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card">
									<div class="card-body">
										<a href="javscript:;">
											<img src="{{ URL::asset('assets/images/brands/11.png')}}" class="img-fluid" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card">
									<div class="card-body">
										<a href="javscript:;">
											<img src="{{ URL::asset('assets/images/brands/12.png')}}" class="img-fluid" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card">
									<div class="card-body">
										<a href="javscript:;">
											<img src="{{ URL::asset('assets/images/brands/13.png')}}" class="img-fluid" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card">
									<div class="card-body">
										<a href="javscript:;">
											<img src="{{ URL::asset('assets/images/brands/14.png')}}" class="img-fluid" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="card">
									<div class="card-body">
										<a href="javscript:;">
											<img src="{{ URL::asset('assets/images/brands/15.png')}}" class="img-fluid" alt="">
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!--end start page content-->
			</div>
		</div>
		<!--end page wrapper -->
@endsection