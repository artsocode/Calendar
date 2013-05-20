<?php
##
## This is are mine widget controller
## He need to manage are timeline through jquery
##

class CalendarController extends CController {

	public function actionPrevWeek() {
		$CalendarBrain = CalendarBrain::getInstance(); //Singleton class
		$prevPeriod = $_POST['lastWeek']; //Prev week arrow value
		$newWeekPeriod = $CalendarBrain->createDeaposon('prev', $prevPeriod); //Return array prev and next arrow val., year and prev week monday
		$newDayPeriod = $CalendarBrain->createPrevWeek($newWeekPeriod[3]); //Return day's array
		$newDayPeriod = $CalendarBrain->getWeeksEventAndDay($newDayPeriod); //Return day's and events array
		$this->renderPartial( 'application.components.calendar.views.calendar', array('calendar' => $newDayPeriod, 
											  										  'weeksPeriod' => $newWeekPeriod) );
	}

	public function actionNextWeek() {
		$CalendarBrain = CalendarBrain::getInstance();
		$prevPeriod = $_POST['nextWeek'];
		$newWeekPeriod = $CalendarBrain->createDeaposon('next', $prevPeriod); 
		$newDayPeriod = $CalendarBrain->createPrevWeek($newWeekPeriod[3]);
		$newDayPeriod = $CalendarBrain->getWeeksEventAndDay($newDayPeriod);
		$this->renderPartial( 'application.components.calendar.views.calendar', array('calendar' => $newDayPeriod, 
											  										  'weeksPeriod' => $newWeekPeriod) );
	}

	public function actionNowWeek() {
		$CalendarBrain = CalendarBrain::getInstance();
		$calendar = $CalendarBrain->getWeeksEventAndDay($CalendarBrain->createCalendar());
		$weeksPeriod = $CalendarBrain->createDeaposon('now');
		$this->render( 'application.components.calendar.views.calendar', array('calendar' => $calendar, 
										 									   'weeksPeriod' => $weeksPeriod) );
	}

}

