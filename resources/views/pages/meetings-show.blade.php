@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ Route('dashboard') }}"><span class="oi oi-home"></span></a></li>
		<li class="breadcrumb-item"><a href="{{ Route('meetings') }}">{{ __('app.meetings') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ $Meeting->subject }}</li>
	</ol>
</nav>

<h1>{{ $Meeting->subject }}</h1>

<hr class="my-4">

<x-user-select-popup users="{{ $Users }}" />

<form action="{{ route('meetings.update', $Meeting->id) }}" method="post">
	{{ method_field('PUT') }}
	@csrf
	<div class="form-group">
		<label for="subject">{{ __('app.mtng_subject') }}</label>
		<input type="text" name="subject" id="subject" class="form-control" value="{{ $Meeting->subject }}">
	</div>
	<div class="form-group">
		<label for="datetime">{{ __('app.mtng_datetime') }}</label>
		<div class="row">
			<div class="col cols-sm-6">
				<input type="text" name="begins" id="datetime-begins" class="form-control" placeholder="{{ __('app.mtng_begins') }}" value="{{ $Meeting->begins }}">
			</div>
			<div class="col cols-sm-6">
				<input type="text" name="ends" id="datetime-ends" class="form-control" placeholder="{{ __('app.mtng_ends') }}" value="{{ $Meeting->ends }}">
			</div>
		</div>
	</div>
	<div class="form-group">
		<label for="location">{{ __('app.mtng_location') }}</label>
		<div class="input-group">
			<div class="input-group-prepend">
				<div class="input-group-text" title="{{ __('app.email_format') }}"><span class="oi oi-link-intact"></span></div>
			</div>
			<input type="text" name="link" id="location" class="form-control" value="{{ $Meeting->link }}">
		</div>
	</div>
	<div class="form-group">
		<label for="participants">{{ __('app.prf_participants') }}</label>
		<button type="button" class="btn btn-outline-primary btn-block mb-2" data-toggle="modal" data-target="#userSelectModal">{{ __('app.email_receivers') }}</button>
		<textarea name="participants" id="participants" class="form-control">{{ $Meeting->participants }}</textarea>
	</div>
	<div class="form-group">
		<label for="participants">{{ __('app.prf_description') }}</label>
		<textarea name="description" id="description" class="form-control">{{ $Meeting->description }}</textarea>
	</div>
	<button type="submit" class="btn btn-primary">{{ __('app.btn_save') }}</button>
</form>

@endsection