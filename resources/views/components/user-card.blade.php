@if( $USER->show ==true )
	@if( ( $TYPE == 'small' ) || ( $TYPE == 'detailed' ) )
	<div class="UserCard">
		<div class="row no-gutters">
			<div class="col col-sm-2" title="{{ __('app.last_seen') }} {{ $USER->lastSeen }}">
				@if( $USER->avatar )
				<img src="{{ asset( 'storage/'. $USER->avatar ) }}" class="rounded-circle" width="40" height="40">
				@else
				<div class="noavatar">{{ substr($USER->name, 0, 1) . substr($USER->surname, 0, 1) }}</div>
				@endif

				@if( $USER->online == true )
					<div class="onlineBadge bg-success"></div>
				@else
					<div class="onlineBadge bg-danger"></div>
				@endif
			</div>
			@if( ( $TYPE == 'small' ) || ( $TYPE == 'detailed' ) )
			<div class="col col-sm-10">
				<h3 class="m-0">{{ $USER->name }} {{ $USER->surname }}</h3>
				@if( $TYPE == 'detailed' )
				<small><a href="{{ $USER->mail }}"><span class="oi oi-envelope-closed"></span> {{ $USER->mail }}</a></small><br>
				<small><span class="oi oi-people"></span> {{ $USER->group }}</small>
				@endif
			</div>
			@endif
		</div>
	</div>
	@endif

	@if( $TYPE == 'logoonly' )
		@if( $USER->avatar )
		<img src="{{ asset( 'storage/'. $USER->avatar ) }}" class="rounded-circle" width="40" height="40">
		@else
		<div class="noavatar">{{ substr($USER->name, 0, 1) . substr($USER->surname, 0, 1) }}</div>
		@endif
	@endif

	@if( $TYPE == 'text' )
		<span class="oi oi-person"></span> {{ $USER->name }} {{ $USER->surname }}
	@endif

@endif