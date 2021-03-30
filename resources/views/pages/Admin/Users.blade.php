@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ Route('dashboard') }}"><span class="oi oi-home"></span></a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ __('app.users') }}</li>
	</ol>
</nav>

<h1>{{ __('app.users') }}</h1>

<div class="row">
	<div class="col col-md-3">
		<div class="card">
			<div class="card-header">{{ __('app.usr_title') }}</div>
			<div class="card-body">
				<form method="POST" action="{{ route('users') }}">
					@csrf
					<div class="form-group">
						<label for="subject">{{ __('app.prf_name') }}</label>
						<input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="{{ __('app.prf_name') }}">
					</div>
					<div class="form-group">
						<label for="subject">{{ __('app.prf_surname') }}</label>
						<input type="text" name="surname" id="surname" class="form-control @error('surname') is-invalid @enderror" value="{{ old('surname') }}" placeholder="{{ __('app.prf_surname') }}">
					</div>
					<div class="form-group">
						<label for="subject">{{ __('app.prf_email') }}</label>
						<input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="{{ __('app.prf_email') }}">
					</div>
					<div class="form-group">
						<label for="subject">{{ __('app.password') }}</label>
						<input type="password" name="password" id="password" class="form-control" placeholder="{{ __('app.password') }}">
					</div>
					<div class="form-group">
						<label for="subject">{{ __('app.confirmpassword') }}</label>
						<input type="password" name="password-confirm" id="password-confirm" class="form-control" placeholder="{{ __('app.confirmpassword') }}">
					</div>
					<button type="submit" class="btn btn-primary">{{ __('app.btn_add') }}</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col col-md-9">
		<div class="card">
			<div class="card-header text-white bg-secondary">{!! __('app.mi_users') !!}</div>
			<div class="card-body p-0">
				@if( !$Users->isEmpty() )
				<div class="list-group list-group-flush">
				@foreach( $Users as $U )
					<div class="list-group-item list-group-item-action list-group-item-light">
						<div class="d-flex w-100 justify-content-between">
							<x-user-card uid="{{ $U->id }}" type="detailed"/>
							<small>{{ $U->created_at }}</small><br>
							<small title="{{ __('app.lastseen') }}"><span class="oi oi-eye"></span> {{ $U->last_seen_at }}</small>
						</div>
					</div>
				@endforeach
				</div>
				@endif
			</div>
			<div class="card-footer p-0">
				{{ $Users->links() }}
			</div>
		</div>
	</div>
</div>

@endsection