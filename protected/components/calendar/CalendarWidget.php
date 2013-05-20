<?php
class CalendarWidget extends CWidget {

	public function init() {

	}

	public function run() {
		//Enter point
		$CalendarBrain = CalendarBrain::getInstance();
		$calendar = $CalendarBrain->getWeeksEventAndDay($CalendarBrain->createCalendar());
		$weeksPeriod = $CalendarBrain->createDeaposon('now');
		$this->render( 'calendar', array('calendar' => $calendar, 
										 'weeksPeriod' => $weeksPeriod) );
	}

}