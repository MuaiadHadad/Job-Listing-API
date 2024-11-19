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
	          <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="{{ route('browsejobs') }}" class="nav-link">Browse My Jobs</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

    <div class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-start">
          <div class="col-md-12 ftco-animate text-center mb-5">
          	<p class="breadcrumbs mb-0"><span class="mr-3"><a href="{{ route('browsejobs') }}">My Posts <i class="ion-ios-arrow-forward"></i></a></span> <span>Job Post</span></p>
            <h1 class="mb-3 bread">Post A Job</h1>
          </div>
        </div>
      </div>
    </div>

		<section class="ftco-section bg-light">

      <div class="container">
        <div class="row">

          <div class="col-md-12 col-lg-8 mb-5">
                  <div class="container">
                      <!-- Display validation errors -->
                      @if ($errors->any())
                          <div class="alert alert-error">
                              @foreach ($errors->all() as $error)
                                  <p>{{ $error }}</p>
                              @endforeach
                          </div>
                      @endif
                      <form action="{{ route('job.store') }}" method="POST" class="p-5 bg-white">
                          @csrf
                          <div class="row form-group">
                              <div class="col-md-12 mb-3 mb-md-0">
                                  <label class="font-weight-bold" for="title">Job Title</label>
                                  <input type="text" id="title" name="title" class="form-control" placeholder="e.g., Professional UI/UX Designer" value="{{ old('title') }}">
                                  @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                              </div>
                          </div>

                          <div class="row form-group mb-5">
                              <div class="col-md-12 mb-3 mb-md-0">
                                  <label class="font-weight-bold" for="company">Company</label>
                                  <input type="text" id="company" name="company" class="form-control" placeholder="e.g., Facebook, Inc." value="{{ old('company') }}">
                                  @error('company') <small class="text-danger">{{ $message }}</small> @enderror
                              </div>
                          </div>

                          <div class="row form-group">
                              <div class="col-md-12"><h3>Job Type</h3></div>
                              <div class="col-md-12 mb-3 mb-md-0">
                                  <label><input type="radio" name="job_type" value="full-time" {{ old('job_type') == 'Full Time' ? 'checked' : '' }}> Full Time</label>
                              </div>
                              <div class="col-md-12 mb-3 mb-md-0">
                                  <label><input type="radio" name="job_type" value="part-time" {{ old('job_type') == 'Part Time' ? 'checked' : '' }}> Part Time</label>
                              </div>
                              <div class="col-md-12 mb-3 mb-md-0">
                                  <label><input type="radio" name="job_type" value="remote" {{ old('job_type') == 'remote' ? 'checked' : '' }}> Remote</label>
                              </div>
                              <div class="col-md-12 mb-3 mb-md-0">
                                  <label><input type="radio" name="job_type" value="Internship" {{ old('job_type') == 'Internship' ? 'checked' : '' }}> Internship</label>
                              </div>
                              <div class="col-md-12 mb-3 mb-md-0">
                                  <label><input type="radio" name="job_type" value="Temporary" {{ old('job_type') == 'Temporary' ? 'checked' : '' }}> Temporary</label>
                              </div>
                          </div>

                          <div class="row form-group mb-4">
                              <div class="col-md-12"><h3>Salary</h3></div>
                              <div class="col-md-12 mb-3 mb-md-0">
                                  <input type="text" name="salary" class="form-control" placeholder="3000" value="{{ old('salary') }}">
                                  @error('salary') <small class="text-danger">{{ $message }}</small> @enderror
                              </div>
                          </div>

                          <div class="row form-group mb-4">
                              <div class="col-md-12"><h3>Location</h3></div>
                              <div class="col-md-12 mb-3 mb-md-0">
                                  <input type="text" name="location" class="form-control" placeholder="Western City, UK" value="{{ old('location') }}">
                                  @error('location') <small class="text-danger">{{ $message }}</small> @enderror
                              </div>
                          </div>
                          <div class="row form-group">
                              <div class="col-md-12"><h3>Job Description</h3></div>
                              <div class="col-md-12 mb-3 mb-md-0">
                                  <textarea name="description" class="form-control" cols="30" rows="5">{{ old('description') }}</textarea>
                                  @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                              </div>
                          </div>

                          <div class="row form-group">
                              <div class="col-md-12">
                                  <input type="submit" value="Post" class="btn btn-primary py-2 px-5">
                              </div>
                          </div>
                      </form>
                  </div>
          </div>

          <div class="col-lg-4">
            <div class="p-4 mb-3 bg-white">
              <h3 class="h5 text-black mb-3">Contact Info</h3>
              <p class="mb-0 font-weight-bold">Address</p>
              <p class="mb-4">Rua Dr.Carlos Mota pinto 34, Coimbra, Portugal</p>

              <p class="mb-0 font-weight-bold">Phone</p>
              <p class="mb-4"><a href="#">+351 960 454 160</a></p>

              <p class="mb-0 font-weight-bold">Email Address</p>
              <p class="mb-0"><a href="#"><span class="__cf_email__" data-cfemail="671e081215020a060e0b2703080a060e094904080a">aeadhadad5@gmail.com</span></a></p>

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
