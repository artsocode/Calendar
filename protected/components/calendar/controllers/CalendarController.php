<?php
class CalendarController extends CController {
	public function actionPrevWeek() {
		echo 'Предыдущая неделя';
	}

	public function actionNextWeek() {
		echo 'Следующая неделя';
	}
}