<?php
##
## This class is are calendar brains.
## It contains a all logic which is needed 
## to work with the date and db
## 
class CalendarBrain {
	protected static $_instance;
	protected $oneDay = 86400;

	public function __construct() {
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
		$datePeriod[0] = strtotime('Mon this week');
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
				$nextWeek = strtotime('Mon next week').' - '.strtotime('Sun next week');
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
		$id = Yii::app()->user->getId();
		$events = Event::model()->findAll('user_id = :user_id AND create_date = :stamp', array(':user_id' => $id, ':stamp' => $daysStamp));
		$event_count = count($events);
		return $event_count;
	}
}