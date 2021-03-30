<?php

	$Users = json_decode( htmlspecialchars_decode( $users ) );

?>
<div class="modal fade" id="userSelectModal" tabindex="-1" role="dialog" aria-labelledby="userSelectModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="userSelectModalLabel">{{ __('app.email_receivers') }}</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<table class="table">
					<thead>
						<tr>
							<th><input type="checkbox" id="checkAllUsers"></th>
							<th>{{ __('app.prf_name') }} {{ __('app.prf_surname') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $Users as $U )
						<tr>
							<td><input type="checkbox" name="user[{{ $U->id }}]" class="userCheck" value="{{ $U->email }}" id="{{ $U->id }}"></td>
							<td>{{ $U->name }} {{ $U->surname }}</td>
						</tr>
						@endforeach
						<tr>
							<td colspan="2">
								<textarea name="other-receivers" class="form-control" aria-describedby="other-receivers" placeholder="{{ __('app.email_receivers') }}" id="textTo"></textarea>
								<small id="other-receivers" class="form-text text-muted">{{ __('app.email_receiversrules') }}</small>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" id="SelectRecipients" class="btn btn-primary">{{ __('app.btn_add') }}</button>
			</div>
		</div>
	</div>
</div>