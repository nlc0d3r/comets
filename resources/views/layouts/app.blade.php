<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- <meta http-equiv="Content-Security-Policy" content="default-src 'https:'; font-src 'none'; img-src 'self'; object-src 'none'; script-src 'self'; style-src 'self';"> -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>{{ config('app.name', 'Laravel') }}</title>
		
		<!-- Favicons -->
		<meta content="yes" name="apple-mobile-web-app-capable">
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
		<meta name="msapplication-TileImage" content="{{ asset('img/favicons/favicon-144.png') }}">
		<meta name="msapplication-TileColor" content="#2A2A2A">
		<meta name="application-name" content="Scotch Scotch scotch">
		<link rel="shortcut icon" sizes="16x16 24x24 32x32 48x48 64x64" href="{{ asset('favicon.ico') }}">
		<link rel="apple-touch-icon" sizes="16x16" href="{{ asset('img/favicons/favicon-16.png') }}">
		<link rel="apple-touch-icon" sizes="32x32" href="{{ asset('img/favicons/favicon-32.png') }}">
		<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicons/favicon-180.png') }}">
		<link rel="apple-touch-icon" sizes="192x192" href="{{ asset('img/favicons/favicon-192.png') }}">
		<link rel="apple-touch-icon" sizes="512x512" href="{{ asset('img/favicons/favicon-512.png') }}">

		<!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
		
		<!-- Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito">
		
		<!-- CSS -->
		<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/jquery.datetimepicker.css') }}">
		<link rel="stylesheet" href="{{ asset('css/summernote.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/chartist.min.css') }}">
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	</head>
	<body class="bg-dark text-light">

		@if ( Auth::check() && ( app('App\Helper\Core')->Mood( Auth::user()->id ) == false ) )
		<x-mood />
		@endif

		<div class="main" id="main">

			<x-menu />

			@if ( \Route::current()->getName() == 'main' )
			<div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img class="d-block w-100" src="{{ asset('img/main.jpg') }}">
						<div class="carousel-caption d-none d-md-block">
							<h5></h5>
							<p></p>
						</div>
					</div>
				</div>
			</div>
			@endif

			<div class="bg-light text-dark shadow-lg">
				<div class="container-fluid p-4">

					@if( session('msg') )
					<div class="alert alert-{{ session('msgtype') }} alert-dismissible fade show" role="alert">
						{{ session('msgtxt') }}
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					@endif
					
					<div class="row">
						<div class="col col-12">

							@if ( Auth::check() && !auth()->user()->email_verified_at )
							<div class="alert alert-success" role="alert">
								<h4 class="alert-heading">{{ __('app.ev_notify_title') }}</h4>
								<p>{{ __('app.ev_notify_body') }}</p>
								<hr>
								<form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
									@csrf
									<button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('app.ev_notify_verifyb_btn') }}</button>.
								</form>
							</div>
							@endif

							@yield('content')

						</div>
					</div>

					<div class="row justify-content-end mt-4">
						<div class="col text-right">
							<button type="button" class="btn btn-light" id="ScrollToTop" title="{{ __('app.up_title') }}"><span class="oi oi-chevron-top"></span> {{ __('app.up') }}</button>
						</div>
					</div>

				</div>
			</div>

			<footer>
				<div class="container-fluid p-4 text-center">
					<p>{!! trans('app.copyright') !!}</p>
				</div>
			</footer>

		</div>

		<script crossorigin="anonymous" integrity="ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
		<script crossorigin="anonymous" integrity="j9f7+ua7sfVeO2ROHj0uJC87NxQzCRq1kDKTRJkOolEllp1g55Npd6gWJJVkmxhM" src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>
		<script crossorigin="anonymous" integrity="tBLz28MeJJUXRcXrlNxPzl9V3iBhZz2buE5K37XPFyxvSyt5VgEv9wU6rzrzhsom" src="{{ asset('js/summernote.min.js') }}"></script>
		<script crossorigin="anonymous" integrity="ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
		<script crossorigin="anonymous" integrity="bf6CtCfLXLDSLve8PkWwKSMdpwsiwVijot4kH/wDChhARuTElQyXxF6Ki9fa9oE2" src="{{ asset('js/chartist.min.js') }}"></script>
		<script crossorigin="anonymous" integrity="XbrecP22qZ1GE1miuQRX+qeHPnU9/H5hNXyV9vGhkwyB3JkBXzp8798HISYbJEDI" src="{{ asset('js/main.js') }}"></script>

		@if ( \Route::current()->getName() == 'dashboard' )
		<script crossorigin="anonymous" integrity="XbrecP22qZ1GE1miuQRX+qeHPnU9/H5hNXyV9vGhkwyB3JkBXzp8798HISYbJEDI" src="{{ asset('js/pages/dasboard.js') }}"></script>
		@endif
		@if ( ( \Route::current()->getName() == 'emails' ) || ( \Route::current()->getName() == 'emails.show' ) )
		<script crossorigin="anonymous" integrity="XbrecP22qZ1GE1miuQRX+qeHPnU9/H5hNXyV9vGhkwyB3JkBXzp8798HISYbJEDI" src="{{ asset('js/pages/emails.js') }}"></script>
		@endif
		@if ( ( \Route::current()->getName() == 'meetings' ) || ( \Route::current()->getName() == 'meetings.show' ) )
		<script crossorigin="anonymous" integrity="XbrecP22qZ1GE1miuQRX+qeHPnU9/H5hNXyV9vGhkwyB3JkBXzp8798HISYbJEDI" src="{{ asset('js/pages/meeting.js') }}"></script>
		@endif
		@if ( \Route::current()->getName() == 'chat' )
		<script crossorigin="anonymous" integrity="XbrecP22qZ1GE1miuQRX+qeHPnU9/H5hNXyV9vGhkwyB3JkBXzp8798HISYbJEDI" src="{{ asset('js/pages/chat.js') }}"></script>
		@endif

	</body>
</html>