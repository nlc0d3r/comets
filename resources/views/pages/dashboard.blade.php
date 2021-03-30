@extends('layouts.app')

@section('content')

<h1>{{ __('app.dashboard') }}</h1>

<hr class="my-4">

<div class="card-columns p-0">

	<div class="card">
		<div class="card-header text-white bg-secondary">{!! __('app.mi_meetings') !!}</div>
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
								<button class="btn btn-sm btn-light text-left"><span class="oi oi-link-intact"></span> {{ $M->link }}</button>
							</form>
						</div>
					</div>
				</a>
			@endforeach
			</div>
			@endif
		</div>
	</div>

	<div class="card">
		<div class="card-header text-white bg-secondary">{!! __('app.mi_surveys') !!}</div>
		<div class="card-body p-0">
			@if( !$Surveys->isEmpty() )
			<div class="list-group list-group-flush">
			@foreach( $Surveys as $S ) 
				<a href="{{ Route('surveys.show', $S->id) }}" class="list-group-item list-group-item-action list-group-item-light">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">{{ $S->title }}</h5>
						<small>{{ $S->created_at }}</small>
					</div>
				</a>
			@endforeach
			</div>
			@endif
		</div>
	</div>

	<div class="card">
		<div class="card-header text-white bg-secondary">{!! __('app.mi_emails') !!}</div>
		<div class="card-body p-0">
			@if( !$Emails->isEmpty() )
			<div class="list-group list-group-flush">
			@foreach( $Emails as $E ) 
				<a href="{{ Route('emails.show', $E->id) }}" class="list-group-item list-group-item-action list-group-item-light">
					<div class="d-flex w-100 justify-content-between">
						<h5 class="mb-1">{{ $E->subject }}</h5>
						<small>{{ $S->created_at }}</small>
					</div>
					<p class="mb-1">{{ __('app.email_to') }}:  @php echo \App\Http\Controllers\EmailsController::showToEmails( $E->to ) @endphp</p>
					<div class="row">
						<div class="col col-sm-3" title="{{ __('app.email_status') }}">
							@if( $E->status == 'sent' )
							<span class="oi oi-arrow-circle-right"></span> {{ __('app.email_status_sent') }}
							@else
							<span class="oi oi-document"></span> {{ __('app.email_status_draft') }}
							@endif
						</div>
						<div class="col col-sm-3" title="{{ __('app.email_attachment') }}">
							@if( $E->attachment )
							<span class="oi oi-paperclip"></span>
							@endif
						</div>
						<div class="col col-sm-3" title="{{ __('app.email_priority') }}"><small>{{ $E->priority }}</small></div>
						<div class="col col-sm-3" title="{{ __('app.email_type') }}"><small>{{ $E->type }}</small></div>
					</div>
				</a>
			@endforeach
			</div>
			@endif
		</div>
	</div>

	@if( Auth::user()->group == 'administrator' )
	<div class="card text-white bg-dark">
		<div class="card-header">
			<div class="d-flex">
				<div><span class="oi oi-heart"></span> {{ __('app.mood_title') }}</div>
				<div class="ml-auto">
					@if( $Comparison->status == 'up' )
					<span class="text-success"><span class="oi oi-arrow-circle-top"></span> {{ $Comparison->comp }}</span>
					@else
					<span class="text-danger"><span class="oi oi-arrow-circle-bottom"></span> {{ $Comparison->comp }}</span>
					@endif
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col text-left">
					<button type="button" class="btn p-1" data-container="body" data-toggle="popover" data-placement="top" data-content="{{ __('app.mood_po_negative') }}">
						<img src="{{ asset('img/mood-negative.png') }}" width="24" height="24" class="m-1">
					</button>
				</div>
				<div class="col text-center">
					<button type="button" class="btn p-1" data-container="body" data-toggle="popover" data-placement="top" data-content="{{ __('app.mood_po_neutral') }}">
						<img src="{{ asset('img/mood-neutral.png') }}" width="24" height="24" class="m-1">
					</button>
				</div>
				<div class="col text-right">
					<button type="button" class="btn p-1" data-container="body" data-toggle="popover" data-placement="top" data-content="{{ __('app.mood_po_positive') }}">
						<img src="{{ asset('img/mood-positive.png') }}" width="24" height="24" class="m-1">
					</button>
				</div>
			</div>
			<div class="progress">
				<div class="progress-bar progress-bar-striped bg-{{ $Mood->color }}" role="progressbar" style="width: {{ $Mood->sum }}%" aria-valuenow="{{ $Mood->sum }}" aria-valuemin="0" aria-valuemax="100"></div>
			</div>

			<div class="row no-gutters mt-1">
				<div class="col col-sm-6">
					<div class="row no-gutters">
						<div class="col col-sm-1 pt-1 pr-2">
							<div class="progress">
								<div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col col-sm-11">0 - {{ $Mood->lvlLow }}</div>
					</div>
					<div class="row no-gutters">
						<div class="col col-sm-1 pt-1 pr-2">
							<div class="progress">
								<div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
						</div>
						<div class="col col-sm-11">{{ $Mood->lvlLow }} - {{ $Mood->lvlMid }}</div>
					</div>
					<div class="row no-gutters">
						<div class="col col-sm-1 pt-1 pr-2">
							<div class="progress">
								<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
							</div>	
						</div>
						<div class="col col-sm-11">{{ $Mood->lvlMid }} - 100</div>
					</div>
				</div>
				<div class="col col-sm-6">
					<div class="row no-gutters">
						<div class="col col-sm-8 pr-1 text-right"><small>{{ __('app.mood_participants') }}:</small></div>
						<div class="col col-sm-4"><small>{{ $Mood->count }}</small></div>
					</div>
					<div class="row no-gutters">
						<div class="col col-sm-8 pr-1 text-right"><small>{{ __('app.mood_percent') }}:</small></div>
						<div class="col col-sm-4"><small>{{ $Mood->percent }}%</small></div>
					</div>
					<div class="row no-gutters">
						<div class="col col-sm-8 pr-1 text-right"><small></small></div>
						<div class="col col-sm-4"><small></small></div>
					</div>
				</div>
			</div>
			<div class="row no-gutters mt-1">
				<div class="col col-sm-12">
					<script>
						let moodData = {!! $moodGraph !!}; 
					</script>
					<div class="ct-Chart ct-perfect-fourth" id="moodChart"></div>
				</div>
			</div>
		</div>
	</div>
	@endif

	@if( Auth::user()->group == 'administrator' )
	<div class="card text-white bg-dark">
		<div class="card-header">{!! __('app.mi_survey_answers') !!}</div>
		<div class="card-body">
		@if( $AnswersCount > 0 )
			<div class="row no-gutters">
				<div class="col col-sm-10 text-right pr-2">{{ __('app.srv_satisfaction') }}</div>
				<div class="col col-sm-2">{{ round( $Answers[0]->SATISFACTION, 2 ) }}</div>
			</div>
			<div class="row no-gutters">
				<div class="col col-sm-10 text-right pr-2">{{ __('app.srv_filled') }}</div>
				<div class="col col-sm-2">{{ $AnswersCount }}</div>
			</div>
			<div class="row no-gutters mt-1">
				<div class="col col-sm-12">
					<script>
						let answersData = {!! $answersGraph !!}; 
					</script>
					<div class="ct-Chart ct-perfect-fourth" id="answersChart"></div>
				</div>
			</div>
		@else
			{{ __('app.srv_noresults') }}
		@endif
		</div>
	</div>
	@endif

</div>

@endsection