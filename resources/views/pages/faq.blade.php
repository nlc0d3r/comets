@extends('layouts.app')

@section('content')

<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="{{ Route('dashboard') }}"><span class="oi oi-home"></span></a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ __('app.faq') }}</li>
	</ol>
</nav>

<h1>{{ __('app.faq') }}</h1>

<hr class="my-4">

<div class="accordion" id="FAQAcordion">
	@foreach($FAQ as $F)
	<div class="card mb-2">
		<div class="card-header p-0" id="heading{{ $F->id }}">
			<h2 class="mb-0">
				<button class="btn btn-light bg-transparent btn-lg btn-block text-left text-primary rounded-0 p-4" type="button" data-toggle="collapse" data-target="#collapse{{ $F->id }}" aria-expanded="@if($loop->first) true @else false @endif" aria-controls="collapse{{ $F->id }}">{{ $F->question }}?</button>
			</h2>
		</div>
		<div id="collapse{{ $F->id }}" class="collapse @if($loop->first) show @endif" aria-labelledby="heading{{ $F->id }}" data-parent="#FAQAcordion">
			<div class="card-body">{{ $F->answer }}</div>
		</div>
	</div>
	@endforeach
</div>

@endsection