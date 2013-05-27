<?php
$prevWeek = explode('-', $weeksPeriod[0]);
$nextWeek = explode('-', $weeksPeriod[1]);

echo '<div class="cal-container">
        <div class="cal-calendar">
          <div class="cal-table-event" flag="0">          
          </div>          
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
            $weeksPeriod[2] = strtotime(date('d.m.Y', $weeksPeriod[2]));
            if ($weeksPeriod[2] == $calendar[$i]['stamp']) {
              $class .= ' active-day-on';
            }
echo       '<div class="cal-day '.$class.'" stamp="'.$calendar[$i]['stamp'].'" event-count="'.$calendar[$i]['event'].'">'.date('d', $calendar[$i]['stamp']).'<br>
              <span class="cal-day-title">'.substr(date('D', $calendar[$i]['stamp']), 0, -1).'</span>
            </div>';
          }
echo     '<form action="" method="post" class="cal-addNew-event" id="cal-addNew-form">
            <h2 class="cal-addNew-title">ДОБАВИТЬ</h2>
            <label class="cal-addNew-lable" for="new_title">Заголовок</label>
            <input class="cal-addNew-input cal-text" id="cal-input-title" type="text" name="new_title" value="" placeholder="Моя первая новость" required>
            <label class="cal-addNew-lable" for="new_type">Тип</label>
            <select class="cal-addNew-input cal-select" id="cal-select-type" size="1" name="new_type">
              <option selected disabled value="личные">Выберите тип</option>';              
              for ($i = 0; $i < count($usersAndType['event']); $i++) { 
echo           '<option value="'.$usersAndType['event'][$i]['id'].'">'.$usersAndType['event'][$i]['name'].'</option>';      
              }
echo       '</select>
            <label class="cal-addNew-lable" for="new_date">Дата</label>
            <input class="cal-addNew-input cal-text" id="cal-input-date" type="text" name="new_date" value="" placeholder="'.date('d/m/Y', $weeksPeriod[2]).'" required>
            <label class="cal-addNew-lable" for="new_type">Пользователи</label>
            <select class="cal-addNew-input cal-select" id="cal-select-user" size="1" name="new_user">
              <option selected disabled>Выберите пользователя</option>';              
              for ($i = 0; $i < count($usersAndType['users']); $i++) { 
echo           '<option value="'.$usersAndType['users'][$i]['id'].'">'.$usersAndType['users'][$i]['name'].'</option>';      
              }
echo       '</select>
            <label class="cal-addNew-lable" for="">Текст</label>
            <textarea class="cal-addNew-input cal-textarea" id="cal-textarea-text" name="new_message" placeholder="Текст события"></textarea>
            <input class="cal-addNew-input" id="cal-addNew-submit" type="submit" name="new_submit" value="ОК">
          </form>';                           
echo    '</div>
      </div>';
echo '<script src="../js/navigation.js"></script>';
