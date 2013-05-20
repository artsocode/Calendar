<?php
$prevWeek = explode('-', $weeksPeriod[0]);
$nextWeek = explode('-', $weeksPeriod[1]);

echo '<div class="cal-container">
        <div class="cal-calendar">
          <div class="cal-navigation-bar">
            <div class="cal-nav-btn prev-days-btn" id="get-prev-week" year="'.$prevWeek[0].'">←<br>
              <span class="cal-prev-day-title" id="get-prev-week-title" deaposon="'.$weeksPeriod[0].'">'.date('d', $prevWeek[0]).'-'.date('d', $prevWeek[1]).'</span>
            </div>
            <div class="cal-nav-btn today-btn" id="get-now-week" year="'.$weeksPeriod[2].'">Сегодня<br>
              <span class="cal-this-day-title" id="get-now-title">'.date('d.m.Y', $weeksPeriod[2]).'</span>
            </div>
            <div class="cal-nav-btn next-days-btn" id="get-next-week" year="'.$nextWeek[1].'">→<br>
              <span class="cal-next-day-title" id="get-next-week-title" deaposon="'.$weeksPeriod[1].'">'.date('d', $nextWeek[0]).'-'.date('d', $nextWeek[1]).'</span>
            </div>
          </div>
          <span class="cal-message-box"><br>
              <div class="cal-mesBox-angle"></div>
          </span>';  
          for ($i = 0; $i < count($calendar); $i++) { 
            if ($calendar[$i]['event'] <= 0) {
              $class = 'cal-event-no';
            } else {
              $class = 'cal-event-yes';
            }
echo       '<div class="cal-day '.$class.'" stamp="'.$calendar[$i]['stamp'].'" event-count="'.$calendar[$i]['event'].'">'.date('d', $calendar[$i]['stamp']).'<br>
              <span class="cal-day-title">'.substr(date('D', $calendar[$i]['stamp']), 0, -1).'</span>
            </div>';
          }                 
echo    '</div>
      </div>';
echo '<div class="navbar-inner">
        <!--<form class="navbar-form pull-left">
          <input type="text" class="span4">
          <button type="submit" class="btn">Добавить</button>
        </form>-->
      </div>';


echo '<script src="../js/navigation.js"></script>';
