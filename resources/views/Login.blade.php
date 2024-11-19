<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Dream Job</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- LINEARICONS -->
		<link rel="stylesheet" href="/LoginSt/fonts/linearicons/style.css">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="/LoginSt/css/style.css">
	</head>

	<body>
		<div class="wrapper">
			<div class="inner">
				<img src="/LoginSt/images/image-1.png" alt="" class="image-1">
                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="alert alert-error">
                        <div class="icon__wrapper">
                            <span class="lnr lnr-alarm"></span>
                        </div>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <form action="{{ route('login.submit') }}" method="POST">
                    @csrf
					<h3>Sign in</h3>
                    <div class="form-holder">
                        <span class="lnr lnr-envelope"></span>
                        <input type="email" name="email" class="form-control" placeholder="E-Mail" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-holder">
                        <span class="lnr lnr-lock"></span>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>

                    <button type="submit">
                        <span>Login</span>
                    </button>
                </form>
                <img src="/LoginSt/images/image-2.png" alt="" class="image-2">
			</div>

		</div>

		<script src="/LoginSt/js/jquery-3.3.1.min.js"></script>
		<script src="/LoginSt/js/main.js"></script>
	</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>
