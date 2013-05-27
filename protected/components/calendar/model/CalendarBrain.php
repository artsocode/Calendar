<?php
##
## This class is are calendar brains.
## It contains a all logic which is needed 
## to work with the date and db
## 
class CalendarBrain {
	protected static $_instance;
	protected $oneDay = 86400;
	private $id;

	public function __construct() {
		$this->id = Yii::app()->user->getId();
	}

	private function __clone() {
    }

    private function __wakeup() {
    }  

	public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;   
        } 
        return self::$_instance;
    }

    ##
    ## Generate days timeline
    ##
	public function createCalendar() {
		if (strtotime('This monday') > time()) {
			$datePeriod[0] = strtotime('This monday - 1 week');
		} else {
			$datePeriod[0] = strtotime('This monday');
		}		
		for ($i = 1; $i <= 6; $i++) {
			$datePeriod[$i] = $datePeriod[0] + ($this->oneDay * $i);
		} 
		return $datePeriod;
	}
	##
    ## Generate days deaposon, now, prev and next
    ##
	public function createDeaposon($weekStr = 'now', $periodStr = 'null') {
		switch ($weekStr) {
			case 'now': {
				$prevWeek = strtotime('Mon last week').' - '.strtotime('Sun last week');
				if (strtotime('This monday') > time()) {
					$prevWeek = strtotime('Mon last week - 1 week').' - '.strtotime('Sun last week - 1 week');
					$nextWeek = strtotime('Mon next week - 1 week').' - '.strtotime('Sun next week - 1 week');
				} else {
					$prevWeek = strtotime('Mon last week').' - '.strtotime('Sun last week');
					$nextWeek = strtotime('Mon next week').' - '.strtotime('Sun next week');
				}
				$timeNow = strtotime('now');
				$dateDeaposon = array($prevWeek, $nextWeek, $timeNow);
				return $dateDeaposon;
			}
			case 'prev': {
				if (isset($periodStr)) {
					$period = explode('-', $periodStr);
					$period = $this->getPeriod($period);
					return $period;					
				} else {
					return false;
				}		
			}
			case 'next': {
				if (isset($periodStr)) {
					$period = explode('-', $periodStr);					
					$period = $this->getPeriod($period);
					return $period;					
				} else {
					return false;
				}	
			}
			default: {
				return false;
			}		
		}		
	}

	public function createPrevWeek($prevWeekMonStr) {
		$datePeriod[0] = $prevWeekMonStr;
		for ($i = 1; $i <= 6; $i++) {
			$datePeriod[$i] = $datePeriod[0] + ($this->oneDay * $i);
		} 
		return $datePeriod;
	}

	public function createNextWeek($nextWeekMonStr) {		
		$datePeriod[0] = $nextWeekMonStr;
		for ($i = 1; $i <= 6; $i++) {
			$datePeriod[$i] = $datePeriod[0] - ($this->oneDay * $i);
		} 
		return $datePeriod;
	}

	##
	## Generate are new period for arrow btn
	##
	private function getPeriod($newPeriodTSArr) {
		$newPrevWeek = ($newPeriodTSArr[0] - ($this->oneDay * 7)).' - '.($newPeriodTSArr[1] - ($this->oneDay * 7));
		$newNextWeek = ($newPeriodTSArr[1] + $this->oneDay ).' - '.($newPeriodTSArr[1] + ($this->oneDay * 7));
		$monday = $newPeriodTSArr[0];
		$timeNow = strtotime('now');

		return $dateDeaposon = array($newPrevWeek, $newNextWeek, $timeNow, $monday);		
	}

	##
	## Return array which includes count() events
	## and timestamp.
	##
	public function getWeeksEventAndDay($daysTStamp) {	
		if (isset($daysTStamp)) {			
			if (is_array($daysTStamp)) {
				for ($i=0; $i <= count($daysTStamp)-1; $i++) { 
					$daysArr[$i]['stamp'] = $daysTStamp[$i];
					$daysArr[$i]['event'] = $this->getCountEvents($daysTStamp[$i]);
				}
				return $daysArr;
			} else {
				$daysArr[0] = array('stamp' => $daysTStamp, 'event' => $this->getCountEvents($daysTStamp));
				return $daysArr;
			}
		}		
	}

	##
	## Returns an array containing the total of the 
	## entries for a given user on a particular day
	##
	private function getCountEvents($daysStamp) {
		$daysStamp = date('Y-m-d', $daysStamp);
		$events = Event::model()->findAll('user_id = :user_id AND event_date = :stamp', array(':user_id' => $this->id, ':stamp' => $daysStamp));
		$event_count = count($events);
		return $event_count;
	}

	##
	##	Function to add new Event to database
	##
	public function addNewEvent($data) {
		var_dump($this->id);
		foreach($data as $id => $val) {
			$data[$id] = stripslashes(trim(strip_tags($data[$id])));
		}
		$event = new Event();
		$event->user_id = $this->id;
		$event->create_date = date('Y-m-d', mktime());
		$event->event_date = date('Y-m-d', strtotime($data['date']));
		$event->title = $data['title'];
		$event->link_user = $data['user'] == null ? $this->id : $data['user'];
		$event->event_type = $data['type'];
		$event->event_text = $data['text'];
		$event->save();
	}

	##
	## Return user id and event type from database
	##
	public function usersAndType() {
		$users = Yii::app()->db->createCommand()
			->select('user_id AS id, username AS name')
			->from('users')
			->queryAll();
		$event = Yii::app()->db->createCommand()
			->select('id, type_name AS name')
			->from('event_type')
			->queryAll();
		$result = array('users' => $users, 'event' => $event);
		return $result;
	}

	##
	## Return all timestamp events
	##
	public function getEvents($timestamp) {
		$date = date('Y-m-d', $timestamp);
		$events = Yii::app()->db->createCommand()
			->select('e.id AS event_id, e.event_date AS date, e.title, e.link_user AS user_id, e.event_type AS type, e.event_text AS text,u.username')
			->from('event e')
			->join('users u', 'e.link_user = u.user_id')
			->where('e.user_id = :id AND event_date = :date', array(':id' => $this->id, ':date' => $date))
			->queryAll();
		return $events;
	}

	##
	## Return field for editing
	##
	public function GetEditField($event_id) {		
		$field = Yii::app()->db->createCommand()
			->select('e.title, e.event_type AS type, e.event_date AS date, e.link_user, u.username, e.event_text AS text,')
			->from('event e')
			->join('users u', 'e.link_user = u.user_id')
			->where('e.id = :event_id AND e.user_id = :id', array(':event_id' => $event_id, ':id' => $this->id))
			->queryAll();
		$users = $this->usersAndType();
		$field = array('field' => $field[0], 'users' => $users);
		return $field;
	}

	##
	## Update events
	##
	public function updateEvent($data) {
		$updateRes = Yii::app()->db->createCommand()
			->update('event', array('event_date' => $data['date'],
								  'title' => $data['title'], 
								  'link_user' => $data['user'], 
								  'event_type' => $data['type'], 
								  'event_text' => $data['text']), 
			'id = :id', array(':id' => $data['id']));
		return $updateRes;		
	}

	##
	## Delete field
	##
	public function deleteField($event_id) {
		$field = Yii::app()->db->createCommand()
		    ->delete('event', 'id = :id', array(':id' => $event_id));
	}
}