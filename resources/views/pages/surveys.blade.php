@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ Route('dashboard') }}"><span class="oi oi-home"></span></a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ __('app.surveys') }}</li>
	</ol>
</nav>

<h1>{{ __('app.surveys') }}</h1>

<hr class="my-4">

<div class="row">
	<div class="col col-sm-3">
		<div class="card">
			<div class="card-header text-white bg-secondary">{!! __('app.srv_results') !!}</div>
			<div class="card-body p-0">
				@if( !$Answers->isEmpty() )
				@foreach( $Answers as $A )
				<a href="#" class="list-group-item list-group-item-action list-group-item-light">
				<div class="d-flex w-100 justify-content-between">
					<h5 class="mb-1">@php echo \App\Http\Controllers\SurveysController::getSurveyTitle( $A->sid ) @endphp</h5>
					<small>{{ $A->created_at }}</small>
				</div>
				</a>
				@endforeach
				@else
				<div class="list-group-item list-group-item-light">{{ __('app.srv_noresults') }}</div>
				@endif
			</div>
		</div>
	</div>
	<div class="col col-sm-9">
		<div class="list-group">
		@if( !$Surveys->isEmpty() )
		@foreach( $Surveys as $S )
			<a href="{{ Route('surveys.show', $S->id) }}" class="list-group-item list-group-item-action list-group-item-light">
				<div class="d-flex w-100 justify-content-between">
					<h5 class="mb-1">{{ $S->title }}</h5>
					<small>{{ $S->created_at }}</small>
				</div>
				<p class="mb-1">{!! $S->description !!}</p>
				<!-- <small>Donec id elit non mi porta.</small> -->
			</a>
		@endforeach
		@endif
		</div>
	</div>
</div>

@endsection