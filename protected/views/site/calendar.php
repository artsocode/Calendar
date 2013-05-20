<?php
echo '<div class="cal-bg">
        <div class="cal-ui">
          <i class="icon-user icon-white"></i><span class="cal-username"> '.Yii::app()->user->username.'</span>
          <a href="logout" class="cal-exit-btn"><i class="icon-lock icon-white"></i> Выход</a>
        </div>
      </div>';

echo '<div class="CalendarWidgetContainer">';
$this->widget('CalendarWidget');
echo '</div>';