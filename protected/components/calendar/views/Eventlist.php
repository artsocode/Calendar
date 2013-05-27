<?php
echo   '<div class="cal-head-date-container">
          <span class="cal-head-date-day">'.date('d', $stamp).'</span>
          <span class="cal-head-date-month">'.date('l', $stamp).'</span><br>
          <span class="cal-head-date-year">'.date('F n, Y', $stamp).'</span>
        </div>';
echo   '<div class="cal-scroll-table">          
          <table class="cal-table">
              <thead>
                <tr class="cal-table-head">
                  <th>#</th>
                  <th>Заголовок</th>
                  <th>Тип</th>
                  <th>Дата</th>
                  <th>Пользователь</th>
                  <th>Текст</th> 
                  <th>Действия</th>                 
                </tr>
              </thead>              
              <tbody class="cal-table-tbody">'; 
              for ($i = 0; $i < count($events); $i++) { 
              $id = $i+1;
echo 			    '<tr class="cal-table-body">
					       <th>'.$id.'</th>
			           <th>'.$events[$i]['title'].'</th>
			           <th>'.$events[$i]['type'].'</th>
			           <th>'.date('d/m/Y', strtotime($events[$i]['date'])).'</th>
			           <th>'.$events[$i]['username'].'</th>
			           <th>'.substr($events[$i]['text'], 0, 50).'...</th>
                  <th><i event_id="'.$events[$i]['event_id'].'" class="icon-pencil cal-edit-field-ico cal-edit-field-btn"></i>  <i event_id="'.$events[$i]['event_id'].   '" class="icon-remove cal-del-field-ico cal-del-field-btn"></i></th>
				      </tr>';
              }             
echo         '</tbody>
            </table>
           </div>
          <div class="cal-edit-data-container">
            <div class="cal-ajax-loadgif"><img src="../images/ajax.gif" alt=""></div>
          </div>            
          <script src="../js/edit.js"></script>';