<?php
##
## This is are mine widget controller
## He need to manage are timeline through jquery
##

class CalendarController extends CController {
	##
	## Generate deaposon and calendar days for last week
	##
	public function actionPrevWeek() {
		$CalendarBrain = CalendarBrain::getInstance(); //Singleton class
		$prevPeriod = $_POST['lastWeek']; //Prev week arrow value
		$newWeekPeriod = $CalendarBrain->createDeaposon('prev', $prevPeriod); //Return array prev and next arrow val., year and prev week monday
		$newDayPeriod = $CalendarBrain->createPrevWeek($newWeekPeriod[3]); //Return day's array
		$newDayPeriod = $CalendarBrain->getWeeksEventAndDay($newDayPeriod); //Return day's and events array
		$usersAndType = $CalendarBrain->usersAndType();
		$this->renderPartial( 'application.components.calendar.views.calendar', array('calendar' => $newDayPeriod, 
											  										  'weeksPeriod' => $newWeekPeriod,
											  										  'usersAndType' => $usersAndType) );
	}
	##
	## Generate deaposon and calendar days for next week
	##
	public function actionNextWeek() {
		$CalendarBrain = CalendarBrain::getInstance();
		$prevPeriod = $_POST['nextWeek'];
		$newWeekPeriod = $CalendarBrain->createDeaposon('next', $prevPeriod); 
		$newDayPeriod = $CalendarBrain->createPrevWeek($newWeekPeriod[3]);
		$newDayPeriod = $CalendarBrain->getWeeksEventAndDay($newDayPeriod);
		$usersAndType = $CalendarBrain->usersAndType();
		$this->renderPartial( 'application.components.calendar.views.calendar', array('calendar' => $newDayPeriod, 
											  										  'weeksPeriod' => $newWeekPeriod,
											  										  'usersAndType' => $usersAndType) );
	}

	##
	## Generate and rendering calendar for now day
	##
	public function actionNowWeek() {
		$CalendarBrain = CalendarBrain::getInstance();
		$calendar = $CalendarBrain->getWeeksEventAndDay($CalendarBrain->createCalendar());
		$weeksPeriod = $CalendarBrain->createDeaposon('now');
		$usersAndType = $CalendarBrain->usersAndType();
		$this->render( 'application.components.calendar.views.calendar', array('calendar' => $calendar, 
										 									   'weeksPeriod' => $weeksPeriod,
										 									   'usersAndType' => $usersAndType) );
	}

	##
	## Add new event
	##
	public function actionAddNew() {		
		$CalendarBrain = CalendarBrain::getInstance();
		$data = array('title' => $_POST['new_title'],
					  'type' => $_POST['new_type'],
					  'date' => date('Y-m-d', strtotime(str_replace('/', '-', $_POST['new_date']))),
					  'user' => $_POST['new_user'],
					  'text' => $_POST['new_message']);
		$newEvent = $CalendarBrain->addNewEvent($data);
	}

	##
	## Get all event for the day
	##
	public function actionGetEvents() {
		$CalendarBrain = CalendarBrain::getInstance();
		$timestamp = $_POST['stamp'];
		$events = $CalendarBrain->getEvents($timestamp);		
		$this->renderPartial( 'application.components.calendar.views.eventlist', array('events' => $events, 'stamp' => $timestamp));
	}

	##
	## Get values for editable field
	##
	public function actionGetEditField() {
		$CalendarBrain = CalendarBrain::getInstance();
		$event_id = $_POST['event_id'];
		$form = $CalendarBrain->GetEditField($event_id);
		$this->renderPartial( 'application.components.calendar.views.editform', array('form' => $form, 'event_id' => $event_id) );
	}

	##
	## Delete one tr row
	##
	public function actionDelField() {
		$CalendarBrain = CalendarBrain::getInstance();
		$event_id = $_POST['event_id'];
		$del = $CalendarBrain->deleteField($event_id);
	}

	##
	## Updating. Save the change.
	## 
	public function actionSaveTheChange() {
		$CalendarBrain = CalendarBrain::getInstance();
		$data = array('date' => date('Y-m-d', strtotime(str_replace('/', '-', $_POST['date']))),
					  'title' => $_POST['title'], 
					  'user' => $_POST['user'], 
					  'type' => $_POST['type'], 
					  'text' => $_POST['text'],
					  'id' => $_POST['id']);
		$updateRes = $CalendarBrain->updateEvent($data);
	}

}

