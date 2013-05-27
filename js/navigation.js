$(document).ready(function() { //BEGIN READY 
	//Object initialization
	//Week controlls
	var weekNav = {
		getPrevWeek: $('#get-prev-week'),
		getNextWeek: $('#get-next-week'),
		getNowWeek: $('#get-now-week'),
		getPrevWeekTitle: $('#get-prev-week-title'),
		getNextWeekTitle: $('#get-next-week-title'),
		getNowWeekTitle: $('#get-now-title')
	};
	//Main container for partian rendering
	var calContainer = {
		container: $('.CalendarWidgetContainer')		
	};
	//Message box obj
	var calMessageBox = {
		box: $('.cal-message-box')
	};
	//Day btn obj
	var day = {
		thisDay: $('.cal-day')
	};
	//Add new event form
	var addForm =  {
		inputTitle: $('#cal-input-title'),
		selectType: $('#cal-select-type'),
		inputDate: $('#cal-input-date'),
		selectUser: $('#cal-select-user'),
		textareaText: $('#cal-textarea-text'),
		submitFormBtn: $('#cal-addNew-submit'),
		addNewFrom: $('#cal-addNew-form')

	};
	//Data table obj
	var resizeTableObj = {
		dateTable: $('.cal-table-event')
	};

	//Call resize function with window resize
	$(window).resize(function() {			
  		resizeTable();
	});

	//When script will started, function call himself
	resizeTable();

	//Function resize table
	function resizeTable() {
		var body = $('.cal-calendar').css('width');
		var form = addForm.addNewFrom.css('width');
		var table = resizeTableObj.dateTable;
		body = parseInt(body);
		form = parseInt(form);		
		table.css({'width': ((body - form) - 30)+'px'});
	}

	addForm.inputDate.datepicker({ dateFormat: 'dd/mm/yy' });

	// Add new event
	addForm.addNewFrom.submit(function() {
		var postCheck = {
			title: checkAddNewForm(addForm.inputTitle.val(), 'title'),
			date: checkAddNewForm(addForm.inputDate.val() , 'date'),
			text: checkAddNewForm(addForm.textareaText.val() , 'text')
		}
		if (postCheck.title == true) {
			if (postCheck.date == true) {
				if (postCheck.text == true) {
					$.ajax({
						type: "POST",
						url: "calendar/addNew",
						async: false,
						data: {
							new_title: addForm.inputTitle.val(),
							new_type: addForm.selectType.val(),
							new_date: addForm.inputDate.val(),
							new_user: addForm.selectUser.val(),
							new_message: addForm.textareaText.val()				
						},			
						success: function(values){
							alert(values);
							alert('Событие: '+postObj.title+', добавленно!');
						}
					});	
				} else {
					alert(postCheck.text);
					addForm.textareaText.focus();
					return false;
				}
			} else {
				alert(postCheck.date);
				addForm.inputDate.focus();
				return false;
			}
		} else {
			alert(postCheck.title);
			addForm.inputTitle.focus();
			return false;
		}		
	});

	//Collect the data to generation prev week period and timelines
	weekNav.getPrevWeek.click(function () {
		$.ajax({
			type: "POST",
			url: "calendar/PrevWeek",
			async: true,
			data: {
				lastWeek: weekNav.getPrevWeekTitle.attr('deaposon')
			},
			success: function(values){
				replaceContent(values, calContainer.container);
			}
		})
	});
	//Collect the data to generation next week period and timelines
	weekNav.getNextWeek.click(function () {
		$.ajax({
			type: "POST",
			url: "calendar/NextWeek",
			async: true,
			data: {
				nextWeek: weekNav.getNextWeekTitle.attr('deaposon')
			},
			success: function(values){
				replaceContent(values, calContainer.container);
			}
		});
	});
	//Collect the data to generation courent week period and timelines
	weekNav.getNowWeek.click(function () {
		$.ajax({
			type: "POST",
			url: "calendar/NowWeek",
			async: true,
			data: {
				nextWeek: weekNav.getNowWeekTitle.attr('year')
			},
			success: function(values){
				replaceContent(values, calContainer.container);
			}
		});
	});
	//Event triggered when hover on the date btn
	day.thisDay.mousemove(function(e) {
		var eventCount = $(this).attr('event-count'); //Event count	
		var position = getMousePosition(e); //Mouse position X and Y
		var eventMessage = getConjugateWord(eventCount); //Conjugate message text
		calMessageBox.box.html(eventMessage+'<br><div class="cal-mesBox-angle"></div>');
		var newX = (position.Xx - (calMessageBox.box.width() / 2)) + 5; 
		var newY = position.Yy - (calMessageBox.box.height() + 20);
		calMessageBox.box.css({'display': 'block'});
		calMessageBox.box.css({'left': newX+'px', 'top': newY+'px'});

	});

	//Hide message box
	day.thisDay.mouseleave(function() {
		calMessageBox.box.css({'display': 'none'});
	});

	//Add hoer class for day btn
	day.thisDay.click(function() {
		$.each(day.thisDay, function(key, valeu) {
			if ($(this).hasClass('active-day-on')) {
				$(this).removeClass('active-day-on');
			}
		});
		$(this).addClass('active-day-on');
		replaceContent('', resizeTableObj.dateTable);
		GetEvents($(this));
	});	

	//Simple validate 'Add new' field: return bool or string
	function checkAddNewForm(checkVal, fieldType) {
		switch(fieldType) {
			case 'title': {
				if (checkVal != '' && checkVal != null) {
					if (checkVal.length <= 150) {
						return true;
					} else {
						return 'Заголовок не может быть больше 150 символов!';
					}
				} else {
					return 'Заголовок не может быть пустым!';					
				}
			}
			case 'date': {
				if (checkVal != '' && checkVal != null) {
					return true;
				} else {
					return 'Дата не может быть пустой!';					
				}
			}
			case 'text': {
				if (checkVal != '' && checkVal != null) {
					if (checkVal.length <= 140) {
						return true;
					} else {
						return 'Текст не может быть больше 140 символов!';
					}
				} else {
					return 'Заголовок не может быть пустым!';					
				}
			}
		}
	}

	//Replace content
	function replaceContent(contentStr, containerObj) {
		containerObj.html('');
		containerObj.html(contentStr);
	}

	//Get mouse X and Y position
	function getMousePosition(event) {
		var e = event || window.event;
		var coordinat = {
			Xx: e.pageX,
			Yy: e.pageY
		};
		return coordinat;
	}

	//Conjugate message word
	function getConjugateWord(numberMix) {
		var number = parseInt(numberMix.substr(-2));
		var message = 'У вас нет событий';
		if (number > 10 && number < 15) {
			message = 'У вас '+numberMix+' событев';
		} else {
			number = parseInt(numberMix.substr(-1));

			if (number <= 0) {
				message = 'У вас нет событий';
			} else if (number == 1) {
				message = 'У вас '+numberMix+' событие';
			} else if (number > 1 && number <= 4) {
				message = 'У вас '+numberMix+' события';
			} else if (number > 5) {
				message = 'У вас '+numberMix+' событий';
			}
		}	

		return message;
	}

	function updateWeek() {
		$.ajax({
			type: "POST",
			url: "calendar/NowWeek",
			async: true,
			data: {
				nextWeek: weekNav.getNowWeekTitle.attr('year')
			},
			success: function(values){
				replaceContent(values, calContainer.container);
			}
		});
	}
	
	function dayScanner() {		
		$.each(day.thisDay, function(key, valeu) {
			if ($(this).hasClass('active-day-on')) {
				GetEvents($(this));
			}
		});
	}

	function GetEvents(BtnObj) {
		thisDayStamp = BtnObj;
		if (BtnObj.attr('event-count') == 0) {
			addForm.inputTitle.focus();
			return true;
		}
		$.ajax({
			type: "POST",
			url: "calendar/GetEvents",
			async: true,
			data: {
				stamp: thisDayStamp.attr('stamp')			
			},			
			success: function(values){
				replaceContent(values, resizeTableObj.dateTable);
			}
		});
	}

	var thisDayStamp = '';
	setInterval(function(){	
		if (resizeTableObj.dateTable.attr('flag') != 0) {
			GetEvents(thisDayStamp);
			resizeTableObj.dateTable.attr('flag', '0');
		} else {
			
		}
	}, 100);		

	dayScanner();

});