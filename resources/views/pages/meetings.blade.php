@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ Route('dashboard') }}"><span class="oi oi-home"></span></a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ __('app.meetings') }}</li>
	</ol>
</nav>

<h1>{{ __('app.meetings') }}</h1>

<hr class="my-4">

<x-user-select-popup users="{{ $Users }}" />

<div class="row">
	<div class="col col-md-3">
		<div class="card">
			<div class="card-header">{{ __('app.mtng_title') }}</div>
			<div class="card-body">
				<form action="meetings" method="post">
					@csrf
					<div class="form-group">
						<label for="subject">{{ __('app.mtng_subject') }}</label>
						<input type="text" name="subject" id="subject" class="form-control">
					</div>
					<div class="form-group">
						<label for="datetime">{{ __('app.mtng_datetime') }}</label>
						<div class="row">
							<div class="col cols-sm-6">
								<input type="text" name="begins" id="datetime-begins" class="form-control" placeholder="{{ __('app.mtng_begins') }}">
							</div>
							<div class="col cols-sm-6">
								<input type="text" name="ends" id="datetime-ends" class="form-control" placeholder="{{ __('app.mtng_ends') }}">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="location">{{ __('app.mtng_location') }}</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<div class="input-group-text" title="{{ __('app.email_format') }}"><span class="oi oi-link-intact"></span></div>
							</div>
							<input type="text" name="link" id="location" class="form-control">
						</div>
					</div>
					<div class="form-group">
						<label for="participants">{{ __('app.prf_participants') }}</label>
						<button type="button" class="btn btn-outline-primary btn-block mb-2" data-toggle="modal" data-target="#userSelectModal">{{ __('app.email_receivers') }}</button>
						<textarea name="participants" id="participants" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<label for="participants">{{ __('app.prf_description') }}</label>
						<textarea name="description" id="description" class="form-control"></textarea>
					</div>
					<button type="submit" class="btn btn-primary">{{ __('app.btn_add') }}</button>
				</form>
			</div>
		</div>
	</div>
	<div class="col col-md-9">
		<div class="card">
			<div class="card-header text-white bg-secondary">{!! __('app.mi_emails') !!}</div>
			<div class="card-body p-0">
				@if( !$Meetings->isEmpty() )
				<div class="list-group list-group-flush">
				@foreach( $Meetings as $M ) 
					<a href="{{ Route('meetings.show', $M->id) }}" class="list-group-item list-group-item-action list-group-item-light">
						<div class="d-flex w-100 justify-content-between">
							<h5 class="mb-1">{{ $M->subject }}</h5>
							<small>{{ $M->begins }}</small>
						</div>
						<p class="mb-1">{{ $M->description }}</p>
						<div class="row">
							<div class="col col-sm-12">
								<form action="{{ $M->link }}" target="_blank">
									<button class="btn btn-sm btn-light"><span class="oi oi-link-intact"></span> {{ $M->link }}</button>
								</form>
							</div>
						</div>
					</a>
				@endforeach
				</div>
				@endif
			</div>
			<div class="card-footer p-0">
				{{ $Meetings->links() }}
			</div>
		</div>
	</div>
</div>
@endsection