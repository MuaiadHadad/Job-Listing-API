<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Dream Job</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="/css/animate.css">

    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="/css/magnific-popup.css">

    <link rel="stylesheet" href="/css/aos.css">

    <link rel="stylesheet" href="/css/ionicons.min.css">


    <link rel="stylesheet" href="/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/css/jquery.timepicker.css">


    <link rel="stylesheet" href="/css/flaticon.css">
    <link rel="stylesheet" href="/css/icomoon.css">
    <link rel="stylesheet" href="/css/style.css">
  </head>
  <body>

	  <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container-fluid px-md-4	">
	      <a class="navbar-brand" href="{{ route('home') }}">Dream Job</a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                @guest
                    <!-- When the user is NOT authenticated -->
                    <li class="nav-item cta mr-md-1"><a href="{{ route('login') }}" class="nav-link">Sign in</a></li>
                    <li class="nav-item cta cta-colored"><a href="{{ route('register') }}" class="nav-link">Sign up</a></li>
                @endguest
                @auth
                    <!-- When the user IS authenticated -->
                    <li class="nav-item inactive" ><a href="{{ route('browsejobs') }}" class="nav-link">My Posts</a></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="form-control btn btn-secondary" type="submit" >Logout</button>
                        </form>
                    </li>
                @endauth

	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

    <div class="hero-wrap img" style="background-image: url(images/bg_1.jpg);">
      <div class="overlay"></div>
      <div class="container">
      	<div class="row d-md-flex no-gutters slider-text align-items-center justify-content-center">
	        <div class="col-md-10 d-flex align-items-center ftco-animate">
	        	<div class="text text-center pt-5 mt-md-5">
	        		<p class="mb-4">Find Job, Employment, and Career Opportunities</p>
	            <h1 class="mb-5">The Eassiest Way to Get Your New Job</h1>
							<div class="ftco-counter ftco-no-pt ftco-no-pb">
			        	<div class="row">
				          <div class="col-md-4 d-flex justify-content-center counter-wrap ftco-animate">
				            <div class="block-18">
				              <div class="text d-flex">
				              	<div class="icon mr-2">
				              		<span class="flaticon-worldwide"></span>
				              	</div>
				              	<div class="desc text-left">
					                <strong class="number" data-number="{{ $countriesCount }}">0</strong>
					                <span>Countries</span>
				                </div>
				              </div>
				            </div>
				          </div>
				          <div class="col-md-4 d-flex justify-content-center counter-wrap ftco-animate">
				            <div class="block-18 text-center">
				              <div class="text d-flex">
				              	<div class="icon mr-2">
				              		<span class="flaticon-visitor"></span>
				              	</div>
				              	<div class="desc text-left">
					                <strong class="number" data-number="{{ $companiesCount }}">0</strong>
					                <span>Companies</span>
					              </div>
				              </div>
				            </div>
				          </div>
				          <div class="col-md-4 d-flex justify-content-center counter-wrap ftco-animate">
				            <div class="block-18 text-center">
				              <div class="text d-flex">
				              	<div class="icon mr-2">
				              		<span class="flaticon-resume"></span>
				              	</div>
				              	<div class="desc text-left">
					                <strong class="number" data-number="{{ $jobsCount }}">0</strong>
					                <span>Active Employees</span>
					              </div>
				              </div>
				            </div>
				          </div>
				        </div>
			        </div>
							<div class="ftco-search my-md-5">
								<div class="row">
			            <div class="col-md-12 nav-link-wrap">
				            <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
				              <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Find a Job</a>


				            </div>
				          </div>
				          <div class="col-md-12 tab-wrap">

				            <div class="tab-content p-4" id="v-pills-tabContent">

				              <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
				              	<form action="{{ route('jobs.search') }}" class="search-job">
				              		<div class="row no-gutters">
				              			<div class="col-md mr-md-2">
				              				<div class="form-group">
					              				<div class="form-field">
					              					<div class="icon"><span class="icon-briefcase"></span></div>
									                <input name="title" type="text" class="form-control" placeholder="eg. Garphic. Web Developer">
									              </div>
								              </div>
				              			</div>
				              			<div class="col-md mr-md-2">
				              				<div class="form-group">
				              					<div class="form-field">
					              					<div class="select-wrap">
							                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
							                      <select name="job_type" id="" class="form-control">
							                      	<option value="">Category</option>
							                      	<option value="full-time">Full Time</option>
							                        <option value="part-time">Part Time</option>
							                        <option value="remote">Remote</option>
							                        <option value="Internship">Internship</option>
							                        <option value="Temporary">Temporary</option>
							                      </select>
							                    </div>
									              </div>
								              </div>
				              			</div>
				              			<div class="col-md mr-md-2">
				              				<div class="form-group">
				              					<div class="form-field">
					              					<div class="icon"><span class="icon-map-marker"></span></div>
									                <input name="location" type="text" class="form-control" placeholder="Location">
									              </div>
								              </div>
				              			</div>
                                        <div class="col-md mr-md-2">
                                            <div class="form-group">
                                                <div class="form-field">
                                                    <div class="icon"><span class="icon-explicit"></span></div>
                                                    <input name="experience" type="text" class="form-control" placeholder="experience">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md mr-md-2">
                                            <div class="form-group">
                                                <div class="form-field">
                                                    <div class="icon"><span class="icon-industry"></span></div>
                                                    <input name="industry" type="text" class="form-control" placeholder="company">
                                                </div>
                                            </div>
                                        </div>
				              		</div>
                                    <br>
                                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                                    <div class="col-md mr-md-5">
                                        <div class="form-group">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div id="slider-range"></div>
                                                    </div>
                                                </div>
                                                <div class="row slider-labels">
                                                    <div class="col-xs-6 text-left caption">
                                                        <strong>Min:</strong> <span id="slider-range-value1"></span>
                                                    </div>
                                                    <div class="col-xs-6 text-right caption">
                                                        <strong>Max:</strong> <span id="slider-range-value2"></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                            <input type="hidden" id="min-value" name="min_salary" value="">
                                                            <input type="hidden" id="max-value" name="max_salary" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-group">
                                            <div class="form-field">
                                                <button type="submit" class="form-control btn btn-primary">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
				              	</form>
				              </div>
				            </div>
				          </div>
				        </div>
			        </div>
	          </div>
	        </div>
	    	</div>
      </div>
    </div>
		<section class="ftco-section bg-light">
			<div class="container">
                <div class="row">
						<div class="row">
		          <div class="col-md-12 heading-section ftco-animate">
		          	<span class="subheading">Recently Added Jobs</span>
		            <h2 class="mb-4">Featured Jobs Posts</h2>
		          </div>
		        </div>
                    @foreach ($jobs as $job)
							<div class="col-md-12 ftco-animate ">
		            <div class="job-post-item p-4 d-block d-lg-flex align-items-center">
		              <div class="one-third mb-4 mb-md-0">
		                <div class="job-post-item-header align-items-center">
		                	<span class="subadge">{{ $job->job_type }}</span>
		                  <h2 class="mr-3 text-black"><a>{{$job->title}}</a></h2>
		                </div>
                          <div class="job-post-item-body d-block d-md-flex">
                              <span>{{ $job->description }}</span>
                          </div>
		                <div class="job-post-item-body d-block d-md-flex">
		                  <div class="mr-3"><span class="icon-layers"></span> <a> {{ $job->company_name }}</a></div>
		                  <div><span class="icon-my_location"></span> <span>{{ $job->location }}</span></div>
                            <div>
                                <span class="icon-euro_symbol"></span>
                                <span>{{ $job->salary }}</span>
                            </div>
		                </div>
		              </div>
		            </div>
		          </div><!-- end -->
                    @endforeach
		      </div>
                <!-- Pagination -->
                <div class="row mt-5">
                    <div class="col text-center">
                        <div class="block-27">
                            <ul>
                                <!-- Previous Page Link -->
                                @if ($jobs->onFirstPage())
                                    <li class="disabled"><span>&lt;</span></li>
                                @else
                                    <li>
                                        <a href="{{ $jobs->appends(['items_per_page' => $jobs->perPage()])->previousPageUrl() }}">&lt;</a>
                                    </li>
                                @endif

                                <!-- Page Number Links -->
                                @for ($i = 1; $i <= $jobs->lastPage(); $i++)
                                    @if ($i == $jobs->currentPage())
                                        <li class="active"><span>{{ $i }}</span></li>
                                    @else
                                        <li>
                                            <a href="{{ $jobs->appends(['items_per_page' => $jobs->perPage()])->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endif
                                @endfor

                                <!-- Next Page Link -->
                                @if ($jobs->hasMorePages())
                                    <li>
                                        <a href="{{ $jobs->appends(['items_per_page' => $jobs->perPage()])->nextPageUrl() }}">&gt;</a>
                                    </li>
                                @else
                                    <li class="disabled"><span>&gt;</span></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
		</section>


  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="/js/jquery.min.js"></script>
  <script src="/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="/js/popper.min.js"></script>
  <script src="/js/bootstrap.min.js"></script>
  <script src="/js/jquery.easing.1.3.js"></script>
  <script src="/js/jquery.waypoints.min.js"></script>
  <script src="/js/jquery.stellar.min.js"></script>
  <script src="/js/owl.carousel.min.js"></script>
  <script src="/js/jquery.magnific-popup.min.js"></script>
  <script src="/js/aos.js"></script>
  <script src="/js/jquery.animateNumber.min.js"></script>
  <script src="/js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="/js/google-map.js"></script>
  <script src="/js/main.js"></script>

  </body>
</html>
