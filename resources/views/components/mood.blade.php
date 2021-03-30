<div class="modal fade text-dark" id="moodmodal" tabindex="-1" role="dialog" aria-labelledby="moodmodalTitle" aria-hidden="false">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content p-3">
			<div class="modal-header text-center">
				<h5 class="modal-title" id="moodmodalTitle">{{ __('app.moodpu-title') }}</h5>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col col-sm-4"><a href="{{ Route('setmood') }}?m=negative"><img class="img-fluid" src="{{ asset('img/mood-negative.png') }}"></a></div>
					<div class="col col-sm-4"><a href="{{ Route('setmood') }}?m=neutral"><img class="img-fluid" src="{{ asset('img/mood-neutral.png') }}"></a></div>
					<div class="col col-sm-4"><a href="{{ Route('setmood') }}?m=positive"><img class="img-fluid" src="{{ asset('img/mood-positive.png') }}"></a></div>
				</div>
			</div>
		</div>
	</div>
</div>