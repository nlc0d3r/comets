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
					@php $surveyData = \App\Http\Controllers\SurveysAdminController::answerDataSum( $userHash ) @endphp
					@if( $answers > 0 )
					<div class="list-group-item list-group-item-action list-group-item-light">
						<div class="d-flex w-100 justify-content-between">
							<div style="width:50px;">{{ $loop->iteration }}</div>
							<div class="pyData"><small>REC:</small> <b>{{ round($surveyData[0]->REC, 2) }}</b></div>
							<div class="pyData"><small>WRK:</small> <b>{{ round($surveyData[0]->WRK, 2) }}</b></div>
							<div class="pyData"><small>ADV:</small> <b>{{ round($surveyData[0]->ADV, 2) }}</b></div>
							<div class="pyData"><small>GTH:</small> <b>{{ round($surveyData[0]->GTH, 2) }}</b></div>
							<div class="pyData"><small>GFO:</small> <b>{{ round($surveyData[0]->GFO, 2) }}</b></div>
							<div class="pyData"><small>MIS:</small> <b>{{ round($surveyData[0]->MIS, 2) }}</b></div>
							<div class="pyData"><small>SMG:</small> <b>{{ round($surveyData[0]->SMG, 2) }}</b></div>
							<div class="pyData"><small>SPV:</small> <b>{{ round($surveyData[0]->SPV, 2) }}</b></div>
							<div class="pyData"><small>CWR:</small> <b>{{ round($surveyData[0]->CWR, 2) }}</b></div>
							<div class="pyData"><small>SAL:</small> <b>{{ round($surveyData[0]->SAL, 2) }}</b></div>
							<div class="pyData"><small>BEN:</small> <b>{{ round($surveyData[0]->BEN, 2) }}</b></div>
							<div class="pyData"><small>VAL:</small> <b>{{ round($surveyData[0]->VAL, 2) }}</b></div>
							<div class="pyData"><small>SAT:</small> <b>{{ round($surveyData[0]->SAT, 2) }}</b></div>
							<div class="pyData"><small>TRN:</small> <b>{{ round($surveyData[0]->TRN, 2) }}</b></div>
							<div title="{{ __('app.srv_xls') }}"><a href="{{ Route('surveycsv', [ 'user' => $userHash ] ) }}" target="_blank"><span class="oi oi-cloud-download"></span> {{ __('app.srv_xls_download') }}</a></div>
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