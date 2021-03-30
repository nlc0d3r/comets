@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ Route('dashboard') }}"><span class="oi oi-home"></span></a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ __('app.chat') }}</li>
	</ol>
</nav>

<h1>{{ __('app.chat') }}</h1>

<hr class="my-4">

<div class="row">
	<div class="col col-md-3">
		<div class="card">
			<div class="card-header">{{ __('app.users') }}</div>
			<div class="card-body p-0">
				@if( !$Users->isEmpty() )
				<ul class="list-group list-group-flush">
				@foreach( $Users as $U )
					<li class="list-group-item list-group-item-action list-group-item-light chuserselect">
						<a href="{{ Route('chat', [ 'uid' => $U->id ] ) }}">
							<x-user-card uid="{{ $U->id }}" type="small"/>
						</a>
					</li>
				@endforeach
				</ul>
				@endif	
			</div>
		</div>
	</div>
	<div class="col col-md-4">
		<div class="card">
			<div class="card-header text-white bg-secondary">{!! __('app.chat') !!}</div>
			<div class="card-body p-0" style="overflow-y: scroll; max-height: 600px;">
				@if( !$Chat->isEmpty() )
				<ul class="list-group list-group-flush" id="chmessageboard">
					@foreach( $Chat as $C )
					@if( $C->from == Auth::user()->id )
					<li class="list-group-item p-1 border-0">
						<div class="d-flex flex-row-reverse">
							<div class="pl-2"><x-user-card uid="{{ $C->from }}" type="logoonly"/></div>
							<div class="chatmsg text-right bg-success text-light p-2">
								@php echo \App\Http\Controllers\ChatController::emoticons( $C->message ) @endphp<br>
								<small>{{ $C->datetime }}</small>
							</div>
						</div>
					</li>
					<div id=""></div>
					@else
					<li class="list-group-item p-1 border-0">
						<div class="d-flex">
							<div class="pr-2"><x-user-card uid="{{ $C->from }}" type="logoonly"/></div>
							<div class="chatmsg text-left bg-primary text-light p-2">
								@php echo \App\Http\Controllers\ChatController::emoticons( $C->message ) @endphp<br>
								<small>{{ $C->datetime }}</small>
							</div>
						</div>
					</li>
					@endif
					@endforeach
				</ul>
				@else
				<div class="alert alert-secondary" role="alert">
					{{ __('app.ch_emptymsg') }}
				</div>
				@endif
			</div>
			<div class="card-footer p-0">
				<form action="chat" method="post">
					@csrf
					<div class="form-row no-gut">
						<div class="form-group col-sm-12 mb-0">
							<div class="input-group">
								<input type="hidden" name="uid" value="{{ $uid }}">
								<input type="text" name="message" id="chatmessagefld" class="form-control form-control-lg" placeholder="{{ __('app.ch_mesgplacehold') }}" autocomplete="off">
								<div class="input-group-append">
									<div class="input-group-text p-0">
										<button type="button" class="btn btn-md" data-container="body" data-toggle="popover" data-placement="top" data-html="true" data-content="{{ $showAllEmojies }}">
											<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-emoji-smile" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
												<path fill-rule="evenodd" d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683z"/>
												<path d="M7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
											</svg>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection