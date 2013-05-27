$(document).ready(function() { //BEGIN READY  

	//The top item code block to change the properties of the parent.
	var headDateContainer = {
		container: $('.cal-head-date-container')
	};

	//Edit form container.
	var containerForEditForm = {
		container: $('.cal-edit-data-container')
	};

	//Div with ajax gif pic.
	var ajaxDiv = {
		gif: $('.cal-ajax-loadgif')
	};

	//Table tr elemtn's
	var tablesDate = {
		tr: $('.table-bordered > tbody > tr')
	};

	//Action button edit and delete
	var actionObj = {
		edit: $('.cal-edit-field-btn'),
		 del: $('.cal-del-field-btn'),
	};

	//Assigns styles hover. Gets the value of the database id
	actionObj.edit.click(function()	{
		actionObj.edit.parent().parent().removeClass('cal-table-body-active').addClass('cal-table-body');
		$(this).parent().parent().removeClass('cal-table-body').addClass('cal-table-body-active');
		ajaxDiv.gif.css({'display': 'block'});	
		$.ajax({
			type: "POST",
			url: "calendar/getEditField",
			async: true,
			data: {
				event_id: $(this).attr('event_id'),
			},
			success: function(values){
				ajaxDiv.gif.css({'display': 'none'});
				replaceContent(values, containerForEditForm.container);
			}
		});		
	});

	//Delete one event row
	actionObj.del.click(function() {		
		var choice = confirm('Это событие будет удалено!\nВы уверены?');
		if (choice) {	
			$.ajax({
				type: "POST",
				url: "calendar/delField",
				async: true,
				data: {
					event_id: $(this).attr('event_id'),
				},
				success: function(values){
					headDateContainer.container.parent().attr('flag', '1');
				}
			});
		} else {

		}
		
	});

	//Replacing content
	function replaceContent(contentStr, containerObj) {
		containerForEditForm.container.html('');
		containerForEditForm.container.html(contentStr);
	}

});

