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
	//Collect the data to generation prev week period and timelines
	weekNav.getPrevWeek.click(function () {
		$.ajax({
			type: "POST",
			url: "calendar/PrevWeek",
			async: true,
			data: {
				lastWeek: weekNav.getPrevWeekTitle.attr('deaposon'),
			},
			success: function(values){
				replaceContant(values, calContainer.container);
			}
		});
	});
	//Collect the data to generation next week period and timelines
	weekNav.getNextWeek.click(function () {
		$.ajax({
			type: "POST",
			url: "calendar/NextWeek",
			async: true,
			data: {
				nextWeek: weekNav.getNextWeekTitle.attr('deaposon'),
			},
			success: function(values){
				replaceContant(values, calContainer.container);
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
				nextWeek: weekNav.getNowWeekTitle.attr('year'),
			},
			success: function(values){
				replaceContant(values, calContainer.container);
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

	day.thisDay.mouseleave(function() {
		calMessageBox.box.css({'display': 'none'});
	});

	function replaceContant(contantStr, containerObj) {
		containerObj.html(contantStr);
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
	
});