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
                <li class="nav-item active"><a href="{{ route('browsejobs') }}" class="nav-link">Browse My Jobs</a></li>
	          <li class="nav-item"><a href="{{ route('NewPost') }}" class="nav-link">Post a Job</a></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="form-control btn btn-secondary" type="submit" >Logout</button>
                    </form>
                </li>
	        </ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->

    <div class="hero-wrap hero-wrap-2" style="background-image: url('/images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end justify-content-start">
          <div class="col-md-12 ftco-animate text-center mb-5">
          	<p class="breadcrumbs mb-0"><span class="mr-3"><a href="{{ route('home') }}">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>My Posts</span></p>
            <h1 class="mb-3 bread">Browse My Posts</h1>
          </div>
        </div>
      </div>
    </div>

      <section class="ftco-section bg-light">
          <div class="container">
              <div class="row">
                  <h2 class="mb-4">Your posts active</h2>
                  <div class="ftco-search my-md-5">
                      <div class="row">
                          <div class="col-md-12 nav-link-wrap">
                              <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                  <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Customize and Search</a>

                              </div>
                          </div>
                  <div class="col-md-12 tab-wrap">
                      <div class="tab-content p-4" id="v-pills-tabContent">
                          <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                              <form class="search-job">
                                  <div class="row no-gutters">
                                      <div class="col-md mr-md-2">
                                          <div class="form-group">
                                              <div class="form-field">
                                                  <div class="icon"><span class="icon-briefcase"></span></div>
                                                  <input type="text" id="jobSearch"  class="form-control" placeholder="Type a keyword" onkeyup="filterJobs()">
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md mr-md-2">
                                          <div class="form-group">
                                              <div class="form-field">
                                                  <div class="select-wrap">
                                                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                                      <select name="" id="itemsPerPage" class="form-control" onchange="updateItemsPerPage(this.value)">
                                                          <option value="">Items per page</option>
                                                          <option value="3" {{ request('items_per_page') == 3 ? 'selected' : '' }}>3</option>
                                                          <option value="5" {{ request('items_per_page') == 5 ? 'selected' : '' }}>5</option>
                                                          <option value="10" {{ request('items_per_page') == 10 ? 'selected' : '' }}>10</option>
                                                          <option value="20" {{ request('items_per_page') == 20 ? 'selected' : '' }}>20</option>
                                                      </select>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md mr-md-2">
                                          <div class="form-group">
                                              <div class="form-field">
                                                  <div class="icon"><span class="icon-map-marker"></span></div>
                                                  <input type="text" class="form-control" placeholder="Location">
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </form>
                          </div>
                      </div>
                  <!-- Job Listings -->
                  <div id="jobList">
                      @if($jobs->isEmpty())
                          <div class="col-md-12">
                              <span class="subheading">No job postings available at the moment.</span>
                          </div>
                      @else
                          @foreach($jobs as $job)
                              <div class="col-md-12 ftco-animate job-post" data-title="{{ $job->title }}" data-company="{{ $job->company_name }}" data-description="{{ $job->description }}" data-location="{{ $job->location }}">
                                  <div class="job-post-item p-4 d-block d-lg-flex align-items-center">
                                      <div class="one-third mb-4 mb-md-0">
                                          <div class="job-post-item-header align-items-center">
                                              <span class="subadge">{{ $job->job_type }}</span>
                                              <h2 class="mr-3 text-black">
                                                  <a>{{ $job->title }}</a>
                                              </h2>
                                          </div>
                                          <div class="job-post-item-body d-block d-md-flex">
                                              <span>{{ $job->description }}</span>
                                          </div>
                                          <div class="job-post-item-body d-block d-md-flex">
                                              <div class="mr-3">
                                                  <span class="icon-layers"></span>
                                                  <span>{{ $job->company_name }}</span>
                                              </div>
                                              <div class="mr-3">
                                                  <span class="icon-my_location"></span>
                                                  <span>{{ $job->location }}</span>
                                              </div>
                                              <div>
                                                  <span class="icon-euro_symbol"></span>
                                                  <span>{{ $job->salary }}</span>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="one-forth ml-auto d-flex align-items-center mt-4 md-md-0">
                                          <div>
                                              <a href="{{route('job.edit', $job->id)}}" class="icon text-center d-flex justify-content-center align-items-center icon mr-2">
                                                  <span class="icon-edit"></span>
                                              </a>
                                          </div>
                                          <form action="{{ route('job.delete', $job->id) }}" method="POST" onsubmit="return confirmDelete()">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="btn btn-danger py-2">Delete</button>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          @endforeach
                      @endif
                  </div>
              </div>
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
      <script>
          function confirmDelete() {
              // JavaScript confirmation dialog
              return confirm('Are you sure you want to delete this job post?');
          }
          function filterJobs() {
              const keyword = document.getElementById('jobSearch').value.toLowerCase();
              const jobPosts = document.querySelectorAll('.job-post');

              jobPosts.forEach(job => {
                  const title = job.getAttribute('data-title').toLowerCase();
                  const company = job.getAttribute('data-company').toLowerCase();
                  const description = job.getAttribute('data-description').toLowerCase();
                  const location = job.getAttribute('data-location').toLowerCase();

                  if (title.includes(keyword) || company.includes(keyword) || description.includes(keyword) || location.includes(keyword)) {
                      job.style.display = 'block'; // Show matching jobs
                  } else {
                      job.style.display = 'none'; // Hide non-matching jobs
                  }
              });
          }
          function updateItemsPerPage(itemsPerPage) {
              const currentUrl = new URL(window.location.href);
              currentUrl.searchParams.set('items_per_page', itemsPerPage);
              currentUrl.searchParams.set('page', 1); // Reset to the first page
              window.location.href = currentUrl.toString();
          }
      </script>
  </body>
</html>
