$(function() {

	// DateTime picker https://xdsoft.net/jqplugins/datetimepicker/
	$.datetimepicker.setLocale('lv');
	$('#datetime-begins, #datetime-ends').datetimepicker({
		format:'Y-m-d H:i:s',
		dayOfWeekStart: 1,
		step: 5,
		minDate: 0,
	});

	$("#checkAllUsers").click(function(){
    	$('.userCheck').not(this).prop('checked', this.checked);
	});

	// Close modal
	$('#SelectRecipients').on('click', function(){
		let txtTo = $('#participants').val();
		let lstTo = '';

		$('.userCheck').each( function(){
			if ( $(this).prop("checked") == true){
				let id = $(this).attr("id");
				lstTo += $('#'+ id ).val() +',';
			}
		});

		$('#userSelectModal').modal('hide');
		$('#participants').val( lstTo + txtTo);
	});

});