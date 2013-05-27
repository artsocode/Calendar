$(document).ready(function() { //BEGIN READY 
	//Save form link 
	var editFrom = {
		 form: $('#cal-edit-form').parent().parent(),
		title: $('#cal-edit-input-title'),
		 type: $('#cal-edit-select-type'),
		 date: $('#cal-edit-input-date'),
		 user: $('#cal-edit-select-user'),
		 text: $('#cal-edit-textarea-text'),
		 save: $('#cal-edit-button-save')
	};

	$("#cal-edit-input-date").datepicker({ dateFormat: 'dd/mm/yy' });

	//Saving...
	editFrom.save.click(function() {
		$.ajax({
			type: "POST",
			url: "calendar/SaveTheChange",
			async: true,
			data: {
				title: editFrom.title.val(),
				 type: editFrom.type.val(),
				 date: editFrom.date.val(),
				 user: editFrom.user.val(),
				 text: editFrom.text.val(),
				   id: editFrom.save.attr('event_id') 
			},
			success: function(values){
				editFrom.form.attr('flag', '1');
			}
		});
		
	});
	
});

