$(function() {
		
	// WYSIWYG Editor
	$('#summernote').summernote({
		toolbar: [
			['align', ['paragraph']],
			['style', ['bold', 'italic', 'underline']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['para', ['ul', 'ol']],
			['insert', ['link']],
		]
	});

	$("#checkAllUsers").click(function(){
    	$('.userCheck').not(this).prop('checked', this.checked);
	});

	// Close modal
	$('#SelectRecipients').on('click', function(){
		let txtTo = $('#textTo').val();
		let lstTo = '';

		$('.userCheck').each( function(){
			if ( $(this).prop("checked") == true){
				let id = $(this).attr("id");
				lstTo += $('#'+ id ).val() +',';
			}
		});

		$('#userSelectModal').modal('hide');
		$('#to').val( lstTo + txtTo);
	});

});