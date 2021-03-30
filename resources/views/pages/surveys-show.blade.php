@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ Route('dashboard') }}"><span class="oi oi-home"></span></a></li>
		<li class="breadcrumb-item"><a href="{{ Route('surveys') }}">{{ __('app.surveys') }}</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ $Survey->title }}</li>
	</ol>
</nav>

<h1>{{ $Survey->title }}</h1>

<hr class="my-4">

<div class="row">
	<div class="col col-sm-4 offset-sm-4">
		<p>{!! $Survey->description !!}</p>

		<hr>

		<form action="{{ Route('surveys.store') }}" method="post">
			@csrf
			<input type="hidden" name="_sid" value="{{ $Survey->id }}">

			@if( !$Questions->isEmpty() )
			@foreach( $Questions as $Q )
			<div class="card mb-3">
				<div class="card-header">
					{{ $loop->iteration }}. {{ $Q->question }}
				</div>
				<div class="card-body">
					<div class="row no-gutters row-cols-10">
					@for($fld = 1; $fld <= 10; $fld++)
						<div class="col text-center">
							<label class="" for="{{ $Q->code }}-{{ $fld }}">{{ $fld }}</label><br>
							<input type="radio" name="{{ $Q->code }}" value="{{ $fld }}" class="form-check-label" id="{{ $Q->code }}-{{ $fld }}" required>
						</div>
					@endfor
					</div>
				</div>
			</div>
			@endforeach
			@endif

			<div class="row">
				<div class="col">
					<button type="submit" class="btn btn-primary">{{ __('app.email_send') }}</button>
				</div>
			</div>

		</form>
	</div>
</div>

@endsection