@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ Route('dashboard') }}"><span class="oi oi-home"></span></a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ __('app.profile') }}</li>
	</ol>
</nav>

<h1>{{ __('app.profile') }}</h1>

<hr class="my-4">

@if ( $errors->any() )
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card-columns">
	<div class="card bg-dark text-light">
		<div class="card-header"><span class="oi oi-person"></span> {{ __('app.prf_title') }}</div>
		<div class="card-body">
			<x-user-card uid="{{ Auth::user()->id }}" type="detailed"/>
		</div>
		<div class="card-body bg-light text-dark">
			<form method="post" action="{{ route('profileu', Auth::user()->id ) }}" enctype="multipart/form-data">
				@csrf
				<div class="row">
					<div class="col col-sm-6 form-group">
						<label for="name">{{ __('app.prf_name') }}</label>
						<input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
					</div>
					<div class="col col-sm-6 form-group">
						<label for="surname">{{ __('app.prf_surname') }}</label>
						<input type="text" name="surname" id="surname" class="form-control" value="{{ $user->surname }}">
					</div>
				</div>
				<div class="form-group">
					<label for="email">{{ __('app.prf_email') }}</label>
					<input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
				</div>
				<div class="form-group">
					<label for="email">{{ __('app.prf_avatar') }}</label>
					<input type="file" name="avatar" id="avatar" class="form-control" accept=".png,.jpg">
				</div>
				<div class="form-group">
					<label for="group">{{ __('app.prf_group') }}</label>
					<input type="text" name="group" id="group" class="form-control" value="{{ __('app.prf_g_'. $user->group) }}" disabled>
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>	
		</div>
	</div>
	@if( $boss != null )
	<div class="card">
		<div class="card-header"><span class="oi oi-person"></span> {{ __('app.prf_boss') }}</div>
		<div class="card-body">
			<x-user-card uid="{{ $boss->id }}" type="detailed"/>
		</div>
	</div>
	@endif
	@if( !$sub->isEmpty() )
	<div class="card">
		<div class="card-header"><span class="oi oi-people"></span> {{ __('app.prf_subordinates') }}</div>
		<div class="card-body">
			@foreach( $sub as $S )
			<x-user-card uid="{{ $S->id }}" type="detailed"/>
			@endforeach
		</div>
	</div>
	@endif
	<div class="card">
		<div class="card-header">cita infa</div>
		<div class="card-body">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea exercitationem accusamus officiis natus aut adipisci hic reprehenderit aspernatur ratione corrupti neque, enim! Mollitia incidunt omnis, totam perspiciatis temporibus soluta, qui.</p>
		</div>
	</div>
</div>

@endsection