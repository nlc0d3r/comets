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

<div class="card">
	<div class="card-header text-white bg-secondary">{!! __('app.mi_surveys') !!}</div>
	<div class="card-body p-0">
		@if( !$Users->isEmpty() )
		<div class="list-group list-group-flush">
		@foreach( $Users as $U )
					<?php $userHash = hash( 'SHA256', $U->id ); ?>
					@php $answers = \App\Http\Controllers\SurveysAdminController::hasAnsvers( $userHash ) @endphp
					@php $surveyDate = \App\Http\Controllers\SurveysAdminController::getLastSurveyDate( $userHash ) @endphp
					@if( $answers > 0 )
					<div class="list-group-item list-group-item-action list-group-item-light">
						<div class="d-flex w-100 justify-content-between">
							<div style="width:50px;">{{ $loop->iteration }}</div>
							<div class="pyData">122</div>
							<div class="pyData">344</div>
							<div class="pyData">2442</div>
							<div title="{{ __('app.srv_xls') }}"><a href="{{ Route('surveycsv', [ 'user' => $userHash ] ) }}" target="_blank"><span class="oi oi-cloud-download"></span> {{ __('app.srv_xls_download') }}</a></div>
							<div title="{{ __('app.srv_pyxls') }}"><a href="#"><span class="oi oi-cloud-download"></span> {{ __('app.srv_xls_download') }}</a></div>
							<div title="{{ __('app.srv_last') }}">{{ $surveyDate }}</div>
						</div>
					</div>
					@endif
		@endforeach
		</div>
		@endif
	</div>
	<div class="card-footer p-0">
		{{ $Users->links() }}
	</div>
</div>

@endsection