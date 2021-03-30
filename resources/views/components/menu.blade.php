<nav class="navbar navbar-expand-md navbar-dark bg-primary shadow-sm">
	<div class="container-fluid">
		<a class="navbar-brand" href="{{ url('/') }}" title="{{ config('app.name', 'Laravel') }}">
			<img src="{{ asset('img/comets_50.png') }}" class="img-fluid" alt="{{ config('app.name', 'Laravel') }}">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<!-- Left Side Of Navbar -->
			<ul class="navbar-nav mr-auto">

			</ul>

			@php
				$topNavPub = [ 
					'dashboard' => 'mi_dashboard',
					'meetings' => 'mi_meetings',
					'emails' => 'mi_emails',
					'surveys' => 'mi_surveys',
					'chat' => 'mi_chat',
					'faq' => 'mi_faq',
				];
			@endphp

			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">
				<!-- Authentication Links -->
				@guest
					<li class="nav-item">
						<a class="nav-link" href="{{ route('login') }}"> {!! __('app.mi_login') !!}</a>
					</li>
					@if (Route::has('register'))
						<li class="nav-item">
							<a class="nav-link" href="{{ route('register') }}"><span class="oi oi-plus"></span> {{ __('app.register') }}</a>
						</li>
					@endif
				@else
					@foreach( $topNavPub as $k => $item )
					<li class="nav-item{{ request()->routeIs( $k ) ? ' active' : '' }}">
						<a class="nav-link" href="{{ route($k) }}">{!! trans('app.'. $item) !!}</a>
					</li>
					@endforeach
					<li class="nav-item dropdown">
						<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
							<x-user-card uid="{{ Auth::user()->id }}" type="text"/>
						</a>

						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="{{ route('profile') }}">{!! __('app.mi_profile') !!}</a>
							@if( Auth::user()->group == 'administrator' )
								<a class="dropdown-item" href="{{ route('users') }}">{!! __('app.mi_users') !!}</a>
								<a class="dropdown-item" href="{{ route('surveysadmin') }}">{!! __('app.mi_surveys') !!}</a>
							@endif
							<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{!! __('app.mi_logout') !!}</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</div>
					</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>