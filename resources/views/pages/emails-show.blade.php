@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ Route('dashboard') }}"><span class="oi oi-home"></span></a></li>
		<li class="breadcrumb-item"><a href="{{ Route('emails') }}">{{ __('app.emails') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ $Email->subject }}</li>
	</ol>
</nav>

<h1>{{ $Email->subject }}</h1>

<hr class="my-4">

<x-user-select-popup users="{{ $Users }}" />

<div class="row">
	<div class="col col-sm-12">
		<form action="{{ Route('emails.update', $Email->id ) }}" method="post" enctype="multipart/form-data">
			{{ method_field('PUT') }}
			@csrf
			<div class="form-row">
				<div class="form-group col-sm-3">
					<button type="button" class="btn btn-outline-primary btn-block" data-toggle="modal" data-target="#userSelectModal">{{ __('app.email_receivers') }}</button>
				</div>
				<div class="form-group col-sm-4">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text" title="{{ __('app.email_priority') }}"><span class="oi oi-flag"></span></div>
						</div>
						<select name="priority" class="custom-select">
							<option value="high"@if( $Email->priority == 'high') selected @endif>{{ __('app.email_priority_high') }}</option>
							<option value="normal"@if( $Email->priority == 'normal') selected @endif>{{ __('app.email_priority_normal') }}</option>
							<option value="low"@if( $Email->priority == 'low') selected @endif>{{ __('app.email_priority_low') }}</option>
						</select>
					</div>
				</div>
				<div class="form-group col-sm-5">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text" title="{{ __('app.email_format') }}"><span class="oi oi-flag"></span></div>
						</div>
						<select name="format" class="custom-select">
							<option value="formal" @if( $Email->format == 'formal') selected @endif >{{ __('app.email_content_formal') }}</option>
							<option value="casual" @if( $Email->format == 'casual') selected @endif >{{ __('app.email_content_casual') }}</option>
						</select>
					</div>
				</div>
			</div>
			<div class="formrm-row">
				<div class="form-group">
					<textarea name="to" id="to" class="form-control" placeholder="{{ __('app.email_receivers') }}">@php echo \App\Http\Controllers\EmailsController::showToEmails( $Email->to ) @endphp</textarea>
				</div>
			</div> 
			<div class="formrm-row">
				<div class="form-group">
					<input type="text" name="subject" id="subject" class="form-control" placeholder="{{ __('app.email_subject') }}" value="{{ $Email->subject }}">
				</div>
			</div>
			<div class="formrm-row">
				<div class="form-group">
					<textarea name="body" id="summernote" class="form-control">{{ $Email->body }}</textarea>
				</div>
			</div>
			<div class="formrm-row">
				<div class="form-group">
					<input type="file" name="attachment" class="form-control" placeholder="{{ __('app.email_attachment') }}">
				</div>
			</div>
			@if( $Email->attachment )
			<h5>{{ __('app.email_attachment') }}</h5><hr>
			<div class="formrm-row">
				@php $file = substr( $Email->attachment, -3, 3 ); @endphp

				<div class="attachmentThumbnail" onclick="openlink('{{ asset('storage/'. $Email->attachment ) }}')">
					<div class="layerFocus">
						<h5>{{ $Email->attachmentname }}</h5>
						<div class="icons">
							<a href="{{ asset('storage/'. $Email->attachment ) }}" download><span class="oi oi-cloud-download"></span></a>
						</div>
					</div>
					@if( ( $file == 'jpg' ) || ( $file == 'png' ) )
						<div class="layerBg" style="background-image: url({{ asset('storage/'. $Email->attachment ) }});"></div>
					@else
						<div class="layerBg" style="background-image: url({{ asset( 'img/bg.png' ) }});"></div>
					@endif
				</div>
			</div>
			@endif
			<div class="formrm-row mt-3">
				<input type="submit" name="sendMail" class="btn btn-primary" value="{{ __('app.email_send') }}">
				<input type="submit" name="saveMail" class="btn btn-secondary" value="{{ __('app.email_save') }}">
			</div>
		</form>
	</div>
</div>

@endsection