@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ Route('dashboard') }}"><span class="oi oi-home"></span></a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ __('app.emails') }}</li>
	</ol>
</nav>

<h1>{{ __('app.emails') }}</h1>

<hr class="my-4">

<x-user-select-popup users="{{ $Users }}" />

<div class="row">
	<div class="col col-sm-4">
		<form action="emails" method="post" enctype="multipart/form-data">
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
							<option value="high">{{ __('app.email_priority_high') }}</option>
							<option value="normal" selected>{{ __('app.email_priority_normal') }}</option>
							<option value="low">{{ __('app.email_priority_low') }}</option>
						</select>
					</div>
				</div>
				<div class="form-group col-sm-5">
					<div class="input-group">
						<div class="input-group-prepend">
							<div class="input-group-text" title="{{ __('app.email_format') }}"><span class="oi oi-flag"></span></div>
						</div>
						<select name="format" class="custom-select">
							<option value="formal">{{ __('app.email_content_formal') }}</option>
							<option value="casual" selected>{{ __('app.email_content_casual') }}</option>
						</select>
					</div>
				</div>
			</div>
			<div class="formrm-row">
				<div class="form-group">
					<textarea name="to" id="to" class="form-control" placeholder="{{ __('app.email_receivers') }}"></textarea>
				</div>
			</div> 
			<div class="formrm-row">
				<div class="form-group">
					<input type="text" name="subject" id="subject" class="form-control" placeholder="{{ __('app.email_subject') }}">
				</div>
			</div>
			<div class="formrm-row">
				<div class="form-group">
					<textarea name="body" id="summernote" class="form-control"></textarea>
				</div>
			</div>
			<div class="formrm-row">
				<div class="form-group">
					<input type="file" name="attachment" id="attachment" class="form-control" placeholder="{{ __('app.email_attachment') }}">
				</div>
			</div>
			<div class="formrm-row">
				<input type="submit" name="sendMail" class="btn btn-primary" value="{{ __('app.email_send') }}">
				<input type="submit" name="saveMail" class="btn btn-secondary" value="{{ __('app.email_save') }}">
			</div>
		</form>
	</div>
	<div class="col col-sm-8">
		<div class="card">
			<div class="card-header text-white bg-secondary">{!! __('app.mi_emails') !!}</div>
			<div class="card-body p-0">
				@if( !$Emails->isEmpty() )
				<div class="list-group list-group-flush">
				@foreach( $Emails as $E ) 
					<a href="{{ Route('emails.show', $E->id) }}" class="list-group-item list-group-item-action list-group-item-light">
						<div class="d-flex w-100 justify-content-between">
							<h5 class="mb-1">
								{{ $E->subject }}
							</h5>
							<small>{{ $E->created_at }}</small>
						</div>
						<p class="mb-1">{{ __('app.email_to') }}: @php echo \App\Http\Controllers\EmailsController::showToEmails( $E->to ) @endphp</p>
						<div class="row">
							<div class="col col-sm-2" title="{{ __('app.email_status') }}">
								@if( $E->status == 'sent' )
								<span class="oi oi-arrow-circle-right"></span> {{ __('app.email_status_sent') }}
								@else
								<span class="oi oi-document"></span> {{ __('app.email_status_draft') }}
								@endif
							</div>
							<div class="col col-sm-1" title="{{ __('app.email_attachment') }}">
								@if( $E->attachment )<span class="oi oi-paperclip"></span>@endif
							</div>
							<div class="col col-sm-2" title="{{ __('app.email_priority') }}"><small>{{ __('app.email_priority_'. $E->priority ) }}</small></div>
							<div class="col col-sm-2" title="{{ __('app.email_type') }}"><small>{{ __('app.email_content_'. $E->format ) }}</small></div>
						</div>
					</a>
				@endforeach
				</div>
				@endif
			</div>
			<div class="card-footer p-0">
				{{ $Emails->links() }}
			</div>
		</div>
	</div>
</div>

@endsection